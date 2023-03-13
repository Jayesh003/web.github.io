<?php
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $message = $_POST['message'];



  if (!empty($name) || !empty($phone) || !empty($email) || !empty($message))
  {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "jayesh";


   			
  //create connection
  $conn = new mysqli($host , $dbUsername , $dbPassword , $dbname);

  if(mysqli_connect_error())
  {
    die('Connect Error (' . mysqli_connect_errno(). ')' . mysqli_connect_error());

  } 
  else
  {
    $SELECT = "SELECT email From register Where email = ? Limit 1";
    $INSERT = "INSERT INTO register (name , phone , email , message) values( ? , ? , ? , ?)";

    //prepare statement
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s" , $email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $num = $stmt->num_rows;

    if($num==0)
    {
      $stmt->close();
    

    $stmt->bind_param( "siss" , $name , $phone , $email , $message );
    $stmt->execute();
    echo " New Record inserted successfully";
  }
  else{
    echo "Someone already register using this email";
  }
  $stmt->close();
  $stmt->close();
  }
}
else
{
       echo "All field are required";
    die();
  }


   ?>

