
<?php
    if(!isset($_GET['page']) || !isset($_SESSION['isAdmin']))
    {
        echo '<h1 style="color: red"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ACCESS DENIED!</h1>';
    }
    elseif($_SESSION['isAdmin'] != 1){
        echo '<h1 style="color: red"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ACCESS DENIED!</h1>';
    }
    else{
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    include_once("connection.php");

    function bind_Category_List($conn){
        $sqlstring = "SELECT Cat_ID, Cat_Name FROM category";
        $result = mysqli_query($conn, $sqlstring);
        echo "<select name='CategoryList' class='form-control'>
                <option value='0'>Choose category</option>";
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "<option value='".$row['Cat_ID']."'>".$row['Cat_Name']."</option>";
        }
        echo "</select>";
    }

        $err = "";
    if(isset($_POST['btnAdd']))
    {  
        $img = $_FILES['txtImage'];

        if(empty($_POST['txtName'])){
            $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Product Name is required</li>';
        }
        else{
            $proname = test_input($_POST['txtName']);
        }
        if($_POST['CategoryList'] == "0"){
            $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Product Category is required</li>';
        }
        else{
            $category = ($_POST['CategoryList']);
        }
        if(empty($_POST['txtDesc'])){
            $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Product Description is required</li>';
        }
        else{
            $des = test_input($_POST['txtDesc']);
        }
        if(!is_numeric($_POST['txtPrice'])){
            $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Product Price is not in correct format</li>';
        }
        else{
            $price = test_input($_POST['txtPrice']);
        }
        if($err == ""){
            if($img['type'] == "image/jpg" || $img['type'] == "image/jpeg" || $img['type'] == "image/png" || $img['type'] == "image/gif"){
                if($img['size'] <= 2000000000){
                    $sq = "SELECT * FROM product WHERE Product_Name = '$proname'";
                    $result = mysqli_query($conn, $sq);
                    if(mysqli_num_rows($result) == 0){
                        copy($img['tmp_name'], "product-imgs/".$img['name']);
                        $filePic = $img['name'];
                        $sqlstring = "INSERT INTO product(
                            Product_Name, Cat_ID, Price, Description, Product_Img)
                            VALUES('$proname','$category','$price','$des','$filePic')";
                        mysqli_query($conn,$sqlstring);
                        echo '<meta http-equiv="refresh" content="0;URL=admin-index.php?page=product_manage"/>';
                    }
                    else{
                        $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                         Duplicate Product Name</li>';
                    }
                }
                else{
                    $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                     The size of the image is too large</li>';
                }
            }
            else{
                $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                 Image format is not correct</li>';
            }
        }
    }
?>

<div class="container">
    <div align="center">
        <h1 style="padding-top: 1em; padding-bottom: 1em; font-weight: bold; color: orange;">Adding Product</h1>
    </div>
    <form id="add-product-form" name="add-product-form" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
        <div class="form-group">
            <label for="txtName" class="control-label">Product Name: </label>
            <div class="col">
                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label">Product Category: </label>
            <div class="col">
                <?php bind_Category_List($conn); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="txtDesc" class="control-label">Description: </label>
            <div class="col">
                <input type="text" name="txtDesc" id="txtDesc" class="form-control" placeholder="Description">
            </div>
        </div>
        <div class="form-group">
            <label for="txtPrice" class="control-label">Price: </label>
            <div class="col">
                <input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price">
            </div>
        </div>
        <div class="form-group">
            <label for="txtImage" class="control-label">Image: </label>
            <div class="col">
                <input type="file" name="txtImage" id="txtImage" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col">
                <?php echo '<div style="color: red; list-style-type: none; list-style-position: outside;">'.$err.'</div>'; ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col">
                  <input type="submit"  class="btn btn-warning" name="btnAdd" id="btnAdd" value="Add New"/>
                  <input type="button" class="btn btn-warning" name="btnIgnore"  id="btnIgnore" value="Ignore" onclick="window.location='admin-index.php?page=product_manage'" /> 	
            </div>
        </div>
    </form>
</div>
<?php
    }
    ?>