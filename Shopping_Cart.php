<?php 
    if(!isset($_SESSION['email']))
    {
        echo '<meta http-equiv="refresh" content="0;URL=index.php?page=login">';
    }
    else{
?>

<div class="container">
    <form name="shopping-cart" method="POST">
        <h2>My Shopping Cart</h2>
        <table id="tablecart" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <th><strong>Product Name</strong></th>
                <th><strong>Image</strong></th>
                <th><strong>Quantity</strong></th>
                <th><strong>Sub Total</strong></th>
                <th><strong>Edit Quantity</strong></th>
                <th><strong>Remove</strong></th>
            </thead>

            <tbody>
                <?php 
                    include_once("connection.php");
                    $email = $_SESSION['email'];
                    $rs = mysqli_query($conn, "SELECT Product_Name, Qty, Price, o.OrderID, p.Product_ID, Product_Img 
                    FROM product AS p, orderdetail AS od, `order` AS o
                    WHERE p.Product_ID = od.Product_ID AND od.OrderID = o.OrderID
                    AND Email = '$email' AND o.Status = 0");
                    while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC))
                    {
                ?>
                <tr>
                    <td> <?php echo $row['Product_Name']; ?> </td>
                    <td> <img width="50" height="50" src='product-imgs/<?php echo $row["Product_Img"]; ?>'></td>
                    <td> <?php echo $row['Qty']; ?> </td>
                    <td> <?php echo $row['Price']*$row['Qty']; ?> </td>
                    <td style="text-align: center;">
                            <a style='color: orange; font-size:100%;' href="index.php?page=update_cart&&id=<?php echo $row["OrderID"]; ?>&&proid=<?php echo $row["Product_ID"]; ?>
                            &&qty=<?php echo $row["Qty"]; ?>"><i class="fas fa-edit"></i></a>
                    </td>
                    <td style="text-align: center;">
                    <a style='color: orange; font-size:100%;' onclick="return deleteConfirm()" href="index.php?page=shopping_cart&&function=DeleteCart&&id=<?php echo $row["OrderID"]; ?>&&proid=<?php echo $row["Product_ID"]; ?>">
                    <i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </form>
</div>
<script>
    function deleteConfirm(){
        if(confirm("Are you sure to remove this product?")){
            return true;
        }
        else{
            return false;
        }
    }
</script>
<?php
    if(isset($_GET['function'])=="DeleteCart"){
        if(isset($_GET["id"]) && isset($_GET["proid"])){
            $id = $_GET["id"];
            $proid = $_GET["proid"];
            mysqli_query($conn, "DELETE FROM orderdetail WHERE orderID = '$id' AND
            Product_ID = '$proid'");
            echo '<meta http-equiv="refresh" content="0;URL=index.php?page=shopping_cart">';
        }
    }
?>
        <hr style=" border-width: 3px">
        <div class="container">
            <?php                    
                $total = 0;
                    $sql = mysqli_query($conn,"SELECT OrderID FROM `order` WHERE Email = '$email' AND Status = 0");
                    if(mysqli_num_rows($sql) == 0){
                        echo '<div align="right">Cart is empty <a href="index.php?page=product" class="btn btn-warning">Pick some now!</a></div>';
                    }
                    else{
                        $row1 = mysqli_fetch_array($sql, MYSQLI_ASSOC);
                        $orderid = $row1['OrderID'];
                        $sql1 = "SELECT o.Product_ID, Qty, Price FROM
                        orderdetail AS o, product AS p WHERE o.Product_ID = p.Product_ID AND OrderID = '$orderid'";
                        $rrs = mysqli_query($conn,$sql1);
                        while($row1 = mysqli_fetch_array($rrs, MYSQLI_ASSOC)){
                            $total = $total + $row1['Qty']*$row1['Price'];
                        }
                        echo '<div align="right"><strong>Total: </strong>$' . $total . '</div>';
                        ?>
            <div class="row" style="width: 100%">
                <div class="col-lg-6" style="text-algin: left">
                    <a href="index.php?page=product" class="btn btn-warning">Back to Product List</a>
                </div>
                <div class="col-lg-6" style="text-align: right">
                    <a class="btn btn-warning" href="index.php?page=checkout&&total=<?php echo $total; ?>&&id=<?php echo $orderid; ?>">Order Now</a>
                </div>
            </div>
        <?php
                    }
                    
                    
            ?>
    </div>
        <?php
    }
    ?>
            