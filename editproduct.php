<?php
require 'header.php';
require 'commondb.php';

$id = $_GET['id'];
$sql2="SELECT * FROM `products` WHERE id=$id";
$result=mysqli_query($conn,$sql2);



if(isset($_POST['submit']))
{
$id=$_POST['id'];
  $name=$_POST['name'];
  $price=$_POST['price'];

 




      $sql = "UPDATE `products` SET `name`='$name',`price`='$price'WHERE id=$id";

   
   
   
    

    if(mysqli_query($conn, $sql)){
    echo "done";
     echo '<script type="text/javascript">
         window.location = "products.php"
     </script>';
    }else{
    echo mysqli_error($conn);
    }
}

?>
<div class="content-wrapper">
<div class="col-md-12" style="margin-top: 25px;">

                        <div class="ibox ibox-fullheight">
                            <div class="ibox-head">
                                <div class="ibox-title">Create Product</div>
                            </div>
                             <?php
        
                                    while ($row = mysqli_fetch_array($result) ) {                        
                               
                                ?>
                            <form class="form-horizontal" action="editproduct.php" method="post" enctype="multipart/form-data">
                                <div class="ibox-body">
                                <div class="form-group mb-4 row">

                                <input class="form-control" value="<?php echo $row['id'] ?>" type="hidden" placeholder="Name" name="id">
                            
                                    </div>
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" value="<?php echo $row['name'] ?>" type="text" placeholder="Name" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Price</label>
                                        <div class="col-sm-10">
                                         <input class="form-control" type="text" value="<?php echo $row['price'] ?>" placeholder="Price" name="price">
                                        </div>
                                    </div>
                                    
                                    </div>
                                    
                                    
                                </div>
                                <div class="ibox-footer row">
                                    <div class="col-sm-10 ml-sm-auto">
                                        <button class="btn btn-primary mr-2" type="submit" name="submit" vaule="submit">Update</button>
                                       <a href ="products.php"><button class="btn btn-secondary" type="button">Cancel</button></a>
                                    </div>
                                </div>
                            </form>
                            <?php }?>
                        </div>
                    </div>

</div>
<?php
require 'footer.php';
?>