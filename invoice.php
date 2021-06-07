<?php
require 'commondb.php';
require 'header.php';

$sql = "";
if ($_SESSION['role'] == "WORKER") {
    $worker_id = $_SESSION['worker_id'];
    $sql = "SELECT * FROM `invoice` WHERE `worker_id` = '$worker_id'";
} else {
    $sql = "SELECT * FROM `invoice`";
}
if(isset($_GET['did'])){
    $id=$_GET['did'];
   $sql1= "DELETE FROM `invoice` WHERE id=$id";
   if(mysqli_query($conn, $sql1)){
    echo "deleting... done";
    echo '<script type="text/javascript">
         window.location = "invoice.php"
     </script>';
    }else{
    echo mysqli_error($conn);
    }
}
$result = mysqli_query($conn, $sql);

?>


<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                        <h5 class="font-strong mb-4">INVOICE LIST</h5>
                        <div class="flexbox mb-4">
                           <div class="flexbox">
                               <div class="input-group-icon input-group-icon-left mr-3">
                                    <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                    <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
                                </div>
                            </div>
                            <div class="flexbox">

                                <a class="btn btn-rounded btn-primary btn-air" href="createinvoice.php">Create Invoice</a>
                            </div>
                        </div>
                        <div class="table-responsive row">
                            <table class="table table-bordered table-hover" id="products-table">
                                <thead class="thead-default thead-lg">
                                    <tr>
                                        <th>ID</th>
                                        <th>Invoice Date</th>
                                        <th>Invoice No.</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Customer Phone</th>
                                        <?php if($_SESSION['role'] == "ADMIN") { ?>
                                            <th>Worker Name</th>
                                        <?php } ?>
                                        <th>PDF</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['invoice_date']; ?></td>
                                        <td><?php echo $row['invoice_no']; ?></td>
                                        <td><?php echo $row['c_name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <?php if($_SESSION['role'] == "ADMIN") { 
                                            $worker_id = $row['worker_id'];
                                            $workerdetails = mysqli_query($conn, "SELECT * FROM `workers` WHERE `id` = '$worker_id' ORDER BY id DESC");
                                            $worker = mysqli_fetch_array($workerdetails);           
                                        ?>
                                            <th>
                                                <?php echo $worker['name'] ?>
                                            </th>
                                        <?php } ?>
                                        <td>
                                            <a href="printinvoice.php?pdf=1&id=<?php echo $row['id']; ?>&action=download"><i class="fa fa-download"></i></a>
                                        </td>
                                        <td>
                                            <a href="printinvoice.php?pdf=1&id=<?php echo $row['id']; ?>&action=view"><i class="fa fa-eye"></i>View</a>
                                            <br />
                                            <a href="invoice.php?did=<?php echo $row['id'] ?>" ><i class="ti-trash"></i>DELETE</a>
                                        </td>
                                    </tr>
                                <?php 
                                $i++;
                                }
                                }
                                ?>
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
    var d = document.getElementById('invoice');
    d.className += " active";
</script>
