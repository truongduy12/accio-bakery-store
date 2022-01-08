<?php 
    if(!isset($_SESSION['email']))
    {
        echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    }
    else{
?>

<div class="container">
    <form name="shopping-cart" method="POST">
        <h2>My Shopping Cart</h2>
        <table id="tablecart" class="table table stripped table-bordered" cellspacing="0" width="100%">
            <thead>
                <th><strong>Order ID</strong></th>
                <th><strong>Product Name</strong></th>
                <th><strong>Quantity</strong></th>
                <th><strong>Status</strong></th>
            </thead>

            <tbody>
                <?php 
                    include_once("connection.php");
                    $email = $_SESSION['email'];
                    $rs = mysqli_query($conn, "SELECT o.OrderID, Product_Name, o.Status, Qty
                    FROM product AS p, orderdetail AS od, `order` AS o
                    WHERE p.Product_ID = od.Product_ID AND od.OrderID = o.OrderID
                    AND Email = '$email' AND o.Status != 0 GROUP BY OrderID, Product_Name");
                    while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC))
                    {
                ?>
                <tr>
                    <td> <?php echo $row['OrderID']; ?> </td>
                    <td> <?php echo $row['Product_Name']; ?> </td>
                    <td> <?php echo $row['Qty']; ?> </td>
                    <td> <?php if($row['Status'] == -1) echo '<span style="color: red">Canceled</span>';
                        elseif($row['Status'] == 0) echo '<span style="color: gray">In Cart</span>';
                        elseif($row['Status'] == 1) echo '<span style="color: orange">Delivering</span>';
                        else echo '<span style="color: green">Finished</span>'; ?> </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </form>
</div>
<?php 
    }
    ?>