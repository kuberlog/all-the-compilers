class Rubinius::NativeFunction
  attr_accessor :return_type
  attr_accessor :argument_types
end

module Rubinius
  module FFI
    def self.generate_function(ptr, name, args, ret)
      Rubinius.primitive :nativefunction_generate
      raise PrimitiveFailure, "FFI.generate_function primitive failed"
    end

    def self.generate_trampoline(obj, name, args, ret)
      Rubinius.primitive :nativefunction_generate_tramp
      raise PrimitiveFailure, "FFI.generate_function_tramp primitive failed"
    end

    module Library
      LIBC = Rubinius::LIBC

      # Set which library or libraries +attach_function+ should
      # look in. By default it only searches for the function in
      # the current process. If you want to specify this as one
      # of the locations, add FFI::USE_THIS_PROCESS_AS_LIBRARY.
      # The libraries are tried in the order given.
      #
      def ffi_lib(*names)
        @ffi_lib = names.map do |x|
          if x == FFI::CURRENT_PROCESS
            DynamicLibrary::CURRENT_PROCESS

            # When the element is an array, it's an ordered choice,
            # ie, pick the first library that works.
          elsif x.kind_of? Array
            lib = nil

            x.each do |name|
              begin
                lib = DynamicLibrary.new(name, @ffi_lib_flags)
                break
              rescue LoadError
              end
            end

            # If .new worked, then lib is set and we can use it.
            unless lib
              raise LoadError, "Unable to find library among: #{x.inspect}"
            end

            lib
          else
            DynamicLibrary.new(x)
          end
        end
      end

      def ffi_libraries
        @ffi_lib or [DynamicLibrary::CURRENT_PROCESS]
      end
      private :ffi_libraries

      # Flags used in {#ffi_lib}.
      #
      # This map allows you to supply symbols to {#ffi_lib_flags} instead of
      # the actual constants.
      def flags_map
        {
          :global => DynamicLibrary::RTLD_GLOBAL,
          :local => DynamicLibrary::RTLD_LOCAL,
          :lazy => DynamicLibrary::RTLD_LAZY,
          :now => DynamicLibrary::RTLD_NOW
        }
      end

      # Sets library flags for {#ffi_lib}.
      #
      # @example
      #   ffi_lib_flags(:lazy, :local) # => 5
      #
      # @param [Symbol, ???] flags (see {FlagsMap})
      # @return [Fixnum] the new value
      def ffi_lib_flags(*flags)
        @ffi_lib_flags = flags.inject(0) { |result, f| result | flags_map[f] }
      end

      # Attach a C function to this module. The arguments can have two forms:
      #
      #   attach_function c_name, [c_arg1, c_arg2], ret
      #   attach_function mod_name, c_name, [c_arg1, c_arg2], ret
      #
      # In the first form, +c_name+ will also be used for the name of the module
      # method. In the second form, the module method name is +mod_name+.
      #
      # In either form, an optional options hash will be accepted as an
      # additional argument, although currently all options are ignored.
      #
      # The +c_name+ and +mod_name+ can be given as Strings or Symbols.
      #
      # The types of the arguments to the C function, +c_arg1+, +c_arg2+, etc, are
      # given as an array even if there is only one.
      #
      # The final argument, +ret+, is the type of the return value from the C
      # function.
      def attach_function(name, a2, a3, a4=nil, a5=nil)
        if a4 && (a2.kind_of?(String) || a2.kind_of?(Symbol))
          cname = a2.to_s
          args = a3
          ret = a4
        else
          cname = name.to_s
          args = a2
          ret = a3
        end

        mname = name.to_sym

        ffi_libraries.each do |lib|
          if ptr = lib.find_symbol(cname)
            return pointer_as_function(mname, ptr, args, ret)
          end
        end

        ffi_function_missing cname, mname, args, ret
      end

      # Attach a C variable to this module. The arguments can have two forms:
      #
      #   attach_variable mod_name, type
      #   attach_variable mod_name, c_name, type
      #
      # In the first form, +mod_name+ will also be used for the name of the C variable.
      # In the second form, the C variable name is +c_name+.
      #
      # The +mod_name+ and +c_name+ can be given as Strings or Symbols.
      #
      # The final argument, +type+, is the type of the C variable
      def attach_variable(mname, a1, a2=nil)
        cname, type = a2 ? [ a1, a2 ] : [ mname.to_s, a1 ]
        ptr = nil

        ffi_libraries.each do |lib|
          ptr = lib.find_symbol(cname.to_s)
          break unless ptr.nil?
        end

        raise FFI::NotFoundError, "Unable to find '#{cname}'" if ptr.nil? || ptr.null?

        if type.kind_of?(Class) and type.ancestors.include?(FFI::Struct)
          c = type.new(ptr)

          self.module_eval <<-code, __FILE__, __LINE__
            @ffi_gvar_#{mname} = c
            def self.#{mname}
              @ffi_gvar_#{mname}
            end
          code

        else
          enclosing_module = self

          cs = Class.new(FFI::Struct) do
            @enclosing_module = enclosing_module
          end

          cs.layout :gvar, type
          c = cs.new(ptr)

          self.module_eval <<-code, __FILE__, __LINE__
            @ffi_gvar_#{mname} = c
            def self.#{mname}
              @ffi_gvar_#{mname}[:gvar]
            end
            def self.#{mname}=(value)
              @ffi_gvar_#{mname}[:gvar] = value
            end
          code

        end

        return ptr
      end

      # Generic error method attached in place of missing foreign functions
      # during loading the core library. See core/zed.rb for a version that
      # raises immediately if the foreign function is unavaiblable.
      def ffi_function_not_implemented(*args)
        raise NotImplementedError, "function not implemented on this platform"
      end

      # Protocol for attaching foregin functions. If #attach_function fails to
      # find a foreign function, this method will be called. Client code can
      # provide an override to customize features.
      def ffi_function_missing(cname, mname, args, ret)
        if func = Rubinius.find_method(self, :ffi_function_not_implemented)
          func = func[0].dup
          func.name = cname.to_sym
          add_function mname, func
        end
      end

      def add_function(name, func)
        # Make it available as a method callable directly..
        sc = Rubinius::Type.object_singleton_class(self)
        Rubinius::VM.reset_method_cache sc, name

        sc.method_table.store name, nil, func, nil, 0, :public

        # and expose it as a private method for people who
        # want to include this module.
        method_table.store name, nil, func, nil, 0, :private
      end
      private :add_function

      def pointer_as_function(name, ptr, args, ret)
        args.map! { |a| find_type a }

        if func = FFI.generate_function(ptr, name.to_sym, args, find_type(ret))
          add_function name, func
          return func
        end

        raise FFI::NotFoundError, "Unable to attach pointer"
      end

      def callback(a1, a2, a3=nil)
        if a3
          name = a1
          params = a2
          ret = a3
        else
          name = nil
          params = a1
          ret = a2
        end

        args = params.map { |x| find_type(x) }

        func, ptr = FFI.generate_trampoline nil, :ffi_tramp,
                                            args, find_type(ret)

        func.argument_types = params
        func.return_type = ret

        if name
          @ffi_callbacks ||= {}
          @ffi_callbacks[name] = func

          typedef func, name
        end

        return func
      end

      def typedef(old, add)
        @typedefs ||= Rubinius::LookupTable.new
        @typedefs[add] = find_type(old)
      end

      def find_type(name)
        @typedefs ||= Rubinius::LookupTable.new

        if name.kind_of? Rubinius::NativeFunction or name.kind_of? FFI::Enum
          return name
        end

        if type = @typedefs[name]
          return type
        end

        FFI.find_type(name)
      end

      def enum(*args)
        @tagged_enums ||= Rubinius::LookupTable.new
        @anon_enums ||= Array.new

        tag, values = if args[0].kind_of?(Symbol) && args[1].kind_of?(Array)
          [ args[0], args[1] ]
        elsif args[0].kind_of?(Array)
          [ nil, args[0] ]
        else
          [ nil, args ]
        end

        enum = FFI::Enum.new values, tag

        if tag
          typedef(enum, tag)
          @tagged_enums[tag] = enum
        else
          @anon_enums << enum
        end

        return enum
      end

      def enum_type(tag)

        if enum = @tagged_enums[tag]
          enum
        else
          @anon_enums.detect { |enum| enum.symbols.include?(tag) }
        end

      end

      def enum_value(value)

        if enum = @anon_enums.detect { |enum| enum.symbols.include?(value) }
          enum
        else
         tag,enum = @tagged_enums.detect { |tag,enum| enum.symbols.include?(value) }
         return enum
        end

      end
    end
  end
end
