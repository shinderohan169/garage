<?php
require 'commondb.php';
if (isset($_POST['submit'])) {
session_start();

    $idate  = $_POST['idate'];
    $cname = $_POST['cname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $invoiceid = 1001;
    $lastrecord = mysqli_query($conn, 'SELECT * FROM invoice ORDER BY ID DESC LIMIT 1');
    if(mysqli_num_rows($lastrecord) > 0) {
      while ($record = mysqli_fetch_array($lastrecord)) {
        $invoiceid = explode("-", $record['invoice_no'])[1] + 1;
      }
    }
    $invoiceno = "INV-" . $invoiceid;

    $items = "";
    for ($x=0; $x < sizeof($_POST['item_name']); $x++) { 
      $items = $items . "-" . $_POST['item_name'][$x];
    }
    $itemq = "";
    for ($x=0; $x < sizeof($_POST['order_item_quantity']); $x++) { 
      $itemq = $itemq . "-" . $_POST['order_item_quantity'][$x];
    }
    $itemp = "";
    for ($x=0; $x < sizeof($_POST['order_item_price']); $x++) { 
      $itemp = $itemp . "-" . $_POST['order_item_price'][$x];
    }
    $itemamt = "";
    for ($x=0; $x < sizeof($_POST['order_item_actual_amount']); $x++) { 
      $itemamt = $itemamt . "-" . $_POST['order_item_actual_amount'][$x];
    }

    $finaltotal = $_POST['final_total_amt'];
    $worker_id = $_SESSION['worker_id'];

    $sql = "INSERT INTO `invoice`(`id`, `invoice_date`, `c_name`, `phone`, `email`, `address`, `invoice_no`, `products`, `product_price`, `product_qty`, `product_totals`, `total`, `worker_id`) VALUES (NULL , '$idate', '$cname', '$phone', '$email', '$address', '$invoiceno', '$items', '$itemp', '$itemq', '$itemamt', '$finaltotal', '$worker_id')";

    echo "Creating Invoice...";

    if (mysqli_query($conn, $sql)) {
        echo "done";
        echo '<script type="text/javascript">
         window.location = "invoice.php"
     </script>';
    } else {
        echo mysqli_error($conn);
    }
} else {

require 'header.php';

$sql = "SELECT * FROM `products`";
$result=mysqli_query($conn,$sql);

?>

<link href="assets/css/select2.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.css">


<div class="content-wrapper">
<div class="col-md-12" style="margin-top: 25px;">

      <div class="ibox ibox-fullheight">
          <div class="ibox-head">
              <div class="ibox-title">Create Invoice</div>
          </div>
          <form class="form-horizontal" action="createinvoice.php" method="post" enctype="multipart/form-data">
              <div class="ibox-body">
                  <div class="form-group mb-4 row">
                      <label class="col-sm-2 col-form-label">Invoice Date</label>
                      <div class="col-sm-10">
                          <input class="form-control datepicker" type="text" placeholder="Date" name="idate">
                      </div>
                  </div>
                  <div class="form-group mb-4 row">
                      <label class="col-sm-2 col-form-label">Customer Name</label>
                      <div class="col-sm-10">
                          <input class="form-control" type="text" placeholder="Name" name="cname">
                      </div>
                  </div>
                  <div class="form-group mb-4 row">
                      <label class="col-sm-2 col-form-label">Phone</label>
                      <div class="col-sm-10">
                          <input class="form-control" type="text" placeholder="Phone" name="phone">
                      </div>
                  </div>
                  <div class="form-group mb-4 row">
                      <label class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                          <input class="form-control" type="text" placeholder="Email" name="email">
                      </div>
                  </div>
                  <div class="form-group mb-4 row">
                      <label class="col-sm-2 col-form-label">Address</label>
                      <div class="col-sm-10">
                       <textarea class="form-control" name="address"></textarea>
                      </div>
                  </div>
              <style type="text/css">
                .select2-selection__rendered{
                  margin-top: -10px;
                }
                .select2-selection__arrow{
                  margin-top: 10px;
                }
                .select2-container--open .select2-dropdown--below {
                  width: 170px !important;
                }
              </style>
              <div style="overflow-x: scroll">
                  <table id="invoice-item-table" class="table table-bordered" style="max-width: auto; width: auto;">
                    <tr>
                      <th>Sr No.</th>
                      <th width="300px">Item Name</th>
                      <th width="200px">Quantity</th>
                      <th width="200px">Price</th>
                      <th width="200px">Total Amount</th>
                    </tr>
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                    <tr>
                      <td><span id="sr_no">1</span></td>
                      <td>
                        <select class="form-control select21" onchange="setValues(this.value, 1)" name="item_name[]" id="item_name1">
                          <option value=" ">---SELECT---</option>
                          <?php 
                            while ($row = mysqli_fetch_array($result) ) {
                          ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td>
                        <select name="order_item_quantity[]" onchange="changeQuantity(this.value, 1)" id="order_item_quantity1" class="form-control select22">
                          <?php
                            for ($i=0; $i < 10; $i++) { 
                          ?>
                            <option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
                          <?php
                            }
                          ?>
                        </select>
                      </td>
                      <td><input type="text" name="order_item_price[]" id="order_item_price1" class="form-control" style="width: 150px;" readonly /></td>
                      <td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount1" class="form-control" style="width: 150px" readonly /></td>
                      <td></td>
                    </tr>
                  </table>
                  <div align="right">
                    <button type="button" name="add_row" id="add_row" class="btn btn-success btn-xs">+</button>
                  </div>

                  <table style="float: right;">
                    <tr>
                      <td align="right" width="20%"><b>Total</td>
                      <td align="right" width="20%"><b><input type="text" class="form-control" name="final_total_amt" id="final_total_amt" value="0" readonly style="width: 100px; margin-right: 10px;"></b></td>
                    </tr>
                  </table>

                </div>
                <div class="ibox-footer row">
                    <div class="col-sm-10 ml-sm-auto">
                        <button class="btn btn-primary mr-2" type="submit" name="submit" vaule="submit">Add</button>
                       <a href ="invoice.php"><button class="btn btn-secondary" type="button">Cancel</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
  <script type="text/javascript" src="assets/js/jquery-3.3.1.js"></script>
  <script type="text/javascript" src="assets/js/select2.js"></script>
  <script type="text/javascript" src="assets/js/select2.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">

    $('.select21').select2();
    $('.select22').select2();
$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    todayHighlight: true
});

    function initializeSelect2(s1, s2){
      
      $("head").append($("<link rel='stylesheet' href='assets/css/select2.css' type='text/css' media='screen' />"));
        $.getScript("assets/js/jquery-3.3.1.js", function () {
            $.getScript("assets/js/select2.min.js", function () { 
                $('#'+s1).select2();
                $('#'+s2).select2();
            });
        });
    }


  var final_total_amt = $('#final_total_amt').val();
  var count = 1;

  $(document).on('click', '#add_row', function(){
          count++;
          $('#total_item').val(count);

          let itemoptions = $('#item_name1').html();
          let qoptions = $('#order_item_quantity1').html();

          var html_code = '';
          html_code += '<tr id="row_id_'+count+'">';
          html_code += '<td><span id="sr_no">'+count+'</span></td>';

          html_code += '<td><select class="form-control select21'+count+'" onchange="setValues(this.value, '+count+')" name="item_name[]" id="item_name'+count+'">'+itemoptions+'</select></td>';

          html_code += '<td><select name="order_item_quantity[]" id="order_item_quantity'+count+'" class="form-control select21'+count+'" onchange="changeQuantity(this.value, '+count+')">'+qoptions+'</select></td>';

          html_code += '<td><input type="text" name="order_item_price[]" id="order_item_price'+count+'" data-srno="'+count+'" class="form-control" readonly /></td>';
          html_code += '<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount'+count+'" data-srno="'+count+'" class="form-control" readonly /></td>';

          html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td>';
          html_code += '</tr>';
          $('#invoice-item-table').append(html_code);

          initializeSelect2('item_name'+count, 'order_item_quantity'+count);

        });


        $(document).on('click', '.remove_row', function(){
          var row_id = $(this).attr("id");
          var total_item_amount = $('#order_item_actual_amount'+row_id).val();
          var final_amount = $('#final_total_amt').val();
          var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
          $('#final_total_amt').val(result_amount);
          $('#row_id_'+row_id).remove();
          count--;
          $('#total_item').val(count);
        });



</script>

<script type="text/javascript">

  function setValues(v, row) {
    $.post("ajaxreq.php", {action: "getPrice", pid: v}, function(result){
      let q = $('#order_item_quantity'+row).val();

      if(q.length > 0){
        $('#order_item_price'+row).val(result);
        $('#order_item_actual_amount'+row).val(result * q); 

          var final_amount = $('#final_total_amt').val();
          var result_amount = parseFloat(final_amount) + parseFloat(result * q); 
          $('#final_total_amt').val(result_amount);
      }else{
        $('#order_item_price'+row).val(result);
        $('#order_item_actual_amount'+row).val(result);  

          var final_amount = $('#final_total_amt').val();
          var result_amount = parseFloat(final_amount) + parseFloat(result);
          $('#final_total_amt').val(result_amount);
      }

    });
  }

  function changeQuantity(q, row) {
    let v = $('#order_item_price'+row).val();
    let aamt = $('#order_item_actual_amount'+row).val();
    $('#order_item_actual_amount'+row).val(v * q);

          var final_amount = $('#final_total_amt').val();
          var result_amount = parseFloat(final_amount) - parseFloat(aamt) + parseFloat(v * q) ;
          $('#final_total_amt').val(result_amount);
  }
</script>

<?php
require 'footer.php';
}
?>
<script type="text/javascript">
    var d = document.getElementById('invoice');
    d.className += " active";
</script>