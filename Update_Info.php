

<?php 
    if(!isset($_SESSION['email'])){
        echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    }
    else{
        include_once("connection.php");
        $err = "";
        $email = $_SESSION['email'];
        $result = mysqli_query($conn, "SELECT * FROM customer WHERE Email = '$email'");
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $name = $row["Fullname"];
        $tel = $row["Telephone"];
        $addr = $row["Address"];
    
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }
?>

<div class="container">
    <h1>My Information</h1>
    <form id="update-info" name="update-info" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
        <div class="form-group">
            <label for="txtEmail" class="control-label">Email Address:</label>
            <div class="col">
                <input type="text" name="txtEmail" id="txtEmail" class="form-control"
                readonly value='<?php echo $email; ?>'>
            </div>
        </div>
        <div class="form-group">
            <label for="txtName" class="control-label">Full Name:</label>
            <div class="col">
                <input type="text" name="txtName" id="txtName" class="form-control"
                placeholder="Full name" value='<?php echo $name; ?>'>
            </div>
        </div>
        <div class="form-group">
            <label for="txtTel" class="control-label">Phone Number:</label>
            <div class="col">
                <input type="tel" name="txtTel" id="txtTel" class="form-control"
                placeholder="Phone number" value='<?php echo $tel; ?>'>
            </div>
        </div>
        <div class="form-group">
            <label for="txtAddr" class="control-label">Address:</label>
            <div class="col">
                <input type="text" name="txtAddr" id="txtAddr" class="form-control"
                placeholder="Address" value='<?php echo $addr; ?>'>
            </div>
        </div>
        <div class="form-group">
            <div class="col">
                <button type="button" class="btn btn-warning" onclick="window.location='index.php?page=change_password'">Change Password</button>
            </div>
        </div>
        <div class="form-group">
            <div class="col" align="right">
                  <input type="submit" class="btn btn-warning" name="btnUpdate" id="btnUpdate" value="Update"/>
                  <input type="button" class="btn btn-warning" name="btnIgnore"  id="btnIgnore" value="Ignore" onclick="window.location='index.php?page=my_account'" /> 	
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
                 Full Name is required</li>';
            }
            else{
                $name = test_input($_POST['txtName']);
                if (!preg_match("/^[a-zA-Z-' ]*$/", $name)){
                    $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                     Name is not in correct format</li>';
                }
            }
            if(empty($_POST['txtTel'])){
                $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                 Phone number is required</li>';
            }
            else{
                $tel = test_input($_POST['txtTel']);
                if(!preg_match("/^\d{10}$/", $tel)){
                    $infoErr .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                     Phone number is not in correct format</li>';
                }
            }
            if(empty($_POST['txtAddr'])){
                $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                 Address is required</li>';
            }
            else{
                $addr = test_input($_POST['txtAddr']);
            }
            if($err == ""){
                $sq = "SELECT * FROM customer WHERE Email != '$email' AND Telephone = '$tel'";
                $res = mysqli_query($conn,$sq);
                if(mysqli_num_rows($res) == 0){
                    mysqli_query($conn, "UPDATE customer SET
                    Fullname = '$name', Telephone = '$tel', Address = '$addr' 
                    WHERE Email = '$email'") or die(mysqli_error($conn));
                    echo '<meta http-equiv="refresh" content="0;URL=index.php?page=my_account">';
                }
                else{
                    $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                     Duplicate Phone Number</li>';
                }
            }
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