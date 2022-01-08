<link rel="shortcut icon" href="image/icon.ico" type="image/x-icon">
<!-- bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<!-- CSS -->
<link rel="stylesheet" href="css/style.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Just+Me+Again+Down+Here&display=swap" rel="stylesheet">

<?php 
session_start();
include_once("connection.php");

if(!isset($_GET['id'])){
    echo '<meta http-equiv="refresh" content="0;URL=index.php?page=product">';
}
else{
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    $check = mysqli_query($conn,"SELECT Product_ID FROM product WHERE Product_ID = '$id'");
    if(mysqli_num_rows($check) == 0){
        echo '<meta http-equiv="refresh" content="0;URL=index.php?page=product">';
    }
    else{
     
?>

<header>
<?php include_once("Header.php"); ?>
</header>

<body>
<div class="container">
    <div class="row" style="margin-bottom: 2em; margin-top:2em">
    <br>
    <hr>
    <?php 
        $sql = mysqli_query($conn,"SELECT * FROM product WHERE Product_ID = '$id'");
        $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    ?>
        <div class="col-md-12 col-lg-6">
            <img width="400px" height="400px" src="product-imgs/<?php echo $row['Product_Img']; ?>">
        </div>
        <div class="col-md-12 col-lg-6">
                    <div><h3><strong><?php echo $row['Product_Name']; ?></strong></h3></div>
                    <div><h4><strong><?php echo "$".$row['Price']; ?></strong></h4></div>
                    <div><h5><i><?php echo $row['Description']; ?><h5></i></div>
        </div>
        </div>
    <div class="row" style="width:100%; margin-bottom: 2em">
        <div class="col-lg-6" style="text-align: left">
            <a href="index.php?page=product" class="btn btn-warning">Back To Product List</a>
        </div>
        <div class="col-lg-6" style="text-align: right">
            <a href="index.php?page=content&&function=AddToCart&&id=<?php echo $id; ?>" class="btn btn-warning">Add to Cart</a>
        </div>
    </div>
</div>
</body>

<footer>
<?php include_once("Footer.php"); ?>
</footer>
<?php
}
}
?>