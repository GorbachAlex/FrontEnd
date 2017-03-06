<?php 
// ----------------------------конфигурация-------------------------- // 
 
//---------------------------------------------------------------------- // 
/* function user_exists($login){
	global $PASSFILE;
	global $PASSFILESEP;
	global $user;
	foreach(file($PASSFILE) as $k){
		$k=rtrim($k);
		list($l,$p,$ip,$gr)=explode($PASSFILESEP,$k);
		if($login==$l){
			return true;
		}  
	}	
	return false;	
}
*/
$login=trim($_POST['loginfld']);
$pass=trim($_POST['passfld']);

if (strlen($pass)<32){$pass=md5($pass);} 

$ippost=trim($_POST['ipfld']);
$grpost=trim($_POST['grfld']);


$f = fopen("auth.tmp", "a+"); 

$login=trim($_POST['loginfld']);

foreach(file("auth.src") as $k){
		$k=rtrim($k);
		list($l,$p,$ip,$gr)=explode(" ",$k);
		if ($l != $login ) { 
		
		  if (!empty($l) ) {fwrite($f,"$l $p $ip $gr\r\n");}

		  }
			else {fwrite($f,"$l $pass $ippost $grpost\r\n");}
		}
		
 
fclose($f);  
$oldname = "auth_".date("YmdHis").".bak";
rename("auth.src", $oldname);
rename("auth.tmp","auth.src");
return true;

?>