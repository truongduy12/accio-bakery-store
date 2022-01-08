

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
    $err = "";

    include_once("connection.php");
    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
        $result = mysqli_query($conn, "SELECT * FROM category WHERE Cat_ID = '$id'");
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $cat_id = $row['Cat_ID'];
        $cat_name = $row['Cat_Name'];
?>

<div class="container">
    <h1 style="padding-top: 1em; padding-bottom: 1em; font-weight: bold; color: orange; text-align:center">Updating Category</h1>
    <form id="update-category-form" name="update-category-form" method="POST" class="form-horizontal" role="form">
        <div class="form-group">
            <label for="txtID" class="control-label">Category ID:</label>
            <div class="col">
                <input type="text" name="txtID" id="txtID" class="form-control" readonly 
                value='<?php echo $cat_id; ?>'>
            </div>
        </div>
        <div class="form-group">
            <label for="txtName" class="control-label">Category Name:</label>
            <div class="col">
                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Category Name" 
                value='<?php echo $cat_name; ?>'>
            </div>
        </div>
        <div class="form-group">
            <div class="col">
                <input type="submit" class="btn btn-warning" name="btnUpdate" id="btnUpdate" value="Update" />
                <input type="button" class="btn btn-warning" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='admin-index.php?page=category_manage'" />
            </div>
        </div>
    </form>
</div>

<?php            
        if(isset($_POST['btnUpdate']))
        {
            if(empty($_POST['txtName']))
            {
                $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                 Category Name is required</li>';
            }
            else{
                $name = test_input($_POST['txtName']);
            }
            if($err == "")
            {
                $sq = "SELECT * FROM category WHERE Cat_ID != '$id' AND Cat_Name = '$name'";
                $result = mysqli_query($conn,$sq);
                if(mysqli_num_rows($result)==0)
                {
                    mysqli_query($conn, "UPDATE category SET Cat_Name = '$name' WHERE Cat_ID = '$id'");
                    echo '<meta http-equiv="refresh" content="0;URL=admin-index.php?page=category_manage"/>';
                }
                else{
                    $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                     Duplicate Category Name</li>';
                }
            }
        }
    
    }
    else{
        echo '<meta http-equiv="refresh" content="0;URL=admin-index.php?page=category_manage"/>';
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