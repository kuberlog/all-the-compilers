<?hh



<<__EntryPoint>>
function main_868() {
$i = 0;
 print ++$i;
 print "\t";
 print (false===true) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===true) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = true;
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === true	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===false) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===false) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = false;
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === false	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===1) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===1) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = 1;
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === 1	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===0) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===0) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = 0;
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === 0	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===-1) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===-1) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = -1;
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === -1	";
 print "\n";
 print ++$i;
 print "\t";
 print (false==='1') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ==='1') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '1';
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === '1'	";
 print "\n";
 print ++$i;
 print "\t";
 print (false==='0') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ==='0') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '0';
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === '0'	";
 print "\n";
 print ++$i;
 print "\t";
 print (false==='-1') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ==='-1') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '-1';
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === '-1'	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===null) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===null) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = null;
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === null	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===darray[]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===darray[]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray[];
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === array()	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===varray[1]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===varray[1]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[1];
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === array(1)	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===varray[2]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===varray[2]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[2];
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === array(2)	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===varray['1']) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===varray['1']) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray['1'];
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === array('1')	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===darray['0' => '1']) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===darray['0' => '1']) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['0' => '1'];
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === array('0' => '1')	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===varray['a']) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===varray['a']) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray['a'];
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === array('a')	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===darray['a' => 1]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===darray['a' => 1]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['a' => 1];
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === array('a' => 1)	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===darray['b' => 1]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===darray['b' => 1]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['b' => 1];
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === array('b' => 1)	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===darray['a' => 1, 'b' => 2]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===darray['a' => 1, 'b' => 2]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['a' => 1, 'b' => 2];
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === array('a' => 1, 'b' => 2)	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===varray[darray['a' => 1]]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===varray[darray['a' => 1]]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[darray['a' => 1]];
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === array(array('a' => 1))	";
 print "\n";
 print ++$i;
 print "\t";
 print (false===varray[darray['b' => 1]]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ===varray[darray['b' => 1]]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[darray['b' => 1]];
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === array(array('b' => 1))	";
 print "\n";
 print ++$i;
 print "\t";
 print (false==='php') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ==='php') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = 'php';
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === 'php'	";
 print "\n";
 print ++$i;
 print "\t";
 print (false==='') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = false;
 print ($a ==='') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '';
 print (false===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "false === ''	";
 print "\n";
}