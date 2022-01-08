

<?php
    if(!isset($_GET['page']) || !isset($_SESSION['isAdmin']))
    {
        echo '<h1 style="color: red"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ACCESS DENIED!</h1>';
    }
    elseif($_SESSION['isAdmin'] != 1){
        echo '<h1 style="color: red"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ACCESS DENIED!</h1>';
    }
    else{
?>
    <div class="container">
<form name="order-manage" method="POST">
    <div align="center">
        <h1 style="padding-top: 1em; padding-bottom: 1em; font-weight: bold; color: orange;">Order Management</h1>
    </div>

        <table id="tableorder" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>Order ID</strong></th>
                    <th><strong>Email</strong></th>
                    <th><strong>Order Date</strong></th>
                    <th><strong>Delivery Date</strong></th>
                    <th><strong>Status</strong></th>
                    <th><strong>Update Orders</strong></th>
                    <th><strong>Order Detail</strong></th>
                </tr>
            </thead>

            <tbody>
                <?php
                    include_once('connection.php');
                    $rs = mysqli_query($conn,"SELECT * FROM `order`");
                    while($row=mysqli_fetch_array($rs, MYSQLI_ASSOC))
                   
                    {
                ?>

                    <tr>
                        <td>
                            <?php echo $row['OrderID']; ?> </td>
                        <td>
                            <?php echo $row['Email']; ?> </td>
                        <td>
                            <?php echo $row['OrderDate']; ?> </td>
                        <td>
                            <?php echo $row['DeliveryDate']; ?> </td>
                        <td>
                            <?php if($row['Status'] == -1) echo '<span style="color: red">Canceled</span>';
                        elseif($row['Status'] == 0) echo '<span style="color: gray">In Cart</span>';
                        elseif($row['Status'] == 1) echo '<span style="color: orange">Delivering</span>';
                        else echo '<span style="color: green">Finished</span>'; ?>
                        </td>
                        <td style="text-align: center;">
                            <a style='color: orange; font-size:100%;' href="admin-index.php?page=update_order&&id=<?php echo $row["OrderID"]; ?>"><i class="fas fa-edit"></i></a>
                        </td>
                        <td style="text-align: center;">
                            <a style='color: orange; font-size:100%;' href="admin-index.php?page=order_detail&&id=<?php echo $row["OrderID"]; ?>"><i class="fa fa-file"></i></a>
                        </td>
                    </tr>

                    <?php 
                    } 
                ?>
            </tbody>
        </table>
    </div>
</form>
<?php 
    }
    ?>
