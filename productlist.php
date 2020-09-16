<?php

include_once'connectdb.php';
session_start();

if($_SESSION['useremail']=="" OR $_SESSION['role']=="User")
{
    header('location:index.php');
    
}

include_once'header.php';

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Product List
        <small>Only for Authorize Admins</small>
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
        
         <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Product List</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
             <div class="box-body">
             
               <table id="producttable" class="table table-striped">
                         
                         <thead>
                        <tr>
                            <th>#</th>
                             <th>Product Name</th>
                             <th>Category</th>
                             <th>Purchase Price</th>
                             <th>Sale Price</th>
                             <th>Stock</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        
                        </thead>
                  
                  
                  <tbody>
                  
                  <?php
                      
                      $select=$pdo ->prepare("select * from tbl_product order by pid desc");
                      
                      $select ->execute();
                      
                      while($row=$select->fetch(PDO::FETCH_OBJ) )
                      {
                          echo'
                          <tr>
                          <td>'.$row->pid.'</td>
                          <td>'.$row->pname.'</td>
                          <td>'.$row->pcategory.'</td>
                          <td>'.$row->purchaseprice.'</td>
                          <td>'.$row->saleprice.'</td>
                          <td>'.$row->pstock.'</td>
                          <td>'.$row->pdescription.'</td>
                          <td><image src="productimages/'.$row->pimage.'" class="img-rounded" width="40px" height="40px" /></td>
                         
                          <td>
                          <a href="viewproduct.php?id='.$row->pid.'" class="btn btn-success" role="button"><span class="glyphicon glyphicon-eye-open" style="color.#ffffff" data-toggle="tooltip" title="View Product"></span></a>
                          </td>
                          
                          
                          <td>
                          <a href="editproduct.php?id='.$row->pid.'" class="btn btn-info" role="button"><span class="glyphicon glyphicon-edit" style="color.#ffffff" data-toggle="tooltip" title="Edit Product"></span></a>
                          </td>
                          
                         <td>
                          <button id='.$row->pid.' class="btn btn-danger btndelete" ><span class="glyphicon glyphicon-trash" style="color.#ffffff" data-toggle="tooltip"  title="Delete Product"></span></button>
                          </td>
                          
                          
                          
                          </tr> 
                          
                          
                          
                          ';
                      }
                        
                      
                      ?>
                      
                  
                  
                  
                  
                  </tbody>
                         
                         
                         
                         
                    </table>
                  
             
             </div>
             
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
    $(document).ready( function(){
        $('#producttable').DataTable({
            
            "order":[[0,"desc"]]
            
             
        });
    } );
    </script>

<script>
      $(document).ready( function(){
          $('[data-toggle="tooltip"]').tooltip;
      });
    
    </script>









<script>

$(document).ready(function(){
    
   $('.btndelete').onclick(function(){
       
       alert('Test');
       
   });
    
    
    
});



</script>
















<?php
include_once'footer.php';
?>
  
