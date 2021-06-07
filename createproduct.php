<?php
require 'header.php';
require 'commondb.php';

if(isset($_POST['submit']))
{

  $id=$_POST['id'];
  $name=$_POST['name'];
  $add=$_POST['add'];
  $phn=$_POST['phn'];
  $email=$_POST['email'];
  $occ=$_POST['occ'];
  $dfp=$_POST['dfp'];
  $amt=$_POST['amt'];
  $pan=$_POST['pan'];
  $date=$_POST['date'];
  

 
   

    $sql = "INSERT INTO `pay` (`id`, `name`, `add`, `phn`, `email`, `occ`, `dfp`, `amt`, `pan`, `date`) VALUES (NULL, '$name', '$add', '$phn', '$email', '$occ', '$dfp', '$amt', '$pan', '$date')";

    if(mysqli_query($conn, $sql)){
    echo "done";
    // echo '<script type="text/javascript">
    //      window.location = "products.php"
    //  </script>';
    }else{
    echo mysqli_error($conn);
    }
}

?>

<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.css">
<div class="content-wrapper">
<div class="col-md-12" style="margin-top: 25px;">

                        <div class="ibox ibox-fullheight">
                            <div class="ibox-head">
                                <div class="ibox-title">Donation Form</div>
                            </div>
                            <form class="form-horizontal" action="createproduct.php" method="post" enctype="multipart/form-data">
                                <div class="ibox-body">
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" placeholder="Name" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                         <input class="form-control" type="text" placeholder="Address" name="add">
                                        </div>
                                    </div>    
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Phone Number</label>
                                        <div class="col-sm-10">
                                         <input class="form-control" type="text" placeholder="Phone NO" name="phn">
                                        </div>
                                    </div>   
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Email ID</label>
                                        <div class="col-sm-10">
                                         <input class="form-control" type="text" placeholder="Email Id" name="email">
                                        </div>
                                    </div>   
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Occupation Details</label>
                                        <div class="col-sm-10">
                                         <input class="form-control" type="text" placeholder="Occupation" name="occ">
                                        </div>
                                    </div>   
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Donation For(purpose)</label>
                                        <div class="col-sm-10">
                                         <input class="form-control" type="text" placeholder="purpose" name="dfp">
                                        </div>
                                    </div>   
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Amount</label>
                                        <div class="col-sm-10">
                                         <input class="form-control" type="text" placeholder="Amount" name="amt">
                                        </div>
                                    </div> 
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Pan Number</label>
                                        <div class="col-sm-10">
                                         <input class="form-control" type="text" placeholder="Pan No" name="pan">
                                        </div>
                                    </div>    
                                    <div class="form-group mb-4 row">
                                      <label class="col-sm-2 col-form-label">Date</label>
                                       <div class="col-sm-10">
                                       <input class="form-control datepicker" type="text" placeholder="Date" name="date">
                                     </div>
                                    </div>                               
                                                                      
                                </div>
                                <div class="ibox-footer row">
                                    <div class="col-sm-10 ml-sm-auto">
                                        <button class="btn btn-primary mr-2" type="submit" name="submit" vaule="submit">Pay</button>
                                       <a href ="products.php"><button class="btn btn-secondary" type="button">Cancel</button></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

</div>
<?php
require 'footer.php';
?>

  <script type="text/javascript" src="assets/js/select2.js"></script>
  
  <script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">

    $('.select21').select2();
    $('.select22').select2();
$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    todayHighlight: true
});
    var d = document.getElementById('products');
    d.className += " active";
</script>