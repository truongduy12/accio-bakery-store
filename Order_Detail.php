

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
    if(isset($_GET["id"])){
        $id = $_GET["id"];
?>
<div class="container">
<form name="order-detail" method="POST">
    <div align="center">
        <h1 style="padding-top: 1em; padding-bottom: 1em; font-weight: bold; color: orange;">Order Detail</h1>
    </div>
    
        <table id="tabledetail" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>Order ID</strong></th>
                    <th><strong>Product</strong></th>
                    <th><strong>Quantity</strong></th>
                    <th><strong>Price (total)</strong></th>
                    <th><strong>Edit</strong></th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    $rs = mysqli_query($conn,"SELECT OrderID, Product_Name, Qty, Price
                    FROM orderdetail AS o, product AS p WHERE o.Product_ID = p.Product_ID
                    AND OrderID = '$id'");
                    while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC))
                    {
                        ?>
                <tr>
                    <td> <?php echo $row['OrderID']; ?> </td>
                    <td> <?php echo $row['Product_Name']; ?> </td>
                    <td> <?php echo $row['Qty']; ?> </td>
                    <td> <?php echo "$"; echo $row['Qty']*$row['Price']; ?> </td>
                    <td style="text-align: center;">
                            <a style='color: orange; font-size:100%;' href="admin-index.php?page=update_detail&&id=<?php echo $row["OrderID"]; ?>"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                <?php 
                    }
                }
                    else{
                        echo '<meta http-equiv="refresh" content="0;URL=admin-index.php?page=order_manage"/>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</form>
<?php 
    }
    ?>