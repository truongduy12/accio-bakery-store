
<?php 
    if(!isset($_GET['page']) || !isset($_SESSION['isAdmin']))
    {
        echo '<h1 style="color: red"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ACCESS DENIED!</h1>';
    }
    elseif($_SESSION['isAdmin'] != 1){
        echo '<h1 style="color: red"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ACCESS DENIED!</h1>';
    }
    else{
?>

<div class="container">
    <form name="cat-manage" method="post">
        <div style="text-align:center;">
            <h1 style="padding-top: 1em; padding-bottom: 1em; font-weight: bold; color: orange;">Category Management</h1>
        </div>
        <div>
            <button type="button" class="btn btn-warning" alt="ADD NEW CATEGORIES" style="margin-bottom: 1em;">
                <a href="admin-index.php?page=add_category" style="color:black;">ADD NEW</a>
            </button>
        </div>
        <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>Category ID</strong></th>
                    <th><strong>Category Name</strong></th>
                    <th><strong>Edit</strong></th>
                </tr>
            </thead>
    
            <tbody>
                <?php
                    include_once("connection.php");
                    $result = mysqli_query($conn,"SELECT * FROM category");
                    while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                ?>
                <tr>
                <td><?php echo $row['Cat_ID'];?></td>
                <td><?php echo $row["Cat_Name"];?></td>
                <td style='text-align: center;'>
                <a style='color: orange; font-size:100%;' href="admin-index.php?page=update_category&&id=<?php echo $row["Cat_ID"]; ?>">
                <i class="fas fa-edit"></i></a></td>
                </tr>
    
                <?php
                    }
                ?>
            </tbody>
        </table>
    </form>
</div>
<?php 
    }
    ?>