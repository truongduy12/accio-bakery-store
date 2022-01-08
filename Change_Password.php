
<?php
    if(!isset($_SESSION['email'])){
        echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    }
    else{
        include_once("connection.php");
        $err = "";
        $email = $_SESSION['email'];
        $result = mysqli_query($conn, "SELECT Password FROM customer WHERE Email = '$email'");
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $oldpass = $row['Password'];

?>

<div class="container">
    <form class="change-password" method="POST">
        <div class="form-group">
            <label for="txtPass1" class="control-label">Enter Current Password:</label>
            <div class="col">
                <input type="password" class="form-control" name="txtPass1" id="txtPass1" 
                placeholder="Enter Password">
            </div>
        </div>
        <div class="form-group">
            <label for="txtPass2" class="control-label">Enter New Password</label>
            <div class="col">
                <input type="password" class="form-control" name="txtPass2" id="txtPass2"
                placeholder="At least 6 characters">
            </div>
        </div>
        <div class="form-group">
            <label for="txtRe" class="control-label">Confirm New Password</label>
            <div class="col">
                <input type="password" class="form-control" name="txtRe" id="txtRe"
                placeholder="Re-enter new password">
            </div>  
        </div>
        <div class="row">
            <div class="col-sm-6">
                <button type="button" onclick="window.location='index.php?page=my_account'" class="btn btn-warning" style="margin-top: 1em; width: 100%">Cancel</button>
            </div>
            <div class="col-sm-6">
                <button type="submit" name="btnUpdate" class="btn btn-warning" style="margin-top: 1em; width: 100%">Save Change</button>
            </div>
        </div>
    </form>
</div>

<?php
    if(isset($_POST['btnUpdate'])){
        if(empty($_POST['txtPass1'])){
            $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Password is required</li>';
        }
        elseif(md5($_POST['txtPass1']) != $oldpass){
            $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Password is incorrect</li>';
        }
        else{
            if(empty($_POST['txtPass2'])){
                $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                 New Password is required</li>';
            }
            else{
                $pass2 = $_POST['txtPass2'];
                if(strlen($pass2) <= 5){
                    $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                     New Password is at least 6 characters</li>';
                }
            }
            if(empty($_POST['txtRe'])){
                $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                 Re-enter New Password is required</li>';
            }
            else{
                $repass2 = $_POST['txtRe'];
                if($pass2 != $repass2){
                    $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                     New Password and Re-enter Password are not match</li>';
                }
            }
            if($err == ""){
                $newpass = md5($pass2);
                mysqli_query($conn, "UPDATE customer SET Password = '$newpass'
                WHERE Email = '$email'") or die(mysqli_error($conn));
                echo '<meta http-equiv="refresh" content="0;URL=index.php?page=my_account">';
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