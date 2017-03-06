<?php 
// ----------------------------конфигурация-------------------------- // 
 
$adminemail="simsimsim@ukr.net";  // e-mail 
$date=date("d.m.y"); // число.месяц.год 
$time=date("H:i"); // часы:минуты:секунды 
$auth_level = 2;
$auth_ip =  $_SERVER['REMOTE_ADDR'];

/*

$uname=trim($_POST["uname"]);
$uname=strip_tags($uname); // вырезаем теги
  //конвертируем специальные символы в мнемоники HTML
$uname=htmlspecialchars($uname,ENT_QUOTES);
$uname=stripslashes($uname);
$login=mysql_real_escape_string($login);
*/

//---------------------------------------------------------------------- // 
 
// Принимаем данные с формы 
 
$login=$_POST['loginfld'];
$login=trim($login);
$login=strip_tags($login);
$login=stripslashes($login);


 
$pass		=$_POST['passfld'];
$pass		=trim($pass);
$pass		=md5($pass);

$ipflag		=$_POST['ipfld'];
$auth_level =$_POST['grfld']; 

/*$ipflag = ($ipflag == "on") ? $auth_ip : "*";*/

  
  // Сохраняем в базу данных 
 

$f = fopen("auth.src", "a+"); 

fwrite($f,"$login $pass $ipflag $auth_level\r\n"); 
  
fclose($f);  



?>