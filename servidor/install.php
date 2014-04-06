<?php 

if(isset($_GET['key']) && !empty($_GET['key'])){
	/*mysql_connect("localhost", "gesrem", "lapassword") or die(mysql_error());
	mysql_select_db("gesrem") or die(mysql_error());
	
	$key = $_GET['key'];
	
	$consPort = mysql_query("select port from hosts where key = '".$key."'") or die(mysql_error());
	if(mysql_num_rows($consPort)==1){
		$resPort = mysql_fetch_array($consPort);
		$port = $resPort['port'];
	}else{
		echo "ERROR RETRIEVING THE PORT";
		$port = 0;
	}*/
	
?>
USUARIO=gesrem
PASSWD=Cl0udAdm1ns
SERVER=login.redaven.com
PUERTO=`wget -qO- http://login.redaven.com/puerto.php`
useradd -m -u 96 -s /bin/bash -c "Gestio Remota"  ${USUARIO}

passwd ${USUARIO} <<EOF
${PASSWD}
${PASSWD}
EOF


su -s /bin/bash ${USUARIO} -c 'ssh-keygen -N "" -f ~/.ssh/id_rsa'

wget -qO /etc/init.d/lcremote http://login.redaven.com/lcremote
sed -r -i s/changeme/$PUERTO/g /etc/init.d/lcremote

chmod +x /etc/init.d/lcremote

type chkconfig >/dev/null 2>&1 && chkconfig -f lcremote --add ;
type update-rc.d >/dev/null 2>&1 && update-rc.d -f lcremote defaults ;

CONFIG=/etc/lcremote.conf

cat << CONF > $CONFIG
USUARIO=gesrem
SERVER=login.redaven.com
PUERTO=$PUERTO
CONF


su -s /bin/bash gesrem -c 'sshpass -p 'Cl0udAdm1ns' ssh -o StrictHostKeyChecking=no gesrem@login.redaven.com echo Saltando clave RSA' && su -s /bin/bash gesrem -c 'sshpass -p 'lapassword_delservidor' ssh-copy-id -i  /home/gesrem/.ssh/id_rsa.pub  gesrem@login.redaven.com' && /etc/init.d/lcremote start
<?php
} 
?>
