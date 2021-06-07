<?php
require 'header.php';
require 'commondb.php'
?>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="row mb-4">
                    <div class="col-lg-6 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4" data-percent="73" data-bar-color="#18C5A9" data-size="80" data-line-width="8">
                                    <span class="easypie-data text-success" style="font-size:32px;"><i class="la la-users"></i></span>
                                </div>
                                <div>
                                <?php
                                    $invoicecount;
                                    if($_SESSION['role'] == "WORKER") {
                                        $worker_id = $_SESSION['worker_id'];
                                        $invoicecount = mysqli_query($conn, "SELECT COUNT(id) FROM `invoice` WHERE `worker_id` = '$worker_id'");
                                    }else{
                                        $invoicecount = mysqli_query($conn, "SELECT COUNT(id) FROM `invoice`");
                                    }
                                    $count = mysqli_fetch_array($invoicecount);
                                ?>

                                    <h3 class="font-strong text-success"><?php echo $count[0] ?></h3>
                                    <div class="text-muted">TOTAL CUSTOMERS</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if($_SESSION['role'] == "ADMIN") {
                    ?>
                    <div class="col-lg-6 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4" data-percent="42" data-bar-color="#5c6bc0" data-size="80" data-line-width="8">
                                    <span class="easypie-data font-26 text-primary"><i class="ti-world"></i></span>
                                </div>
                                <div>
                                    <?php 
                                    $invoicecount = mysqli_query($conn, "SELECT COUNT(id) FROM `invoice`");
                                    $count = mysqli_fetch_array($invoicecount);
                                    ?>
                                    <h3 class="font-strong text-primary"><?php echo $count[0] ?></h3>
                                    <div class="text-muted">TOTAL WORKERS</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    }
                    ?>
                    <!-- <div class="col-lg-6 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4" data-percent="70" data-bar-color="#ff4081" data-size="80" data-line-width="8">
                                    <span class="easypie-data text-pink" style="font-size:32px;"><i class="la la-tags"></i></span>
                                </div>
                                <div>
                                    <h3 class="font-strong text-pink">210</h3>
                                    <div class="text-muted">SUPPORT TICKETS</div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-body" >
                                <h5 class="font-strong mb-4">
                                    <?php if($_SESSION['role'] == "WORKER") { ?>
                                        YOUR ACTIVITY
                                    <?php } else { ?>   
                                        ALL USER ACTIVITY
                                    <?php } ?>
                                    <a href="invoice.php"><button style="float: right;" class="btn btn-sm btn-primary">View All Invoices</button></a>
                                </h5>
                                <ul class="timeline" style="max-height: 700px; overflow-y: scroll;">

            <?php 


            if($_SESSION['role'] == "WORKER") {
                $worker_id = $_SESSION['worker_id'];
                $allinvoices = mysqli_query($conn, "SELECT * FROM `invoice` WHERE `worker_id` = '$worker_id' ORDER BY id DESC");
            }else{
                $allinvoices = mysqli_query($conn, "SELECT * FROM `invoice` ORDER BY id DESC");
            }

            

            while ($row = mysqli_fetch_array($allinvoices)) {
            ?>
                                    <li class="timeline-item">
                                        
                                        <a href="invoice.php"><span class="timeline-point"></span><?php echo $row['c_name']; ?></a><small class="float-right ml-2 nowrap"><?php echo $row['created_at']; ?></small>
                                        
                                    </li>
            <?php
            }
            ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
               
   <?php
   require 'footer.php';
   ?>
<script type="text/javascript">
    var d = document.getElementById('dashboard');
    d.className += " active";
</script>