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
$f = fopen("auth.tmp", "a+"); 

$login=trim($_POST['loginfld']);

if (!empty($login))  {
	foreach(file("auth.src") as $k){
		$k=rtrim($k);
		list($l,$p,$ip,$gr)=explode(" ",$k);
		if ($l != $login ) { 
		if (!empty($l) ) {fwrite($f,"$l $p $ip $gr\r\n");}

		}
			
		}
		
 
	fclose($f);  
	$oldname = "auth_".date("YmdHis").".bak";
	rename("auth.src", $oldname);
	rename("auth.tmp","auth.src");
	return true;
	}
else {die;}

?>