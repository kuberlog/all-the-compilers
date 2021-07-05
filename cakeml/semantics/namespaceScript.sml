(*Generated by Lem from namespace.lem.*)
open HolKernel Parse boolLib bossLib;
open lem_pervasivesTheory lem_set_extraTheory;

val _ = numLib.prefer_num();



local open alistTheory in end;
val _ = new_theory "namespace"
val _ = set_grammar_ancestry ["alist"];

(*
  Defines a datatype for nested namespaces where names can be either
  short (e.g. foo) or long (e.g. ModuleA.InnerB.bar).
*)
(*open import Pervasives*)
(*open import Set_extra*)

val _ = type_abbrev((* ( 'k, 'v) *) "alist" , ``: ('k # 'v) list``);

(* Identifiers *)
val _ = Hol_datatype `
 id =
    Short of 'n
  | Long of 'm => id`;


(*val mk_id : forall 'n 'm. list 'm -> 'n -> id 'm 'n*)
 val _ = Define `
 ((mk_id:'m list -> 'n ->('m,'n)id) [] n=  (Short n))
    /\ ((mk_id:'m list -> 'n ->('m,'n)id) (mn::mns) n=  (Long mn (mk_id mns n)))`;


(*val id_to_n : forall 'n 'm. id 'm 'n -> 'n*)
 val _ = Define `
 ((id_to_n:('m,'n)id -> 'n) (Short n)=  n)
    /\ ((id_to_n:('m,'n)id -> 'n) (Long _ id)=  (id_to_n id))`;


(*val id_to_mods : forall 'n 'm. id 'm 'n -> list 'm*)
 val _ = Define `
 ((id_to_mods:('m,'n)id -> 'm list) (Short _)=  ([]))
    /\ ((id_to_mods:('m,'n)id -> 'm list) (Long mn id)=  (mn :: id_to_mods id))`;


val _ = Hol_datatype `
 namespace =
  Bind of ('n, 'v) alist => ('m, (namespace)) alist`;


(*val nsLookup : forall 'v 'm 'n. Eq 'n, Eq 'm => namespace 'm 'n 'v -> id 'm 'n -> maybe 'v*)
 val _ = Define `
 ((nsLookup:('m,'n,'v)namespace ->('m,'n)id -> 'v option) (Bind v m) (Short n)=  (ALOOKUP v n))
    /\ ((nsLookup:('m,'n,'v)namespace ->('m,'n)id -> 'v option) (Bind v m) (Long mn id)=
       ((case ALOOKUP m mn of
        NONE => NONE
      | SOME env => nsLookup env id
      )))`;


(*val nsLookupMod : forall 'm 'n 'v. Eq 'n, Eq 'm => namespace 'm 'n 'v -> list 'm -> maybe (namespace 'm 'n 'v)*)
 val _ = Define `
 ((nsLookupMod:('m,'n,'v)namespace -> 'm list ->(('m,'n,'v)namespace)option) e []=  (SOME e))
    /\ ((nsLookupMod:('m,'n,'v)namespace -> 'm list ->(('m,'n,'v)namespace)option) (Bind v m) (mn::path)=
       ((case ALOOKUP m mn of
        NONE => NONE
      | SOME env => nsLookupMod env path
      )))`;


(*val nsEmpty : forall 'v 'm 'n. namespace 'm 'n 'v*)
val _ = Define `
 ((nsEmpty:('m,'n,'v)namespace)=  (Bind [] []))`;


(*val nsAppend : forall 'v 'm 'n. namespace 'm 'n 'v -> namespace 'm 'n 'v -> namespace 'm 'n 'v*)
val _ = Define `
 ((nsAppend:('m,'n,'v)namespace ->('m,'n,'v)namespace ->('m,'n,'v)namespace) (Bind v1 m1) (Bind v2 m2)=  (Bind (v1 ++ v2) (m1 ++ m2)))`;


(*val nsLift : forall 'v 'm 'n. 'm -> namespace 'm 'n 'v -> namespace 'm 'n 'v*)
val _ = Define `
 ((nsLift:'m ->('m,'n,'v)namespace ->('m,'n,'v)namespace) mn env=  (Bind [] [(mn, env)]))`;


(*val alist_to_ns : forall 'v 'm 'n. alist 'n 'v -> namespace 'm 'n 'v*)
val _ = Define `
 ((alist_to_ns:('n#'v)list ->('m,'n,'v)namespace) a=  (Bind a []))`;


(*val nsBind : forall 'v 'm 'n. 'n -> 'v -> namespace 'm 'n 'v -> namespace 'm 'n 'v*)
val _ = Define `
 ((nsBind:'n -> 'v ->('m,'n,'v)namespace ->('m,'n,'v)namespace) k x (Bind v m)=  (Bind ((k,x)::v) m))`;


(*val nsBindList : forall 'v 'm 'n. list ('n * 'v) -> namespace 'm 'n 'v -> namespace 'm 'n 'v*)
val _ = Define `
 ((nsBindList:('n#'v)list ->('m,'n,'v)namespace ->('m,'n,'v)namespace) l e=  (FOLDR (\ (x,v) e .  nsBind x v e) e l))`;


(*val nsOptBind : forall 'v 'm 'n. maybe 'n -> 'v -> namespace 'm 'n 'v -> namespace 'm 'n 'v*)
val _ = Define `
 ((nsOptBind:'n option -> 'v ->('m,'n,'v)namespace ->('m,'n,'v)namespace) n x env=
   ((case n of
    NONE => env
  | SOME n' => nsBind n' x env
  )))`;


(*val nsSing : forall 'v 'm 'n. 'n -> 'v -> namespace 'm 'n 'v*)
val _ = Define `
 ((nsSing:'n -> 'v ->('m,'n,'v)namespace) n x=  (Bind ([(n,x)]) []))`;


(*val nsSub : forall 'v1 'v2 'm 'n. Eq 'm, Eq 'n, Eq 'v1, Eq 'v2 =>
  (id 'm 'n -> 'v1 -> 'v2 -> bool) -> namespace 'm 'n 'v1 -> namespace 'm 'n 'v2 -> bool*)
val _ = Define `
 ((nsSub:(('m,'n)id -> 'v1 -> 'v2 -> bool) ->('m,'n,'v1)namespace ->('m,'n,'v2)namespace -> bool) r env1 env2=
   ((! id v1.
    (nsLookup env1 id = SOME v1)
    ==>
    (? v2. (nsLookup env2 id = SOME v2) /\ r id v1 v2))
  /\
  (! path.
    (nsLookupMod env2 path = NONE) ==> (nsLookupMod env1 path = NONE))))`;


(*val nsAll : forall 'v 'm 'n. Eq 'm, Eq 'n, Eq 'v => (id 'm 'n -> 'v -> bool) -> namespace 'm 'n 'v -> bool*)
 val _ = Define `
 ((nsAll:(('m,'n)id -> 'v -> bool) ->('m,'n,'v)namespace -> bool) f env=
   (! id v.
     (nsLookup env id = SOME v)
     ==>
     f id v))`;


(*val eAll2 : forall 'v1 'v2 'm 'n. Eq 'm, Eq 'n, Eq 'v1, Eq 'v2 =>
   (id 'm 'n -> 'v1 -> 'v2 -> bool) -> namespace 'm 'n 'v1 -> namespace 'm 'n 'v2 -> bool*)
val _ = Define `
 ((nsAll2:(('d,'c)id -> 'b -> 'a -> bool) ->('d,'c,'b)namespace ->('d,'c,'a)namespace -> bool) r env1 env2=
   (nsSub r env1 env2 /\
  nsSub (\ x y z .  r x z y) env2 env1))`;


(*val nsDom : forall 'v 'm 'n. Eq 'm, Eq 'n, Eq 'v, SetType 'v => namespace 'm 'n 'v -> set (id 'm 'n)*)
val _ = Define `
 ((nsDom:('m,'n,'v)namespace ->(('m,'n)id)set) env= 
  ({ n | v,n | (v IN UNIV) /\ (n IN UNIV) /\ (nsLookup env n = SOME v) }))`;


(*val nsDomMod : forall 'v 'm 'n. SetType 'm, Eq 'm, Eq 'n, Eq 'v => namespace 'm 'n 'v -> set (list 'm)*)
val _ = Define `
 ((nsDomMod:('m,'n,'v)namespace ->('m list)set) env= 
  ({ n | v,n | (v IN UNIV) /\ (n IN UNIV) /\ (nsLookupMod env n = SOME v) }))`;


(*val nsMap : forall 'v 'w 'm 'n. ('v -> 'w) -> namespace 'm 'n 'v -> namespace 'm 'n 'w*)
 val nsMap_defn = Hol_defn "nsMap" `
 ((nsMap:('v -> 'w) ->('m,'n,'v)namespace ->('m,'n,'w)namespace) f (Bind v m)=
   (Bind (MAP (\ (n,x) .  (n, f x)) v)
       (MAP (\ (mn,e) .  (mn, nsMap f e)) m)))`;

val _ = Lib.with_flag (computeLib.auto_import_definitions, false) Defn.save_defn nsMap_defn;
val _ = export_theory()
