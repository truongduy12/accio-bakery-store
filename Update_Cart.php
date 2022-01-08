<?php 
if(!isset($_SESSION['email']) || !isset($_GET["id"]) || !isset($_GET["proid"]) || !isset($_GET["qty"])){
    echo '<meta http-equiv="refresh" content="0;URL=index.php">';
}
else{
    include_once("connection.php");
    $id = $_GET["id"];
    $proid = $_GET["proid"];
    $oldqty = $_GET["qty"];
?>


<form id="form-update-qty" name="update-qty" method="POST" class="form-horizontal" role="form">
    <div class="form-group">
        <label for="txtQty" class="control-label">Quantity:</label>
        <div class="col">
            <input type="number" name="txtQty" id="txtQty" class="form-control" min="1" max="99"
            value='<?php if(!isset($_POST['txtQty'])) echo $oldqty; else echo $_POST['txtQty']; ?>'>
        </div>
    </div>
    <div class="form-group">
        <div class="col">
            <input type="submit" name="txtUpdate" id="txtUpdate" class="btn btn-warning" value="OK">
        </div>
    </div>

<?php 
    if(isset($_POST["txtUpdate"])){
        $qty = $_POST["txtQty"];
        mysqli_query($conn, "UPDATE orderdetail SET Qty = '$qty'
        WHERE OrderID = '$id' AND Product_ID = '$proid'");
        echo '<meta http-equiv="refresh" content="0;URL=index.php?page=shopping_cart">';
    }
}
?>
</form>

