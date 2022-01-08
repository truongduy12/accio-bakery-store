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

<style>
    body {
        margin: 0;
    }
    .sidebar{
        height: 100%; 
        width: 0; 
        position: fixed; 
        z-index: 10000; 
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden; 
        padding-top: 60px; 
        transition: 0.5s;
    }
    .sidebar a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }
    .sidebar a:hover {
    color: orange;
    }
    .sidebar a.active{
        color:white;
        background-color:orange;
    }
    .sidebar .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }
    .openbtn {
        font-size: 20px;
        cursor: pointer;
        background-color: #111;
        color: white;
        padding: 10px 15px;
        border: none;
    }
    .openbtn:hover {
        background-color: #444;
    }
    #noeff:hover {
        background-color: #111;
    }
    #main {
    transition: margin-left .5s;
    padding: 20px;
    }
    @media screen and (max-height: 450px) {
    .sidebar {padding-top: 15px;}
    .sidebar a {font-size: 18px;}
}
</style>

<?php 
            session_start();
            if(!isset($_GET['page']) || !isset($_SESSION['isAdmin']))
            {
                echo '<h1 style="color: red"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ACCESS DENIED!</h1>';
            }
            elseif($_SESSION['isAdmin'] != 1){
                echo '<h1 style="color: red"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ACCESS DENIED!</h1>';
            }
            else
            {
            $page = $_GET['page'];
?>
            <div>
            <button style="position: fixed" class="openbtn" onclick="openNav()">&#9776;</button>
            </div>
<?php
            if($page == "authorize"){
                include_once("admin-about.php");
            }
            elseif($page == "product_manage"){
                include_once("Product_Manage.php");
            }
            elseif($page == "category_manage"){
                include_once("Category_Manage.php");
            }
            elseif($page == "order_manage"){
                include_once("Order_Manage.php");
            }
            elseif($page == "add_category"){
                include_once("Add_Category.php");
            }
            elseif($page == "update_category"){
                include_once("Update_Category.php");
            }
            elseif($page == "add_product"){
                include_once("Add_Product.php");
            }
            elseif($page == "order_detail"){
                include_once("Order_Detail.php");
            }
            elseif($page == "update_detail"){
                include_once("Update_Detail.php");
            }
            elseif($page == "update_order"){
                include_once("Update_Order.php");
            }
            elseif($page == "update_product"){
                include_once("Update_Product.php");
            }
            else{
                include_once("admin.about.php");
            }
?>
<div id="main">
    <div class="sidebar" id="admin-sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a id="noeff">
            <div class="navbar-brand" id="brand" style="color: orange"> Accio!</div>
        </a>
        <a href="?page=authorize">About Admin</a>
        <a href="?page=category_manage">Category Manage</a>
        <a href="?page=product_manage">Product Manage</a>
        <a href="?page=order_manage">Order Manage</a>
        <a href="index.php">Back to Homepage</a>
    </div>


<script>
    function openNav() {
  document.getElementById("admin-sidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}
function closeNav() {
  document.getElementById("admin-sidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
} 
</script>

<?php
}
    ?>