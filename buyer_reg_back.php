<?php
  $username = $_POST['username'];
  $password = $_POST['password'];
  $Gender = $_POST['Gender'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  if(!empty($username) || !empty($password) || !empty($Gender) || !empty($email) || !empty($phone))
  {
    $host = "localhost";
    $dbusername="root";
    $dbpassword="";
    $dbname="register";

    $conn= new mysqli($host,$dbusername,$dbpassword,$dbname);
    if(mysqli_connect_error())
    {
      die('Connection Failed  :'.mysqli_connect_error());
    }
    else{
      $SELECT = "SELECT email from buyer Where email= ? Limit 1";
      $INSERT = "INSERT Into buyer (username,password,Gender,email,phone) values(?, ?, ?, ?, ?)";
      $stmt = $conn ->prepare($SELECT);
      $stmt -> bind_param("s",$email);
      $stmt -> execute();
      $stmt -> bind_result($email);
      $stmt ->store_result();
      $rnum = $stmt ->num_rows;
      if($rnum==0)
      {
        $stmt ->close();
        $stmt = $conn ->prepare($INSERT);
        $stmt -> bind_param("ssssi",$username,$password,$Gender,$email,$phone);
        $stmt -> execute();
        $relogin= "<script>  alert('registration succesfully completed....'); window.location ='login.html';</script>";
        echo $relogin;

      }
      else{
        $relogin= "<script>  alert('someone already register using this email'); window.location ='Buyer_Registration.html';</script>";
        echo $relogin;
      }
      $stmt ->close();
      $conn ->close();
    }
  }
  else {
    echo "All fields are required";
    die();
  }
 ?>
