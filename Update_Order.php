

<?php 
    if(!isset($_GET['page']) || !isset($_SESSION['isAdmin']))
    {
        echo '<h1 style="color: red"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ACCESS DENIED!</h1>';
    }
    elseif($_SESSION['isAdmin'] != 1){
        echo '<h1 style="color: red"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ACCESS DENIED!</h1>';
    }
    else{

    include_once("connection.php");
    $err = "";
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $result = mysqli_query($conn,"SELECT * FROM `order` WHERE OrderID = '$id'" );
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $email = $row["Email"];
        $orderdate = $row["OrderDate"];
        $deliverydate = $row["DeliveryDate"];
        $stt = $row["Status"];
?>

<div class="container">
    <div align="center">
        <h1 style="padding-top: 1em; padding-bottom: 1em; font-weight: bold; color: orange;">Updating Order</h1>
    </div>
    <form id="update-order-form" name="update-order-form" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
        <div class="form-group">
            <label for="txtID"  class="control-label">Order ID:</label>
            <div class="col">
                <input type="text" name="txtID" id="txtID" class="form-control"
                readonly value='<?php echo $id; ?>'>
            </div>
        </div>
        <div class="form-group">
            <label for="txtEmail" class="control-label">Email:</label>
            <div class="col">
                <input type="text" name="txtEmail" id="txtEmail" class="form-control"
                readonly value='<?php echo $email; ?>'>
            </div>
        </div>
        <div class="form-group">
            <label for="txtODate" class="control-label">Order Date:</label>
            <div class="col">
                <input type="text" name="txtODate" id="txtODate" class="form-control"
                value='<?php echo $orderdate; ?>'>
            </div>
        </div>
        <div class="form-group">
            <label for="txtODate" class="control-label">Delivery Date:</label>
            <div class="col">
                <input type="text" name="txtDDate" id="txtDDate" class="form-control"
                value='<?php echo $deliverydate; ?>'>
            </div>
        </div>
        <div class="form-group">
            <label for="Status" class="control-label">Status:</label>
            <div class="col">
                <select name="Status" class="form-control">
                    <option value='<?php echo $stt; ?>' selected> 
                        <?php if($stt == -1) echo 'Canceled';
                              if($stt == 0) echo 'In Cart';
                              if($stt == 1) echo 'Delivering';
                              if($stt == 2) echo 'Finished'; 
                        ?>
                    </option>
                    <?php 
                        if($stt == -1){
                            echo '<option value="0">In cart</option>';
                            echo '<option value="1">Delivering</option>';
                            echo '<option value="2">Finished</option>';
                        }
                        if($stt == 0){
                            echo '<option value="-1">Canceled</option>';
                            echo '<option value="1">Delivering</option>';
                            echo '<option value="2">Finished</option>';
                        }
                        if($stt == 1){
                            echo '<option value="-1">Canceled</option>';
                            echo '<option value="0">In cart</option>';
                            echo '<option value="2">Finished</option>';
                        }
                        if($stt == 2){
                            echo '<option value="-1">Canceled</option>';
                            echo '<option value="0">In cart</option>';
                            echo '<option value="1">Delivering</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col">
                  <input type="submit"  class="btn btn-warning" name="btnUpdate" id="btnUpdate" value="Update"/>
                  <input type="button" class="btn btn-warning" name="btnIgnore"  id="btnIgnore" value="Ignore" onclick="window.location='admin-index.php?page=order_manage'" /> 	
            </div>
        </div>
        
    </form>
</div>
<?php
    }
    else{
        echo '<meta http-equiv="refresh" content="0;URL=admin-index.php?page=order_manage"/>';
    }

    $dateformat = "/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/";

    if(isset($_POST['btnUpdate']))
    {
        $orderdate = $_POST['txtODate'];
        $deliverydate = $_POST['txtDDate'];
        $stt = $_POST['Status'];

        if(empty($orderdate) || empty($deliverydate)){
            $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Order Date and Delivery Date are required</li>';
        }
        else if(!preg_match($dateformat,$orderdate) || !preg_match($dateformat,$deliverydate)){
            $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Order Date and Delivery Date are not in correct format</li>';
        }
        else if($orderdate > $deliverydate){
            $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Delivery Date must be greater than Order Date</li>';
        }
        if($err == ""){
            mysqli_query($conn, "UPDATE `order` SET OrderDate = '$orderdate', DeliveryDate = '$deliverydate', Status = '$stt'
            WHERE OrderID = '$id'");
            echo '<meta http-equiv="refresh" content="0;URL=admin-index.php?page=order_manage">';
        }
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