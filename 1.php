<?php      
    //include('connection.php');  
    $username = $_POST['u'];  
    $password = $_POST['p'];  
      $host = "localhost";
      $dbusername = "root";
      $dbpassword = "";
     $dbname = "blood_information";
      // Create connection
      $con = new mysqli($host, $dbusername, $dbpassword, $dbname);
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select * from account where username = '$username' and password = '$password'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1)
      {  
            echo "<h1><center><a href=dataretrival.php>DONORS LIST</a><br></center></h1>";  
             echo "<h1><center><a href=searchform.html>search</a><br></center></h1>"; 

        }  
        else
{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }     
?>  