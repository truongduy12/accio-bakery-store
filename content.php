<div class="container">
<?php 
    include_once("connection.php");
    $rs = mysqli_query($conn,"SELECT * FROM product WHERE Cat_ID = '1' LIMIT 3 ");
    if(!$rs){
        die('Invalid query: ' . mysqli_error($conn));
    }   
?>
    <div align="center">
        <h3>Top Butter Cakes</h3>
        <hr>
    </div>
    <div class="row">
        <?php while ($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)){ ?>
        <div class="col-md-6 col-lg-4" align="center" style="margin-bottom:2px; padding:0">
            <div class="wrapper">
                <img src="product-imgs/<?php echo $row['Product_Img'];?>" width="320px" height="320px">
                <div class="overlay">
                    <div class="text">
                        <a href="index.php?page=content&&function=AddToCart&&id=<?php echo $row['Product_ID']; ?>"><i class="fa fa-shopping-cart" style="color:white; font-size: 2em;" aria-hidden="true"></i></a><br>
                        <a><span>$</span><?php echo $row['Price']; ?> </a>
                    </div>
                </div>    
            </div>
            <div class="desc">
                <div><strong><a href="Product_Detail.php?id=<?php echo $row['Product_ID']; ?>" class="nav-link">
                     <?php echo $row['Product_Name']; ?> 
                </a></strong></div>
            </div>
        </div>
<?php
    }
    ?>
    </div>
        <div align="center">
            <h3>Top Pound Cakes</h3>
            <hr>
        </div>
        <div class="row">
            <?php $rs1 = mysqli_query($conn, "SELECT * FROM product WHERE Cat_ID = '2' LIMIT 3");
            while($row1 = mysqli_fetch_array($rs1, MYSQLI_ASSOC)){ ?>
        <div class="col-md-6 col-lg-4" align="center" style="margin-bottom:2px; padding:0">
            <div class="wrapper">
                <img src="product-imgs/<?php echo $row1['Product_Img'];?>" width="320px" height="320px">
                <div class="overlay">
                    <div class="text">
                        <a href="index.php?page=content&&function=AddToCart&&id=<?php echo $row1['Product_ID']; ?>"><i class="fa fa-shopping-cart" style="color:white; font-size: 2em;" aria-hidden="true"></i></a><br>
                        <a><span>$</span><?php echo $row1['Price']; ?> </a>
                    </div>
                </div>    
            </div>
            <div class="desc">
                <div><strong><a href="Product_Detail.php?id=<?php echo $row1['Product_ID']; ?>" class="nav-link">
                     <?php echo $row1['Product_Name']; ?> 
                </a></strong></div>
            </div>
        </div>
    <?php
            }
        ?>
    </div>
    
<?php
    if(!isset($_SESSION['email']) && isset($_GET['function']) == "AddToCart" ){
        echo '<meta http-equiv="refresh" content="0;URL=index.php?page=login">';
    }

    if(isset($_GET['function'])=='AddToCart' && isset($_SESSION['email'])){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $ck = mysqli_query($conn,"SELECT Product_ID from product WHERE Product_ID = '$id'");
            if(mysqli_num_rows($ck) == 0){
                echo '<meta http-equiv="refresh" content="0;URL=index.php">';
            }
            else{
            $email = $_SESSION['email'];
            $id = $_GET['id'];
            $res1 = mysqli_query($conn,"SELECT * FROM `order` WHERE Email = '$email'");
            if(mysqli_num_rows($res1)!=0){
                $res0 = mysqli_query($conn,"SELECT * FROM `order` WHERE Email = '$email' AND Status = 0");
                if(mysqli_num_rows($res0)!=0){
                $orderqr = mysqli_fetch_array($res0, MYSQLI_ASSOC);
                $oid1 = $orderqr['OrderID'];
                    $isadd = mysqli_query($conn, "SELECT * FROM orderdetail WHERE OrderID = '$oid1' AND Product_ID = '$id'");
                    if(mysqli_num_rows($isadd) == 0){
                    mysqli_query($conn, "INSERT INTO orderdetail(OrderID, Product_ID, Qty) 
                    VALUES ('$oid1','$id',1)") or die(mysqli_error($conn));
                    }
                    else{
                        $isaddrow = mysqli_fetch_array($isadd, MYSQLI_ASSOC);
                        $oldqty = $isaddrow['Qty'];
                        $oldqty = $oldqty+1;
                        mysqli_query($conn, "UPDATE orderdetail SET Qty = '$oldqty' WHERE OrderID = '$oid1' AND Product_ID = '$id'");
                    }
                }
                else{
                    mysqli_query($conn, "INSERT INTO `order`(Email)
                    VALUES ('$email')") or die(mysqli_error($conn));
                    $res2 = mysqli_query($conn, "SELECT * FROM `order` WHERE Email = '$email' AND Status = 0")
                    or die(mysqli_error($conn));
                    $getnewvl = mysqli_fetch_array($res2, MYSQLI_ASSOC);
                    $oid2 = $getnewvl['OrderID'];
                    mysqli_query($conn, "INSERT INTO orderdetail(OrderID, Product_ID, Qty)
                    VALUES ('$oid2','$id',1)") or die(mysqli_error($conn));
                }
            }
            else{
                mysqli_query($conn, "INSERT INTO `order`(Email)
                VALUES ('$email')") or die(mysqli_error($conn));
                $res3 = mysqli_query($conn, "SELECT * FROM `order` WHERE Email = '$email'")
                or die(mysqli_error($conn));
                $getnewvl3 = mysqli_fetch_array($res3, MYSQLI_ASSOC);
                $oid3 = $getnewvl3['OrderID'];
                mysqli_query($conn, "INSERT INTO orderdetail(OrderID, Product_ID, Qty)
                VALUES ('$oid3','$id',1)") or die(mysqli_error($conn));
            }
        }
    }
}
?>

</div>