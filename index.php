<?php
header('Content-Type: application/json');

$a = $_REQUEST['a'];
$b = $_REQUEST['b'];

$data = array('a' => $a, 'b' => $b);
echo json_encode($data);

$con = mysql_connect("localhost","root","85133288");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

echo "1";
mysql_select_db("mercury", $con);
echo "2";
$result = mysql_query("SELECT * FROM tbl_idpassword");
echo "3";
while($row = mysql_fetch_array($result))
  {
	  echo "!!";
  echo $row['ID ='] . " " . $row['Password = '];
  echo "<br />";
  }
echo "4";
mysql_close($con);
echo "5";
?>