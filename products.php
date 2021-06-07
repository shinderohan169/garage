<?php
require 'commondb.php';

if(isset($_GET['did'])){
    $id=$_GET['did'];
   $sql1= "DELETE FROM `products` WHERE id=$id";
   if(mysqli_query($conn, $sql1)){
    echo "done";
    echo '<script type="text/javascript">
         window.location = "products.php"
     </script>';
    }else{
    echo mysqli_error($conn);
    }
}
require 'header.php';

$sql="SELECT * FROM `products`";
$result=mysqli_query($conn,$sql);


?>


<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                        <h5 class="font-strong mb-4">PRODUCTS LIST</h5>
                        <div class="flexbox mb-4">
                           <div class="flexbox"> 
                               <div class="input-group-icon input-group-icon-left mr-3">
                                    <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                    <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
                                </div>
                            </div>
                            <div class="flexbox">
                                
                                <a class="btn btn-rounded btn-primary btn-air" href="createproduct.php">Add Product</a>
                            </div>
                        </div>
                        <div class="table-responsive row">
                            <table class="table table-bordered table-hover" id="products-table">
                                <thead class="thead-default thead-lg">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i =1;
                                if(mysqli_num_rows($result)>0){
                                    while ($row = mysqli_fetch_array($result) ) {
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td>
                                            <a class="text-light mr-3 font-16"  href="editproduct.php?id=<?php echo $row['id']?>"><i class="ti-pencil"></i></a>
                                            <a class="text-light font-16" href="products.php?did=<?php echo $row['id']?>" ><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php $i++;
                                } } ?>

                                   
                                   
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->



<?php
require 'footer.php';
?>
<script type="text/javascript">
    var d = document.getElementById('products');
    d.className += " active";
</script>