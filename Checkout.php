<?php 
    if(!isset($_SESSION['email']))
    {
        echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    }
    else{
?>
<div class="container">
    <div class="row">
        <?php  
            $email = $_SESSION['email'];
            if(isset($_GET['total']) && isset($_GET['id'])){
                $total = $_GET['total'];
                $id = $_GET['id'];
                $sq = mysqli_query($conn, "SELECT * FROM customer WHERE Email = '$email'");
                $row = mysqli_fetch_array($sq, MYSQLI_ASSOC);
                $name = $row['Fullname'];
                $tel = $row['Telephone'];
                $addr = $row['Address'];
            ?>
    </div>
    <h3>Customer Information</h3>
<div style="list-style-type: none;">
            <li>Name: <?php echo $name; ?></li>
            <li>Phone Number: <?php echo $tel; ?> <a href="index.php?page=update_info"> Edit</a></li>
            <li>Address: <?php echo $addr; ?><a href="index.php?page=update_info"> Edit</a></li>
</div>
    <form method="post">
        <h3>Payment Method</h3>
        <input type="radio" id="COD" name="payment" value="COD" checked>
        <label for="COD">Cash On Delivery (COD)</label><br>
        <input type="radio" id="PayPal" name="payment" value="PayPal">
        <label for="PayPal">PayPal</label>
<div class="row">
            <div class="col-sm-6">
                <strong>TOTAL PAID: $<?php echo $total; ?></strong>
            </div>
            <div class="col-sm-6" align="right">
                <button type="submit" class="btn btn-warning" name="btnConfirm" align="right">SUBMIT</button>
            </div>
</div>
    </form>
          <?php
                if(isset($_POST['btnConfirm'])){
                        $odate = date("Y-m-d H:i:s");
                        $dateadd = strtotime("+1 day");
                        $ddate = date("Y-m-d H:i:s", $dateadd);
                        mysqli_query($conn,"UPDATE `order` SET 
                        OrderDate = '$odate', DeliveryDate = '$ddate', Status = 1
                        WHERE OrderID = '$id'");
                        echo '<meta http-equiv="refresh" content="0;URL=index.php?page=order_history">';
                }
    ?>

</div>
<?php
            }
        }
    ?>