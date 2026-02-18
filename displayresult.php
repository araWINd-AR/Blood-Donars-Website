<?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "blood_information";
    $s = $_POST['search'];  
     
   // connect the database with the server
   $conn = new mysqli($servername,$username,$password,$dbname);
     
    // if error occurs 
    if ($conn -> connect_errno)
    {
       echo "Failed to connect to MySQL: " . $conn -> connect_error;
       exit();
    }
  
    $sql = "select * from donors_list where Blood_Group like '$s'";
    $result = ($conn->query($sql));
    //declare array to store the data of database
    $row = []; 
  
    if ($result->num_rows > 0) 
    {
        // fetch all data from db into array 
        $row = $result->fetch_all(MYSQLI_ASSOC);  
    }   
?>
  
<!DOCTYPE html>
<html>
<style>
    td,th {
        border: 1px solid black;
        padding: 10px;
        margin: 5px;
        text-align: center;
    }
</style>
  
<body><center> 
    <table border="2">
        <thead>DONORS DETAILS
            <tr>
                <th>User Name</th>
                <th>Gender</th>
                <th>Blood_Group</th>
                <th>Email</th>
                <th>Phone_no</th>
            </tr>
        </thead>
        <tbody>
            <?php
               if(!empty($row))
               foreach($row as $rows)
              { 
            ?>
            <tr>
  
                <td><?php echo $rows['Name']; ?></td>
                <td><?php echo $rows['Gender']; ?></td>
                <td><?php echo $rows['Blood_Group']; ?></td>
                <td><?php echo $rows['Email']; ?></td>
                <td><?php echo $rows['Phone_no']; ?></td>
                
  
            </tr>
            <?php } ?>
        </tbody>
    </table></center>
</body>
</html>
  
<?php   
    mysqli_close($conn);
?>