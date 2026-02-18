<?php
$username =$_POST['u'];
$password =$_POST['p'];
if (!empty($username))
{
if (!empty($password))
{
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "blood_information";
// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_error())
{
die('Connect Error ('. mysqli_connect_errno() .') '
. mysqli_connect_error());
}
else
{
$sql = "INSERT INTO account (username, password)
values ('$username','$password')";
if ($conn->query($sql))
{
echo "New record is inserted sucessfully";
}
else
{
echo "Error: ". $sql ."
". $conn->error;
}
$conn->close();
}
}
else
{
echo "Password should not be empty";
die();
}
}
else
{
echo "Username should not be empty";
die();
}
?>