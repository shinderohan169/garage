<?php
require 'header.php';
require 'commondb.php';

?>

<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-header">
        <div class="ibox flex-1">
            <div class="ibox-body">
                <div class="flexbox">
                    <div class="flexbox-b">
                        <div class="ml-5 mr-5">
                            <img class="img-circle" src="uploads/<?php echo $_SESSION['image'] ?>" alt="image" width="110" />
                        </div>
                        <div>
                            <h4><?php echo $_SESSION['name'] ?></h4>
                            <div class="text-muted font-13 mb-3">
                                <!-- <span class="mr-3"><i class="ti-location-pin mr-2"></i>New York, USA</span>
                                <span><i class="ti-calendar mr-2"></i>12.04.2018</span> -->
                            </div>
                            <div>
                                <span class="mr-3">
                                    <span class="badge badge-primary badge-circle mr-2 font-14" style="height:30px;width:30px;"><i class="ti-user"></i></span><?php echo $_SESSION['role'] ?></span>
                                <span>
                                    <!-- <span class="badge badge-pink badge-circle mr-2 font-14" style="height:30px;width:30px;"><i class="ti-cup"></i></span>Vip Status</span> -->
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-5">
            <div class="ibox">
                <div class="ibox-body">
                    <h5 class="font-strong mb-4">GENERAL INFORMATION</h5>
                    <div class="row mb-2">
                        <div class="col-6 text-muted">Full Name:</div>
                        <div class="col-6"><?php echo $_SESSION['name'] ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-muted">Role:</div>
                        <div class="col-6"><?php echo $_SESSION['role'] ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-muted">Address:</div>
                        <div class="col-6"><?php echo $_SESSION['address'] ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-muted">Phone:</div>
                        <div class="col-6"><?php echo $_SESSION['phone'] ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-muted">Email:</div>
                        <div class="col-6"><?php echo $_SESSION['username'] ?></div>
                    </div>
                </div>
            </div>
        </div>
<?php 
    if($_SESSION['role'] == "WORKER") {
?>
<style type="text/css">
::-webkit-scrollbar {
    width: 0px;  /* Remove scrollbar space */
    background: transparent;  /* Optional: just make scrollbar invisible */
}
/* Optional: show position indicator in red */
::-webkit-scrollbar-thumb {
    background: #FF0000;
}
</style>
        <div class="col-lg-7">
            <div class="ibox">
                <div class="ibox-body" >
                    <h5 class="font-strong mb-4">USER ACTIVITY</h5>
                    <ul class="timeline" style="max-height: 350px; overflow-y: scroll;">

<?php 

$worker_id = $_SESSION['worker_id'];
$allinvoices = mysqli_query($conn, "SELECT * FROM `invoice` WHERE `worker_id` = '$worker_id' ORDER BY id DESC");

while ($row = mysqli_fetch_array($allinvoices)) {
?>
                        <li class="timeline-item">
                            
                            <a href="invoice.php"><span class="timeline-point"></span><?php echo $row['c_name']; ?></a><small class="float-right text-muted ml-2 nowrap"><?php echo $row['created_at']; ?></small>
                            
                        </li>
<?php
}
?>
                    </ul>
                </div>
            </div>
        </div>
<?php
}
?>
    </div>
</div>

<?php
require 'footer.php';
?>
