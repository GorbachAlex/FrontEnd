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

$flag =0;
foreach(file("auth.src") as $k){
		$k=rtrim($k);
		list($l,$p,$ip,$gr)=explode(" ",$k);
		if ($l == $login ) { echo ('&#10008;'); $flag =1; return;}
		

		}
			
if ($flag == 0) {echo ('&#10004;');}

?>