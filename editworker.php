<?php
require 'header.php';
require 'commondb.php';

$id = $_GET['id'];
$sql2="SELECT * FROM `workers` WHERE id=$id";
$result=mysqli_query($conn,$sql2);



if(isset($_POST['submit']))
{
$id=$_POST['id'];
  $img=$_FILES['img']['name']; 
  $name=$_POST['name'];
  $email=$_POST['email'];
  $phn=$_POST['phn'];
  $add=$_POST['add'];
 


   date_default_timezone_set('Asia/Kolkata');
   $date = date('m/d/Yh:i:sa', time());

$sql ="";
   if (!empty($_FILES['img']['name'])) {
      $expimg=explode('.',$img);
      $imgexttype=$expimg[1];

      $rand=rand(10000,99999);
      $encname=$date.$rand;
      $imgname=md5($encname).'.'.$imgexttype;
      $imgpath="uploads/".$imgname;
      move_uploaded_file($_FILES["img"]["tmp_name"],$imgpath);

      $sql = "UPDATE `workers` SET `image`='$imgname',`name`='$name',`email`='$email',`phone`='$phn',`address`='$add'WHERE id=$id";

   }else{
      $sql = "UPDATE `workers` SET `name`='$name',`email`='$email',`phone`='$phn',`address`='$add'WHERE id=$id";
   }
   
   
    

    if(mysqli_query($conn, $sql)){
    echo "done";
     echo '<script type="text/javascript">
         window.location = "workers.php"
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
                                <div class="ibox-title">Create Worker</div>
                            </div>
                             <?php
        
                                    while ($row = mysqli_fetch_array($result) ) {                        
                               
                                ?>
                            <form class="form-horizontal" action="editworker.php" method="post" enctype="multipart/form-data">
                                <div class="ibox-body">
                                <div class="form-group mb-4 row">

                                <input class="form-control" value="<?php echo $row['id'] ?>" type="hidden" placeholder="Name" name="id">

                                        <label class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="img">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" value="<?php echo $row['name'] ?>" type="text" placeholder="Name" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                         <input class="form-control" type="text" value="<?php echo $row['email'] ?>" placeholder="Email address" name="email">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" value="<?php echo $row['phone'] ?>" placeholder="Phone" name="phn">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" value="<?php echo $row['address'] ?>" placeholder="Address" name="add">
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="ibox-footer row">
                                    <div class="col-sm-10 ml-sm-auto">
                                        <button class="btn btn-primary mr-2" type="submit" name="submit" vaule="submit">Update</button>
                                       <a href ="workers.php"><button class="btn btn-secondary" type="button">Cancel</button></a>
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