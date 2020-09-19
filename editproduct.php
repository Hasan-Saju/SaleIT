<?php


include_once'connectdb.php';
session_start();

if($_SESSION['useremail']=="" OR $_SESSION['role']=="User")
{
    header('location:index.php');
}


include_once'header.php';

$id=$_GET['id'];

$select=$pdo->prepare("select * from tbl_product where pid=$id"); 
$select->execute();

$row=$select->fetch(PDO::FETCH_ASSOC);

$id_db=$row['pid'];

$productname_db=$row['pname'];

$category_db=$row['pcategory'];

$purchaseprice_db=$row['purchaseprice'];

$saleprice_db=$row['saleprice'];

$stock_db=$row['pstock'];

$description_db=$row['pdescription'];

$productimage_db=$row['pimage'];

//print_r($row);


if(isset($_POST['btnupdate']))
{
    
    $productname_txt=$_POST['txtpname'];
    
    $category_txt=$_POST['txtselect_option'];
    
    $purchaseprice_txt=$_POST['txtprice'];
    
    $saleprice_txt=$_POST['txtsaleprice'];
    
    $stock_txt=$_POST['txtstock'];
    
    $description_txt=$_POST['txtdescription'];
    
    $f_name=$_FILES['myfile']['name'];
    
    if(!empty($f_name)){
        
        
          $f_tmp=$_FILES['myfile']['tmp_name'];
    
    $f_size=$_FILES['myfile']['size'];
    
    $f_extension=explode('.',$f_name);
    $f_extension=strtolower(end($f_extension));
    
    $f_newfile=uniqid().'.'. $f_extension;
    
    $store="productimages/".$f_newfile;
    
    if($f_extension=='jpg'|| $f_extension=='jpeg'|| $f_extension=='png'||$f_extension=='gif')
    {
        if($f_size>=1000000)
        {
            $error="Max File should be 1 MB";
            echo $error;
        }
        else 
        {
            if(move_uploaded_file($f_tmp,$store))
            {
                 $f_newfile;
                echo  "uploaded successful";
                
    if(!isset($error))
    {
        
       
         
        $update=$pdo->prepare("update tbl_product set pname=:pname,pcategory=:pcategory,purchaseprice=:pprice,saleprice=:saleprice, pstock=:pstock,pdescription=:pdescription, pimage=:pimage where pid=$id ");
        
        
        $update->bindParam(':pname',$productname_txt);
        $update->bindParam(':pcategory',$category_txt);
        $update->bindParam(':pprice',$purchaseprice_txt);
        $update->bindParam(':saleprice',$saleprice_txt);
        $update->bindParam(':pstock',$stock_txt);
        $update->bindParam(':pdescription',$description_txt);
        $update->bindParam(':pimage',$f_newfile);
        
        
        if($update->execute())
        {
            
            echo "Update product successfully";
            
        }
        else 
        {
            echo "Update product failed";
            
        }
        
        
        
    }
        
            }
        }
    }
    else
    {
        $error= "only jpg png and gif can be uploaded";
        echo $error;
    }
    
    
     
        
        
    }else {
        
        $update=$pdo->prepare("update tbl_product set pname=:pname,pcategory=:pcategory,purchaseprice=:pprice,saleprice=:saleprice, pstock=:pstock,pdescription=:pdescription, pimage=:pimage where pid=$id ");
        
        
        $update->bindParam(':pname',$productname_txt);
        $update->bindParam(':pcategory',$category_txt);
        $update->bindParam(':pprice',$purchaseprice_txt);
        $update->bindParam(':saleprice',$saleprice_txt);
        $update->bindParam(':pstock',$stock_txt);
        $update->bindParam(':pdescription',$description_txt);
        $update->bindParam(':pimage',$productimage_db);
        
        if($update->execute()){
            echo "Updated Successfully";
        }else{
            echo "Update Failed";
        }
        
        
    }
    
}





//so next time update er lekha gula auto update hoye thake

$select=$pdo->prepare("select * from tbl_product where pid=$id"); 
$select->execute();

$row=$select->fetch(PDO::FETCH_ASSOC);

$id_db=$row['pid'];

$productname_db=$row['pname'];

$category_db=$row['pcategory'];

$purchaseprice_db=$row['purchaseprice'];

$saleprice_db=$row['saleprice'];

$stock_db=$row['pstock'];

$description_db=$row['pdescription'];

$productimage_db=$row['pimage'];







?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Edit Product
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
              <h3 class="box-title"> <a href="productlist.php" class="btn btn-primary" role="button">Back to Product List</a> </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             
              <form action="" method="post" name="formproduct" enctype="multipart/form-data">
             
              <div class="box-body">
                  
                  
                                    
                  <div class="col-mid-6">
                      
                        <div class="form-group">
                  <label >Product Name</label>
              <input type="text" class="form-control" name="txtpname" value="<?php echo $productname_db ?>" placeholder="Enter Name">
                </div>
                      
                      
                       <div class="form-group">
                  <label>Category</label>
                  <select class="form-control" name="txtselect_option" required>
                      
                    <option value="" disabled select>Select Category</option>
        
                      <?php
                      $select=$pdo->prepare("select * from tbl_category order by catid desc");
                      $select ->execute();
            while($row=$select->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                    ?>
                      <option <?php if($row['category']==$category_db ){ ?> 
                              
                              selected="selected"
                              <?php }  ?>
                              >
                          
                          
                          
                          
                          <?php echo $row['category'];?></option>
                      
                      <?php
                
            }
                      
                      
                      
                      ?>
                      
                      
                      
                      
                      
                      
                      
                    
                    
                  </select>
                </div>
                      
                      
                      
                      <div class="form-group">
                  <label >Purchase Price</label>
                  <input type="number" min="1" step="1" class="form-control" value="<?php echo $purchaseprice_db;?>" name="txtprice" placeholder="Enter.." required>
                </div>
                      
                        <div class="form-group">
                  <label >Sale Price</label>
                  <input type="number" min="1" step="1" class="form-control" value="<?php echo $saleprice_db; ?>" name="txtsaleprice" placeholder="Enter.." required>
                </div>
                      
                      
                      
                      </div>
                        <div class="col-mid-6">
                      
                      <div class="form-group">
                  <label >Stock</label>
                  <input type="number" min="1" step="1" class="form-control" value="<?php echo $stock_db; ?>" name="txtstock" placeholder="Enter.." required>
                </div>
                            
                            
                             <div class="form-group">
                  <label >Description</label>
                     <textarea class="form-control" name="txtdescription" placeholder="Enter.." rows="4" > <?php echo $description_db; ?> </textarea>
                                
                 
                </div>
                            
                             <div class="form-group">
                  <label >Product Image</label>
                                 <image src="productimages/<?php echo $productimage_db ?>" class="img-responsive" width="50px" height="50px" />
                                 
                  <input type="file" class="input-group" name="myfile" >
                                  <p>Upload Image</p>
                </div>
                      
                      
                      </div>
                  
                
                  
                  
             </div>
                  
                   <div class="box-footer">
             
              

             <button type="submit" class="btn btn-warning" name="btnupdate">Update Product</button>
             
            </div>
                  
             </form>
                  
                  
            
            </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
include_once'footer.php';
?>
  
