<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>

<script src="bower_components/sweetalert/sweetalert.js"></script>

<?php
session_start();
include_once'connectdb.php';


if(isset($_POST['btn_login'])) //to check the button set or not
{
    $useremail = $_POST['txt_email']; //nicher box er lekha gula ekhane antesi, post input ney
    $password= $_POST['txt_password'];//nicher box er pass get kortesi //input 
    
   // echo $useremail." - ".$password;
    $select= $pdo->prepare("select * from tbl_user where
    useremail='$useremail' AND password='$password'"); //pdo object er jonno query
    //first one from database
    
    $select->execute(); //execute query
    $row= $select->fetch(PDO::FETCH_ASSOC);//method ta use kore value $row te nisi
    
    if($row['useremail']==$useremail AND $row['password']==$password AND $row['role']=="Admin")// erpor value milaisi msg dewar jonno
    {
        //for stopping bypass
        $_SESSION['userid']=$row['userid'];
        $_SESSION['username']=$row['username'];
          $_SESSION['useremail']=$row['useremail'];
          $_SESSION['role']=$row['role'];
        
        
        
      echo  $success="Login Successfull as Admin";
        header('refresh:1;dashboard.php');//refresh time
    }
    

    
    else if($row['useremail']==$useremail AND $row['password']==$password AND $row['role']=="User")
    {
        
         //for stopping bypass
        $_SESSION['userid']=$row['userid'];
        $_SESSION['username']=$row['username'];
          $_SESSION['useremail']=$row['useremail'];
          $_SESSION['role']=$row['role'];
        
      echo  $success="Login Successfull as User";   //ei ta comment kore dibo
        //eikhan theke jhamela
//       echo"<script type="text/javascript">
  //     jQuery(function validation(){
       
    //   swal({
  //title: "Good job!'.$_SESSION['username'].'",
  //text: "Details Matched",
  //icon: "Success",
  //button: "Loading...",
//});
       
       
  //     });
       
       
    //   </script>";
        
        //ei comment porjonto thik kora lagbe
        
        header('refresh:1;user.php');// thik korle eita 3 kore dibo
    }
    
   // else
    //{
      //    echo "Login fail";
    //}
    
    
    
    
 // return $row['useremail'];
}

?>








<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SaleIT | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Sale</b>IT</a>
  </div> 
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
<!-- sign in click korle ki hobe -->
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="txt_email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="txt_password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
           <a href="#" onclick="swal('To Get Passwprd','Please contact to Admin OR Service Provider','error');">I forgot my password</a><br>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn_login">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   
      
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
    
   
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>