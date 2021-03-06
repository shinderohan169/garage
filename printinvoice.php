<?php
//print_invoice.php
if (isset($_GET["pdf"]) && isset($_GET["id"])) {
    require_once 'pdf.php';
    include 'commondb.php';
    $output = '';
    $iid    = $_GET['id'];
    $sql    = "SELECT * FROM `invoice` WHERE `id` = '$iid'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $worker_id     = $row['worker_id'];
        $workerdetails = mysqli_query($conn, "SELECT * FROM `workers` WHERE `id` = '$worker_id'");
        $worker        = mysqli_fetch_array($workerdetails);
        $workername    = $worker['name'];

        $output .= '
   <table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
     <td colspan="2" align="center" style="font-size:18px"><b>Invoice</b></td>
    </tr>
    <tr>
     <td colspan="2">
      <table width="100%" cellpadding="5">
       <tr>
        <td width="65%">
         To,<br />
         RECEIVER (BILL TO)<br />
         Name : <b>' . $row["c_name"] . '</b><br />
         Billing Address : <b>' . $row["address"] . '</b><br />
         Email : <b>' . $row["email"] . '</b><br />
         Mobile : <b>' . $row["phone"] . '</b><br />
        </td>
        <td width="35%">
         Reverse Charge<br />
         Invoice No. : ' . $row["invoice_no"] . '<br />
         Invoice Date : ' . $row["invoice_date"] . '<br />
         Invoice Generated By : ' . $workername . '<br />
        </td>
       </tr>
      </table>
      <br />
      <table width="100%" border="1" cellpadding="5" cellspacing="0">
       <tr>
        <th>Sr No.</th>
        <th align="center">Item Name</th>
        <th align="center">Quantity</th>
        <th align="center">Price</th>
        <th align="center">Actual Amt.</th>
       </tr>';

        $products      = explode("-", $row['products']);
        $productprices = explode("-", $row['product_price']);
        $productqtys   = explode("-", $row['product_qty']);
        $producttotals = explode("-", $row['product_totals']);

        for ($count = 0; $count < sizeof($products) - 1; $count++) {
            $i              = $count + 1;
            $productid      = trim($products[$i]);
            $productdetails = mysqli_query($conn, "SELECT * FROM `products` WHERE `id` = '$productid'");
            $productrow     = mysqli_fetch_array($productdetails);
            $output .= '
   <tr>
    <td>' . $i . '</td>
    <td align="center">' . $productrow['name'] . '</td>
    <td align="center">' . $productqtys[$i] . '</td>
    <td align="center">' . $productprices[$i] . '</td>
    <td align="center">' . $producttotals[$i] . '</td>
   </tr>
   ';
        }
        $output .= '
  <tr>
   <td colspan="4"><b>Total Amount Including Tax :</b></td>
   <td align="center">' . $row["total"] . '</td>
  </tr>

  ';
        $output .= '
      </table>
     </td>
    </tr>
    <tr>
    <td colspan="2" align="right">
    <p><b>Authorized Signatory</b></p>
   </td>
    </tr>
   </table>
  ';

        $pdf       = new Pdf();
        $file_name = $row["invoice_no"] . '.pdf';
        $pdf->loadHtml($output);
        $pdf->render();
        if ($_GET['action'] == "download") {
            $pdf->stream($file_name);
        } else {
            $pdf->stream($file_name, array("Attachment" => false));
        }

    }
}
