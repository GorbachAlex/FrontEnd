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
<span class="short2">&#8855;</span>
*/
$rezult_str = "";
foreach(file("auth.src") as $k){
		$k=rtrim($k);
		list($l,$p,$ip,$gr)=explode(" ",$k);
		$rezult_str = $rezult_str . '<div><span class="long1" >'.$l.'</span>
		<span class="long2">'.$p.' </span>
		<span class="long3">'.$ip.' </span>
		<span class="short1">'.$gr.'</span></div>';
	}	
 
// Сохраняем в базу данных 
 


echo ($rezult_str);


?>