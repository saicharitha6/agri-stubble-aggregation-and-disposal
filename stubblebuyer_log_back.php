<?php
  $emails = $_POST['email'];
  $password = $_POST['password'];
  $conn = new mysqli("localhost","root","","register");
  if($conn ->connect_error){
    die("Failed to connect : " .$conn ->connect_error);
  }else{

      $stmt = $conn ->prepare("select * from stubblebuyer where email = ?");
      $stmt ->bind_param("s",$emails);
      $stmt ->execute();
      $stmt_result = $stmt ->get_result();
      if($stmt_result ->num_rows > 0)
      {
        $data = $stmt_result ->fetch_assoc();
        if($data['password'] === $password and $data['email'] === $emails){

          $pagere= "<script>  window.location ='stubindex.php';</script>";
          echo $pagere;
        }else{
          $relogin= "<script>  alert('Invalid  PASSWORD'); window.location ='stubblebuyer_login.html';</script>";
          echo $relogin;
        }
      }
      else {
        // code...
        $relogin= "<script>  alert('Invalid email'); window.location ='stubblebuyer_login.html';</script>";
        echo $relogin;
      }
    }

 ?>
