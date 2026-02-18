<?php
$Name=$_POST['n'];
$Gender=$_POST['G'];
$Blood_Group=$_POST['b'];
$Email=$_POST['E'];
$Phone_no=$_POST['p'];
if (!empty($Name))
{
if (!empty($Gender))
{
if (!empty($Blood_Group))
{
if (!empty($Email))
{
if (!empty($Phone_no)) 
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
$sql = "INSERT INTO donors_list(Name,Gender,Blood_Group,Email,Phone_no) 
values ('$Name','$Gender','$Blood_Group','$Email','$Phone_no')";
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
echo "Phone_no should not be empty";
die();
}
}
else
{
echo "Email should not be empty";
die();
}
}
else
{
echo "Blood_group should not be empty";
die();
}
}
else
{
echo "Gender should not be empty";
die();
}
}

else
{
echo "name should not be empty";
die();
}

?>