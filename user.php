<?php

//for user interface part
//for stopping bypass
include_once'connectdb.php';
session_start();

if($_SESSION['useremail']=="")// session variable a value na thakle index ei thakbe onno kothaw bypass hobe na
{
    header('location:index.php');
}





include_once'headeruser.php';

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Dashboard
        <small>You are precious to us</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
include_once'footer.php';
?>
  
