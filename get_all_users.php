<?php
 
 
// array for JSON response
$response = array();
 
// include db connect class
require_once 'db_connect.php';


   // Check connection
   if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
   }
   //echo "Connected successfully";

   mysqli_select_db($conn, "u890009820_dbusr") or die(mysql_error());

   $sql = "SELECT * FROM User";
   $result = mysqli_query($conn, $sql) or die(mysql_error());
    $response["users"] = array();

    while ($row = mysqli_fetch_array($result)) {
        $user = array();
        $user["username"] = $row["username"];
        $user["full_Name"] = $row["full_Name"];
        $user["email"] = $row["email"];
        $user["admin"] = $row["admin"];
        
        // push single product into final response array
        array_push($response["users"], $user);
   }         
    // echoing JSON response
    echo json_encode($response);
    mysqli_close($conn);
?>