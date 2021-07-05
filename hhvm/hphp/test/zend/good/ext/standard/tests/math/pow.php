<?hh // $Id$
<<__EntryPoint>> function main(): void {
$long_max = is_int(5000000000)? (float)9223372036854775807 : (float)0x7FFFFFFF;
$long_min = -$long_max - 1;
printf("%d,%d,%d,%d\n",is_float($long_min  ),is_float($long_max  ),
					   is_int($long_min-1),is_int($long_max+1));

echo "On failure, please mail result to php-dev@lists.php.net\n";
include(dirname(__FILE__) . '/../../../../tests/quicktester.inc');

quicktester(() ==>  0.25, () ==> pow(-2,-2));
quicktester(() ==> -0.5 , () ==> pow(-2,-1));
quicktester(() ==>  1   , () ==> pow(-2, 0));
quicktester(() ==> -2   , () ==> pow(-2, 1));
quicktester(() ==>  4   , () ==> pow(-2, 2));
quicktester(() ==>  1.0 , () ==> pow(-1,-2));
quicktester(() ==> -1.0 , () ==> pow(-1,-1));
quicktester(() ==>  1   , () ==> pow(-1, 0));
quicktester(() ==> -1   , () ==> pow(-1, 1));
quicktester(() ==>  1   , () ==> pow(-1, 2));
quicktester(() ==>  TRUE, () ==> is_infinite(pow(0,-2)));
quicktester(() ==>  TRUE, () ==> is_infinite(pow(0,-1)));
quicktester(() ==>  1   , () ==> pow( 0, 0));
quicktester(() ==>  0   , () ==> pow( 0, 1));
quicktester(() ==>  0   , () ==> pow( 0, 2));
quicktester(() ==>  1.0 , () ==> pow( 1,-2));
quicktester(() ==>  1.0 , () ==> pow( 1,-1));
quicktester(() ==>  1   , () ==> pow( 1, 0));
quicktester(() ==>  1   , () ==> pow( 1, 1));
quicktester(() ==>  1   , () ==> pow( 1, 2));
quicktester(() ==>  0.25, () ==> pow( 2,-2));
quicktester(() ==>  0.5 , () ==> pow( 2,-1));
quicktester(() ==>  1   , () ==> pow( 2, 0));
quicktester(() ==>  2   , () ==> pow( 2, 1));
quicktester(() ==>  4   , () ==> pow( 2, 2));
quicktester(() ==>  0.25, () ==> pow(-2,-2.0));
quicktester(() ==> -0.5 , () ==> pow(-2,-1.0));
quicktester(() ==>  1.0 , () ==> pow(-2, 0.0));
quicktester(() ==> -2.0 , () ==> pow(-2, 1.0));
quicktester(() ==>  4.0 , () ==> pow(-2, 2.0));
quicktester(() ==>  1.0 , () ==> pow(-1,-2.0));
quicktester(() ==> -1.0 , () ==> pow(-1,-1.0));
quicktester(() ==>  1.0 , () ==> pow(-1, 0.0));
quicktester(() ==> -1.0 , () ==> pow(-1, 1.0));
quicktester(() ==>  1.0 , () ==> pow(-1, 2.0));
quicktester(() ==>  TRUE, () ==> is_infinite(pow(0,-2.0)));
quicktester(() ==>  TRUE, () ==> is_infinite(pow(0,-1.0)));
quicktester(() ==>  1.0 , () ==> pow( 0, 0.0));
quicktester(() ==>  0.0 , () ==> pow( 0, 1.0));
quicktester(() ==>  0.0 , () ==> pow( 0, 2.0));
quicktester(() ==>  1.0 , () ==> pow( 1,-2.0));
quicktester(() ==>  1.0 , () ==> pow( 1,-1.0));
quicktester(() ==>  1.0 , () ==> pow( 1, 0.0));
quicktester(() ==>  1.0 , () ==> pow( 1, 1.0));
quicktester(() ==>  1.0 , () ==> pow( 1, 2.0));
quicktester(() ==>  0.25, () ==> pow( 2,-2.0));
quicktester(() ==>  0.5 , () ==> pow( 2,-1.0));
quicktester(() ==>  1.0 , () ==> pow( 2, 0.0));
quicktester(() ==>  2.0 , () ==> pow( 2, 1.0));
quicktester(() ==>  4.0 , () ==> pow( 2, 2.0));
quicktester(() ==>  2147483648, () ==> pow(2,31));
quicktester(() ==> -2147483648, () ==> pow(-2,31), '~==');
quicktester(() ==>  1000000000, () ==> pow(10,9));
quicktester(() ==>  100000000 , () ==> pow(-10,8));
quicktester(() ==>  1   , () ==> pow(-1,1443279822));
quicktester(() ==> -1   , () ==> pow(-1,1443279821));
quicktester(() ==> sqrt(2.0), () ==> pow(2,1/2), '~==');
quicktester(() ==>  0.25, () ==> pow(-2.0,-2.0));
quicktester(() ==> -0.5 , () ==> pow(-2.0,-1.0));
quicktester(() ==>  1.0 , () ==> pow(-2.0, 0.0));
quicktester(() ==> -2.0 , () ==> pow(-2.0, 1.0));
quicktester(() ==>  4.0 , () ==> pow(-2.0, 2.0));
quicktester(() ==>  1.0 , () ==> pow(-1.0,-2.0));
quicktester(() ==> -1.0 , () ==> pow(-1.0,-1.0));
quicktester(() ==>  1.0 , () ==> pow(-1.0, 0.0));
quicktester(() ==> -1.0 , () ==> pow(-1.0, 1.0));
quicktester(() ==>  1.0 , () ==> pow(-1.0, 2.0));
quicktester(() ==>  TRUE, () ==> is_infinite(pow(0.0,-2.0)));
quicktester(() ==>  TRUE, () ==> is_infinite(pow(0.0,-1.0)));
quicktester(() ==>  1.0 , () ==> pow( 0.0, 0.0));
quicktester(() ==>  0.0 , () ==> pow( 0.0, 1.0));
quicktester(() ==>  0.0 , () ==> pow( 0.0, 2.0));
quicktester(() ==>  1.0 , () ==> pow( 1.0,-2.0));
quicktester(() ==>  1.0 , () ==> pow( 1.0,-1.0));
quicktester(() ==>  1.0 , () ==> pow( 1.0, 0.0));
quicktester(() ==>  1.0 , () ==> pow( 1.0, 1.0));
quicktester(() ==>  1.0 , () ==> pow( 1.0, 2.0));
quicktester(() ==>  0.25, () ==> pow( 2.0,-2.0));
quicktester(() ==>  0.5 , () ==> pow( 2.0,-1.0));
quicktester(() ==>  1.0 , () ==> pow( 2.0, 0.0));
quicktester(() ==>  2.0 , () ==> pow( 2.0, 1.0));
quicktester(() ==>  4.0 , () ==> pow( 2.0, 2.0));
quicktester(() ==>  0.25, () ==> pow(-2.0,-2));
quicktester(() ==> -0.5 , () ==> pow(-2.0,-1));
quicktester(() ==>  1.0 , () ==> pow(-2.0, 0));
quicktester(() ==> -2.0 , () ==> pow(-2.0, 1));
quicktester(() ==>  4.0 , () ==> pow(-2.0, 2));
quicktester(() ==>  1.0 , () ==> pow(-1.0,-2));
quicktester(() ==> -1.0 , () ==> pow(-1.0,-1));
quicktester(() ==>  1.0 , () ==> pow(-1.0, 0));
quicktester(() ==> -1.0 , () ==> pow(-1.0, 1));
quicktester(() ==>  1.0 , () ==> pow(-1.0, 2));
quicktester(() ==>  TRUE, () ==> is_infinite(pow( 0.0,-2)));
quicktester(() ==>  TRUE, () ==> is_infinite(pow( 0.0,-1)));
quicktester(() ==>  1.0 , () ==> pow( 0.0, 0));
quicktester(() ==>  0.0 , () ==> pow( 0.0, 1));
quicktester(() ==>  0.0 , () ==> pow( 0.0, 2));
quicktester(() ==>  1.0 , () ==> pow( 1.0,-2));
quicktester(() ==>  1.0 , () ==> pow( 1.0,-1));
quicktester(() ==>  1.0 , () ==> pow( 1.0, 0));
quicktester(() ==>  1.0 , () ==> pow( 1.0, 1));
quicktester(() ==>  1.0 , () ==> pow( 1.0, 2));
quicktester(() ==>  0.25, () ==> pow( 2.0,-2));
quicktester(() ==>  0.5 , () ==> pow( 2.0,-1));
quicktester(() ==>  1.0 , () ==> pow( 2.0, 0));
quicktester(() ==>  2.0 , () ==> pow( 2.0, 1));
quicktester(() ==>  4.0 , () ==> pow( 2.0, 2));
quicktester(() ==>  2.0 , () ==> pow(   4, 0.5));
quicktester(() ==>  2.0 , () ==> pow( 4.0, 0.5));
quicktester(() ==>  3.0 , () ==> pow(  27, 1/3));
quicktester(() ==>  3.0 , () ==> pow(27.0, 1/3));
quicktester(() ==> 0.5, () ==> pow(   4, -0.5));
quicktester(() ==> 0.5, () ==> pow( 4.0, -0.5));
quicktester(() ==> $long_max-1, () ==> pow($long_max-1,1));
quicktester(() ==> $long_min+1, () ==> pow($long_min+1,1));
quicktester(() ==> ($long_max-1)*($long_max-1), () ==> pow($long_max-1,2), '~==');
quicktester(() ==> ($long_min+1)*($long_min+1), () ==> pow($long_min+1,2), '~==');
quicktester(() ==> (float)($long_max-1), () ==> pow($long_max-1,1.0));
quicktester(() ==> (float)($long_min+1), () ==> pow($long_min+1,1.0));
quicktester(() ==> ($long_max-1)*($long_max-1), () ==> pow($long_max-1,2.0), '~==');
quicktester(() ==> ($long_min+1)*($long_min+1), () ==> pow($long_min+1,2.0), '~==');
quicktester(() ==> $long_max, () ==> pow($long_max,1));
quicktester(() ==> $long_min, () ==> pow($long_min,1));
quicktester(() ==> $long_max*$long_max, () ==> pow($long_max,2), '~==');
quicktester(() ==> $long_min*$long_min, () ==> pow($long_min,2), '~==');
quicktester(() ==> (float)$long_max, () ==> pow($long_max,1.0));
quicktester(() ==> (float)$long_min, () ==> pow($long_min,1.0));
quicktester(() ==> $long_max*$long_max, () ==> pow($long_max,2.0), '~==');
quicktester(() ==> $long_min*$long_min, () ==> pow($long_min,2.0), '~==');
}