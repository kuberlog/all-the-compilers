<?hh



<<__EntryPoint>>
function main_888() {
$i = 0;
 print ++$i;
 print "\t";
 print (''===true) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===true) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = true;
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === true	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===false) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===false) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = false;
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === false	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===1) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===1) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = 1;
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === 1	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===0) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===0) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = 0;
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === 0	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===-1) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===-1) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = -1;
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === -1	";
 print "\n";
 print ++$i;
 print "\t";
 print (''==='1') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ==='1') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '1';
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === '1'	";
 print "\n";
 print ++$i;
 print "\t";
 print (''==='0') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ==='0') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '0';
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === '0'	";
 print "\n";
 print ++$i;
 print "\t";
 print (''==='-1') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ==='-1') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '-1';
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === '-1'	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===null) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===null) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = null;
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === null	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===darray[]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===darray[]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray[];
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === array()	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===varray[1]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===varray[1]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[1];
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === array(1)	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===varray[2]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===varray[2]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[2];
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === array(2)	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===varray['1']) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===varray['1']) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray['1'];
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === array('1')	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===darray['0' => '1']) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===darray['0' => '1']) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['0' => '1'];
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === array('0' => '1')	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===varray['a']) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===varray['a']) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray['a'];
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === array('a')	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===darray['a' => 1]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===darray['a' => 1]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['a' => 1];
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === array('a' => 1)	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===darray['b' => 1]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===darray['b' => 1]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['b' => 1];
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === array('b' => 1)	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===darray['a' => 1, 'b' => 2]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===darray['a' => 1, 'b' => 2]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = darray['a' => 1, 'b' => 2];
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === array('a' => 1, 'b' => 2)	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===varray[darray['a' => 1]]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===varray[darray['a' => 1]]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[darray['a' => 1]];
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === array(array('a' => 1))	";
 print "\n";
 print ++$i;
 print "\t";
 print (''===varray[darray['b' => 1]]) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ===varray[darray['b' => 1]]) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = varray[darray['b' => 1]];
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === array(array('b' => 1))	";
 print "\n";
 print ++$i;
 print "\t";
 print (''==='php') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ==='php') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = 'php';
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === 'php'	";
 print "\n";
 print ++$i;
 print "\t";
 print (''==='') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = '';
 print ($a ==='') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '';
 print (''===$b) ? 'Y' : 'N';
 print ($a ===$b) ? 'Y' : 'N';
 print "\t";
 print "'' === ''	";
 print "\n";
}