

<?php 
        if(!isset($_GET['page']) || !isset($_SESSION['isAdmin']))
        {
            echo '<h1 style="color: red"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ACCESS DENIED!</h1>';
        }
        elseif($_SESSION['isAdmin'] != 1){
            echo '<h1 style="color: red"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ACCESS DENIED!</h1>';
        }
        else{

    $err = "";

    include_once("connection.php");
    if(isset($_GET["id"]))
    {
        $orderid = $_GET["id"];
        $rs = mysqli_query($conn,"SELECT OrderID, Product_Name, Qty, Price
        FROM orderdetail AS o, product AS p WHERE o.Product_ID = p.Product_ID
        AND OrderID = '$orderid'");
        $row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
        $name = $row['Product_Name'];
        $qty = $row['Qty'];
        $price = $row['Price'];
?>

<div class="container">
    <div align="center">
        <h1 style="padding-top: 1em; padding-bottom: 1em; font-weight: bold; color: orange;">Updating Order Detail</h1>
    </div>
    <form id="update-order-detail-form" name="update-order-detail-form" method="POST" class="form-horizontal" role="form">
        <div class="form-group">
            <label for="txtID" class="control-label">Order ID:</label>
            <div class="col">
                <input type="text" name="txtID" id="txtID" class="form-control" readonly 
                value='<?php echo $orderid; ?>'>
            </div>
        </div>
        <div class="form-group">
            <label for="txtName" class="control-label">Product Name:</label>
            <div class="col">
                <input type="text" name="txtName" id="txtName" class="form-control" readonly
                value='<?php echo $name; ?>'>
            </div>
        </div>
        <div class="form-group">
            <label for="txtQty" class="control-label">Quantity: </label>
            <div class="col">
                <input type="number" name="txtQty" id="txtQty" min="1" max="99" class="form-control" placeholder="Quantity"
                value='<?php echo $qty; ?>' oninput="CalPrice()">
            </div>
        </div>
        <div class="form-group">
            <label for="txtPrice" class="control-label">Price (x1): </label>
            <div class="col">
                <input type="text" name="txtPrice" id="txtPrice" class="form-control"
                readonly value='<?php echo "$"; echo $price; ?>'> 
            </div>
        </div>
        <div class="form-group">
            <div class="col">
                <input type="submit" class="btn btn-warning" name="btnUpdate" id="btnUpdate" value="Update" />
                <input type="button" class="btn btn-warning" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='admin-index.php?page=order_detail'" />
            </div>
        </div>
    </form>
</div>

<?php 
    if(isset($_POST['btnUpdate']))
    {
        if(empty($_POST['txtQty']))
        {
            $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Quantity is required</li>';
        }
        else{
            $qty = $_POST['txtQty'];
        }
        mysqli_query($conn, "UPDATE orderdetail SET Qty = '$qty' 
        WHERE OrderID = '$orderid'");
        echo '<meta http-equiv="refresh" content="0;URL=admin-index.php?page=order_detail">';
    }
}
else{
    echo '<meta http-equiv="refresh" content="0;URL=admin-index.php?page=order_detail">';
}
?>
<div class="form-group">
    <div class="col">
        <?php echo '<div style="color: red; list-style-type: none; list-style-position: outside;">'.$err.'</div>'; ?>
    </div>
</div>

<?php
        }
        ?>
