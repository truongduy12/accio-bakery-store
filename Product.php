<?php 
include_once("connection.php");
$rs = mysqli_query($conn,"SELECT * FROM product WHERE Status = 1");
if(!$rs){
    die('Invalid query: ' . mysqli_error($conn));
}
?>
<div class="container">
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
</div>