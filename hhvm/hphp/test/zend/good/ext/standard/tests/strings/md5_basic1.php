<?hh
/* Prototype  : string md5  ( string $str  [, bool $raw_output= false  ] )
 * Description: Calculate the md5 hash of a string
 * Source code: ext/standard/md5.c
*/
<<__EntryPoint>> function main(): void {
echo "*** Testing md5() : basic functionality ***\n";
var_dump(md5(b"apple"));
echo "===DONE===\n";
}