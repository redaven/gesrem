<?php
// Make a MySQL Connection
mysql_connect("localhost", "gesrem", "lapassword") or die(mysql_error());
mysql_select_db("gesrem") or die(mysql_error());

// Get a specific result from the "example" table

$result = mysql_query("Select * from hosts order by id DESC LIMIT 1");
while ($row = mysql_fetch_array($result)) {

echo $row['port'];

}
?>
