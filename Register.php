

<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

    $logErr = $infoErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST['txtEmail'])){
            $logErr .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Email is required</li>';
        }
        else{
            $email = test_input($_POST['txtEmail']);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $logErr .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                 Email is not in corrrect format</li>';
            }
        }

        if(empty($_POST['txtPass1'])){
            $logErr .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Password is required</li>';
        }
        else{
            $pass1 = $_POST['txtPass1'];
            if(strlen($pass1) <=5){
                $logErr .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                 Password is at least 6 characters</li>';
            }
        }

        if(empty($_POST['txtPass2'])){
            $logErr .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Re-enter password is required</li>';
        }
        else{
            $pass2 = $_POST['txtPass2'];
            if($pass1 != $pass2){
                $logErr .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                 Password is not match</li>';
            }
        }

        if(empty($_POST['txtFullname'])){
            $infoErr .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Full name is required</li>';
        }
        else{
            $name = test_input($_POST['txtFullname']);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)){
                $infoErr .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                 Name is not in correct format</li>';
            }
        }

        if(empty($_POST['txtTel'])){
            $infoErr .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Phone number is required</li>';
        }
        else{
            $tel = test_input($_POST['txtTel']);
            if(!preg_match("/^\d{10}$/", $tel)){
                $infoErr .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                 Phone number is not in correct format</li>';
            }
        }

        if(empty($_POST['txtAddress'])){
            $infoErr .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Address is required</li>';
        }
        else{
            $addr = test_input($_POST['txtAddress']);
        }

        if($logErr == "" && $infoErr == ""){
            include_once("connection.php");
            $pass = md5($pass1);
            $sq = "SELECT * FROM customer WHERE Email = '$email' OR Telephone = '$tel'";
            $res = mysqli_query($conn, $sq);
            if(mysqli_num_rows($res)==0){
                mysqli_query($conn,"INSERT INTO customer (Email, Fullname, Telephone, Password, Address, Type)
                VALUES ('$email','$name','$tel','$pass','$addr',0)") or die(mysqli_error($conn));
                echo '<meta http-equiv="refresh" content="0;URL=index.php?page=login">';
            }
            else{
                $logErr .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                 Email or Phone Number is already existed</li>';
            }
        }

    }
?>

    <div class="container" style="width: 100%;">
        <h2 style="text-align: center;">WELCOME TO <span class="navbar-brand" id="brand">Accio!</span></h2>
        <form class="register-form" method="post" action="" id="registerform">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="row">
                        <div class="col">
                            <legend>Login Information</legend>
                            <label for="Email">Email address:</label>
                            <input type="email" class="form-control" id="email" name="txtEmail" 
                            placeholder="Enter email" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control"  id="pwd" name="txtPass1" 
                            placeholder="At least 6 characters">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="repwd">Confirm password:</label>
                            <input type="password" class="form-control" id="repwd" name="txtPass2" 
                            placeholder="Re-enter password">
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="row">
                        <div class="col">
                            <legend>Account Information</legend>
                            <label for="fullname">Full name:</label>
                            <input type="text" class="form-control" id="fullname" name="txtFullname"  value="<?php if(isset($name)) echo $name; ?>"
                            placeholder="Enter full name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="tel">Phone number:</label>
                            <input type="tel" class="form-control" id="tel" name="txtTel" value="<?php if(isset($tel)) echo $tel; ?>"
                            placeholder="Enter phone number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="addr">Address:</label>
                            <input type="text" class="form-control" id="addr" name="txtAddress"  value="<?php if(isset($addr)) echo $addr; ?>"
                            placeholder="Enter address">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div>Already have an account? <a href="?page=login">Login</a></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <?php echo '<div style="color: #E53F1B; list-style-type: none; list-style-position: outside;">'.$logErr.'</div>'; ?> 
                </div>
                <div class="col-sm-6">
                    <?php echo '<div style="color: #E53F1B; list-style-type: none; list-style-position: outside;">'.$infoErr.'</div>'; ?> 
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div style="text-align: center; margin-top: 1em;">Registering to website, you accept our <a>Terms of use</a> and our <a>Privacy policy</a></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <button type="button" class="btn btn-warning" onclick="window.location='index.php'" style="margin-top: 0.5em; width: 100%">Cancel</button>
                </div>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-warning" style="margin-top: 0.5em; width: 100%" name="btnRegister" value="Submit">Register</button>
                </div>
            </div>
        </form>
    </div>

