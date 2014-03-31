<?php 

if(isset($_GET['key']) && !empty($_GET['key']) && isset($_GET['hostname']) && !empty($_GET['hostname']) && isset($_GET['ext_ip']) && !empty($_GET['ext_ip']) && isset($_GET['os']) && !empty($_GET['os'])){

	mysql_connect("bd01.redaven.com", "gesrem", "lapassdemysql") or die(mysql_error());
	mysql_select_db("gesrem") or die(mysql_error());

	$key = $_GET['key'];
	$hostname = $_GET['hostname'];
	$ext_ip = $_GET['ext_ip'];
	$os = $_GET['os'];

	$cons =  mysql_query("select port from hosts order by port desc limit 1");
	$res = mysql_fetch_array($cons);
	$port = $res['port'];
	$port = $port + 1;

	$result = mysql_query("INSERT INTO hosts(`key`, hostname, ext_ip, port, `os`) VALUES('".$key."','".$hostname."','".$ext_ip."', ".$port.", '".$os."')");
	if($result){
		echo "INSERT OK";
	}else{
		echo "ERROR: ".mysql_error();
	}
	
}else{
	echo "PARAMETER ERROR";
}

?>

