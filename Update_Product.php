

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
    function bind_Category_List($conn,$selectedValue){
        $sqlstring = "SELECT Cat_ID, Cat_Name FROM category";
        $result = mysqli_query($conn,$sqlstring);
        echo "<select name = 'CategoryList' class = 'form-control'>";
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            if($row['Cat_ID'] == $selectedValue){
                echo "<option value='".$row['Cat_ID']."' selected>".$row['Cat_Name']."</option>";
            }
            else{
                echo "<option value='".$row['Cat_ID']."'>".$row['Cat_Name']."</option>";
            }
        }
        echo "</select>";
    }

    if(isset($_GET["id"])){
        $err = "";
        $id = $_GET["id"];
        $sqlstring = "SELECT Product_Name, Cat_ID, Description, Price, Product_Img, Status
        FROM product WHERE Product_ID = '$id'";

        $result = mysqli_query($conn, $sqlstring);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $proname = $row["Product_Name"];
        $category = $row["Cat_ID"];
        $des = $row["Description"];
        $price = $row["Price"];
        $img = $row["Product_Img"];
        $stt = $row["Status"];
?>

<div class="container">
    <div align="center">
        <h1 style="padding-top: 1em; padding-bottom: 1em; font-weight: bold; color: orange;">Updating Product</h1>
    </div>
    <form id="update-product-form" name="update-product-form" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
        <div class="form-group">
            <label for="txtID" class="control-label">Product ID:</label>
            <div class="col">
                <input type="text" name="txtID" id="txtID" class="form-control"
                readonly value='<?php echo $id; ?>'/>
            </div>
        </div>
        <div class="form-group">
            <label for="txtName" class="control-label">Product Name: </label>
            <div class="col">
                <input type="text" name="txtName" id="txtName" class="form-control"
                placeholder="Product Name" value='<?php echo $proname; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Product Category:</label>
            <div class="col">
                <?php bind_Category_List($conn, $category); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="txtDesc" class="control-label">Product Description:</label>
            <div class="col">
                <input type="text" name="txtDesc" id="txtDesc" class="form-control"
                placeholder="Description" value='<?php echo $des; ?>'>
            </div>
        </div>
        <div class="form-group">
                <div class="col">
                    <label for="txtPrice" class="control-label">Price:</label>
                    <input type="text" name="txtPrice" id="txtPrice" class="form-control"
                    placeholder="Price" value='<?php echo $price; ?>'>
                </div>
                <div class="col">
                    <label for="Status" class="control-lable">Status: </label>
                    <select name="Status" class="form-control">
                        <option value='<?php echo $stt; ?>' selected> <?php if($stt == 0) echo "Not Available"; else echo "Available"; ?></option>
                        <option value='<?php if($stt == 0) echo "1"; else echo "0"; ?>'><?php if($stt == 0) echo "Available"; else echo "Not Available"; ?></option>
                    </select>
                </div>
        </div>
        <div class="form-group">
            <label for="txtImage" class="control-label">Image:</label>
            <div class="col">
                <a href='product-imgs/<?php echo $img; ?>' target="_blank"><img src='product-imgs/<?php echo $img; ?>' border='0px' width="100px" height="100px"/></a>
                <input type="file" name="txtImage" id="txtImage" class="form-control" value="">
            </div>
        </div>
        <div class="form-group">
            <div class="col">
                  <input type="submit"  class="btn btn-warning" name="btnUpdate" id="btnUpdate" value="Update"/>
                  <input type="button" class="btn btn-warning" name="btnIgnore"  id="btnIgnore" value="Ignore" onclick="window.location='admin-index.php?page=product_manage'" /> 	
            </div>
        </div>
        
    </form>
</div>

<?php

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST["btnUpdate"]))
    {
        $id = $_POST['txtID'];
        $img = $_FILES['txtImage'];
        $category = $_POST['CategoryList'];
        $stt = $_POST['Status'];

        if(empty($_POST['txtName'])){
            $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Product Name is required</li>';
        }
        else{
            $proname = test_input($_POST['txtName']);
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
            if($img['name'] != "")
            {
                if($img['type'] == "image/jpg" || $img['type'] == "image/jpeg" || $img['type'] == "image/png" || $img['type'] == "image/gif")
                {
                    if($img['size'] <= 20000000000000000)
                    {
                        $sq = "SELECT * FROM product WHERE Product_ID != '$id' AND Product_Name = '$proname'";
                        $result = mysqli_query($conn,$sq);
                        if(mysqli_num_rows($result) == 0)
                        {
                            copy($img['tmp_name'], "product-imgs/".$img['name']);
                            $filePic = $img['name'];

                            $sqlstring = "UPDATE product SET
                            Product_Name = '$proname', Cat_ID = '$category', Status = '$stt',
                            Price = '$price', Description = '$des', Product_Img = '$filePic',
                            Pro_Date = '".date('Y-m-d H:i:s')."' WHERE Product_ID = '$id'";
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
            else{
                $sq = "SELECT * FROM product WHERE Product_ID != '$id' AND Product_Name = '$proname'";
                $result = mysqli_query($conn,$sq);
                if(mysqli_num_rows($result) == 0)
                {
                    $sqlstring = "UPDATE product SET Product_Name = '$proname', Status = '$stt',
                    Cat_ID = '$category', Price = '$price', Description = '$des',
                    Pro_Date ='".date('Y-m-d H:i:s')."' WHERE Product_ID = '$id'";

                    mysqli_query($conn,$sqlstring);
                    echo '<meta http-equiv="refresh" content="0;URL=admin-index.php?page=product_manage"/>';
                }
                else{
                    $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                     Duplicate Product Name</li>';
                }
            }
        }
    }
}
else{
    echo '<meta http-equiv="refresh" content="0;URL=admin-index.php?page=product_manage"/>';
}
    ?>
<div class="form-group">
            <div class="col">
                <?php echo '<div style="color: red; list-style-type: none; list-style-position: outside;">'.$err.'</div>'; ?>
            </div>
        </div>
<?php
    }
    ?>