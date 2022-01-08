

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

<form name="pro-manage" method="POST">
    <div align="center">
        <h1 style="padding-top: 1em; padding-bottom: 1em; font-weight: bold; color: orange;">Product Management</h1>
    </div>
    <div>
        <button type="button" class="btn btn-warning" alt="ADD NEW PRODUCTS" style="margin-bottom: 1em;">
            <a href="admin-index.php?page=add_product" style="color:black;">ADD NEW</a>
        </button>
    </div>
    <div class="container-fluid">
        <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>Product ID</strong></th>
                    <th><strong>Product Name</strong></th>
                    <th><strong>Category</strong></th>
                    <th><strong>Description</strong></th>
                    <th><strong>Price</strong></th>
                    <th><strong>Image</strong></th>
                    <th><strong>Status</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
            </thead>
            
            <tbody>
                <?php 
                    include_once("connection.php");
                    $result = mysqli_query($conn, "SELECT Product_ID, Product_Name, Cat_Name, Description, Price,
                    Product_Img, Status FROM product AS a, category AS b
                    WHERE a.Cat_ID = b.Cat_ID ORDER BY Pro_Date DESC");
        
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                ?>
        
                <tr>
                    <td> <?php echo $row['Product_ID']; ?> </td>
                    <td> <?php echo $row['Product_Name']; ?> </td>
                    <td> <?php echo $row['Cat_Name']; ?> </td>
                    <td> <?php echo $row['Description']; ?> </td>
                    <td> <?php echo $row['Price']; ?> </td>
                    <td align='center'>
                        <a href='product-imgs/<?php echo $row['Product_Img']; ?>' target="_blank"><img src='product-imgs/<?php echo $row["Product_Img"]; ?>' border='0px' width="100px" height="100px"/></a>
                    </td>
                    <td> <?php if($row['Status'] == 0) echo '<span style="color: red">Not Available</span>'; else echo '<span style="color: green">Available</span>' ?> </td>
                    <td style='text-align: center;'>
                        <a style='color: orange; font-size:100%;' href="admin-index.php?page=update_product&&id=<?php echo $row["Product_ID"]; ?>"><i class="fas fa-edit"></i></a>
                    </td>
                    <td style='text-align: center;'>
                        <a style='color: orange; font-size:100%' href="admin-index.php?page=product_manage&&function=del&&id=<?php echo $row['Product_ID']; ?>"
                        onclick = "return deleteConfirm()"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</form>

<script>
    function deleteConfirm(){
        if(confirm("Are you sure to delete this product?")){
            return true;
        }
        else{
            return false;
        }
    }
</script>

<?php 
    if(isset($_GET['function'])=="del"){
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            mysqli_query($conn, "UPDATE product SET Status = 0 WHERE Product_ID = '$id'");
            echo '<meta http-equiv="refresh" content="0;URL=admin-index.php?page=product_manage"/>';
        }
    }
    }
    ?>