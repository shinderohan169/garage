<?php
require 'header.php';
require 'commondb.php';

if (isset($_POST['submit'])) {

    $img   = $_FILES['img']['name'];
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phn   = $_POST['phn'];
    $add   = $_POST['add'];

    $expimg     = explode('.', $img);
    $imgexttype = $expimg[1];

    date_default_timezone_set('Asia/Kolkata');
    $date = date('m/d/Yh:i:sa', time());

    $rand    = rand(10000, 99999);
    $encname = $date . $rand;
    $imgname = md5($encname) . '.' . $imgexttype;
    $imgpath = "uploads/" . $imgname;
    move_uploaded_file($_FILES["img"]["tmp_name"], $imgpath);

    $sql = "INSERT INTO `workers` (`id`, `image`, `name`, `email`, `phone`, `address`) VALUES (NULL, '$imgname', '$name', '$email', '$phn', '$add')";

    if (mysqli_query($conn, $sql)) {
        echo "done";

//create user
        $lastworker    = mysqli_query($conn, 'SELECT * FROM `workers` ORDER BY ID DESC LIMIT 1');
        $workerdetails = mysqli_fetch_array($lastworker);
        $wid           = $workerdetails['id'];

        $pass    = password_hash($phn, PASSWORD_DEFAULT);
        $sqluser = "INSERT INTO `users` (`id`, `username`, `password`, `role`, `worker_id`) VALUES (NULL, '$email', '$pass', 'WORKER', '$wid')";
        mysqli_query($conn, $sqluser);

        echo '<script type="text/javascript">
         window.location = "workers.php"
     </script>';

    } else {
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
                            <form class="form-horizontal" action="createworker.php" method="post" enctype="multipart/form-data">
                                <div class="ibox-body">
                                <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="img">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" placeholder="Name" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                         <input class="form-control" type="text" placeholder="Email address" name="email">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" placeholder="Phone" name="phn">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 row">
                                        <label class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" placeholder="Address" name="add">
                                        </div>
                                    </div>


                                </div>
                                <div class="ibox-footer row">
                                    <div class="col-sm-10 ml-sm-auto">
                                        <button class="btn btn-primary mr-2" type="submit" name="submit" vaule="submit">Add</button>
                                       <a href ="workers.php"><button class="btn btn-secondary" type="button">Cancel</button></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

</div>
<?php
require 'footer.php';
?>
<script type="text/javascript">
    var d = document.getElementById('workers');
    d.className += " active";
</script>