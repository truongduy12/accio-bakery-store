<div class="navbar navbar-expand-lg bg-light navbar-light">
            <div class="container-fluid">
                <a href="index.php?page=content" class="navbar-brand"><span id="brand">Accio!</span></a>
                <button type="button" onclick="toggleFunction(this)" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <div class="tgbtn" >
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>
                </button>
                
                <?php 
                    if(isset($_SESSION['email']) && $_SESSION['email'] != "" && $_SESSION['isAdmin'] == 0){
                ?>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <a href="index.php?page=content" class="nav-item nav-link">Home</a>
                        <a href="index.php?page=product" class="nav-item nav-link">Product</a>
                        <a href="About.php" class="nav-item nav-link">About</a>
                        <a href="index.php?page=my_account" class="nav-item nav-link"><?php echo $_SESSION['email'];?></a>
                        <a href="index.php?page=shopping_cart" class="nav-item nav-link"><i class="fa fa-shopping-cart" aria-hidden="true"></i> </a>
                        <a href="index.php?page=logout" class="nav-item btn btn-warning" id="loginbtn">Logout</a>
                    </div>
                    </div>
                <?php 
                    }
                    else if(isset($_SESSION['email']) && $_SESSION['email'] != "" && $_SESSION['isAdmin'] == 1)
                    {
                ?>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <a href="index.php?page=content" class="nav-item nav-link">Home</a>
                        <a href="index.php?page=product" class="nav-item nav-link">Product</a>
                        <a href="About.php" class="nav-item nav-link">About</a>
                        <a href="index.php?page=my_account" class="nav-link"><?php echo $_SESSION['email'];?></a>
                        <a href="admin-index.php?page=authorize" class="nav-link">Administration Page</a>
                        <a href="index.php?page=shopping_cart" class="nav-item nav-link"><i class="fa fa-shopping-cart" aria-hidden="true"></i> </a>
                        <a href="index.php?page=logout" class="nav-item btn btn-warning" id="loginbtn">Logout</a>
                    </div>
                    </div>
                <?php 
                    }
                    else
                    { 
                ?>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <a href="index.php?page=content" class="nav-item nav-link">Home</a>
                        <a href="index.php?page=product" class="nav-item nav-link">Product</a>
                        <a href="About.php" class="nav-item nav-link">About</a>
                        <a href="index.php?page=shopping_cart" class="nav-item nav-link"><i class="fa fa-shopping-cart" aria-hidden="true"></i> </a>
                        <a href="index.php?page=login" class="nav-item btn btn-warning" id="loginbtn">Login</a>
                    </div>
                    </div>
                <?php
                    }
                ?>
                
            </div>
        </div>