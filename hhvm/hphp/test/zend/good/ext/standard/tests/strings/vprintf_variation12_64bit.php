<?hh
/* Prototype  : string vprintf(string format, array args)
 * Description: Output a formatted string 
 * Source code: ext/standard/formatted_print.c
*/

/*
 * Test vprintf() when different octal formats and non-octal values are passed to
 * the '$format' and '$args' arguments of the function
*/
<<__EntryPoint>> function main(): void {
echo "*** Testing vprintf() : octal formats and non-octal values ***\n";

// defining array of octal formats
$formats = 
  '%o %+o %-o 
   %lo %Lo %4o %-4o
   %10.4o %-10.4o %.4o 
   %\'#2o %\'2o %\'$2o %\'_2o
   %3$o %4$o %1$o %2$o';

// Arrays of non octal values for the format defined in $format.
// Each sub array contains non octal values which correspond to each format in $format
$args_array = varray[

  // array of float values
  varray[2.2, .2, 10.2,
        123456.234, 123456.234, -1234.6789, +1234.6789,
        2e10, +2e12, 22e+12,
        12345.780, 12.000000011111, -12.00000111111, -123456.234,
        3.33, +4.44, 1.11,-2.22 ],

  // array of int values
  varray[2, -2, +2,
        123456, 123456234, -12346789, +12346789,
        123200, +20000, 22212,
        12345780, 1211111, -12111111, -12345634,
        3, +4, 1,-2 ],

  // array of strings
  varray[" ", ' ', 'hello',
        '123hello', "123hello", '-123hello', '+123hello',
        "\12345678hello", "-\12345678hello", 'h123456ello',
        "1234hello", "hello\0world", "NULL", "true",
        "3", "4", '1', '2'],

  // different arrays
  varray[ varray[0], varray[1, 2], varray[-1, -1],
         varray["123"], varray['123'], varray['-123'], varray["-123"],
         varray[true], varray[false], varray[FALSE],
         varray["123hello"], varray["1", "2"], varray['123hello'], darray[12=>"12twelve"],
         varray["3"], varray["4"], varray["1"], varray["2"] ],

  // array of boolean data
  varray[ true, TRUE, false,
         TRUE, 0, FALSE, 1,
         true, false, TRUE,
         0, 1, 1, 0,
         1, TRUE, 0, FALSE],
  
];
 
// looping to test vprintf() with different octal formats from the above $format array
// and with non-octal values from the above $args_array array
$counter = 1;
foreach($args_array as $args) {
  echo "\n-- Iteration $counter --\n";
  $result = vprintf($formats, $args);
  echo "\n";
  var_dump($result);
  $counter++;
}

echo "===DONE===\n";
}