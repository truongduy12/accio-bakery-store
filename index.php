<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accio!</title>
    <!-- Configure site meta -->
    <meta name="keywords" content="Accio!">
    <meta name="description" content="Cakes, Sweets, Cupcakes, Coffee">
    <meta name="Author" content="Truong Duy">
    <!-- Site icon -->
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
</head>
<?php 
    session_start();
    include_once("connection.php");
?>
<body>
    <div id="main">
        <!--Top Navigation Bar-->
    <?php include_once("Header.php"); ?>

        <!-------------->
    <!--Carousel-->
        <?php include_once("Carousel.php"); ?>

        <!--body-->
        <div style="margin: 20px 10px 10px 20px;"> 
              <?php
        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
            if($page=="login"){
                include_once("Login.php");
            }
            elseif($page=="register"){
                include_once("Register.php");
            }
            elseif($page=="index"){
                echo "<script>window.location='index.php';</script>";
            }            
            elseif($page=="logout"){
                include_once("Logout.php");
            }
            elseif($page=="my_account"){
                include_once("My_Account.php");
            }
            elseif($page=="update_info"){
                include_once("Update_Info.php");
            }
            elseif($page=="change_password"){
                include_once("Change_Password.php");
            }
            elseif($page=="content"){
                include_once("content.php");
            }
            elseif($page=="shopping_cart"){
                include_once("Shopping_Cart.php");
            }
            elseif($page=="order_history"){
                include_once("Order_History.php");
            }
            elseif($page=="product"){
                include_once("Product.php");
            }
            elseif($page=="update_cart"){
                include_once("Update_Cart.php");
            }
            elseif($page=="checkout"){
                include_once("Checkout.php");
            }
            else{
                echo '<meta http-equiv="refresh" content="0;URL=index.php">';
            }
            
        }
        else{
                include_once("content.php");
            }
        ?>
        </div>
        <!-------------->
            <?php include_once("Footer.php");?>
        <!--Footer-->
        
    </div>
    <button onclick="toTop()" id="toTop" title="Go to top"><i class="fas fa-chevron-circle-up" style="color: orange; font-size:3em;"></i></button>
    <script>
        var totopbtn = document.getElementById("toTop");
        window.onscroll = function() {
            scrollFuntion()
        };

        function scrollFuntion() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                totopbtn.style.display = "block";
            } else {
                totopbtn.style.display = "none";
            }
        }

        function toTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <script>
        function toggleFunction(x) {
            x.classList.toggle("change");
        }
    </script>
</body>

</html>