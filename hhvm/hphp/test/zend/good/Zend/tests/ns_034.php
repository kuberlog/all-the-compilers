<?hh
namespace A;
use A as B;
class Foo {
    const C = "ok\n";
}
function f1($x=Foo::C) {
    echo $x;
}
function f2($x=B\Foo::C) {
    echo $x;
}
function f3($x=\A\Foo::C) {
    echo $x;
}
<<__EntryPoint>> function main(): void {
echo Foo::C;
echo B\Foo::C;
echo \A\Foo::C;
f1();
f2();
f3();
}