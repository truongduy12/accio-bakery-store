<?php
            include_once("connection.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
    $err = "";

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST['txtEmail'])){
            $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Email is required</li>';
        }
        else{
            $email = mysqli_real_escape_string($conn,test_input($_POST['txtEmail']));
        }

        if(empty($_POST['txtPass'])){
            $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
             Password is required</li>';
        }
        else{
            $pass = $_POST['txtPass'];
        }
        
        if($err == ""){
            $passhash=md5($pass);
            $res = mysqli_query($conn,"SELECT Email, Password, Type, Fullname FROM Customer
            WHERE Email = '$email' AND Password = '$passhash'")
            or die(mysqli_error($conn));
            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
            if(mysqli_num_rows($res)==1){
                $_SESSION["email"] = $email;
                $_SESSION["fullname"] = $row["Fullname"];
                $_SESSION['isAdmin'] = $row['Type'];
                echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
            }
            else{
                $err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                 Incorrect email or password</li>';
            }
        }
    }
?>

<div class="container">
    <h2 style="text-align: center;">WELCOME TO <span class="navbar-brand" id="brand">Accio!</span></h2>
    <form class="login-form" method="post">
        <div class="row">
            <div class="col">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="txtEmail" id="email"
                placeholder="Enter email">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" name="txtPass" id="pwd"
                placeholder="Enter password">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div>Don't have an account? <a href="?page=register">Register</a></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php echo '<div style="color: #E53F1B; list-style-type: none; list-style-position: outside;">'.$err.'</div>'; ?> 
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <button type="button" onclick="window.location='index.php'" class="btn btn-warning" style="margin-top: 1em; width: 100%">Cancel</button>
            </div>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-warning" style="margin-top: 1em; width: 100%">Login</button>
            </div>
        </div>
    </form> 
</div>