
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
    if(isset($_POST['btnAdd']))
    {

        if(empty($_POST['txtName'])){
			$err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
			 Category Name is required</li>';
		}
		else{
        	$name = test_input($_POST["txtName"]);
		}
		
		if($err == ""){
			$sq = "SELECT * FROM category WHERE Cat_Name = '$name'";
			$result = mysqli_query($conn,$sq);
			if(mysqli_num_rows($result)==0)
			{
				mysqli_query($conn, "INSERT INTO category (Cat_Name) VALUES ('$name')");
				echo '<meta http-equiv="refresh" content="0;URL=admin-index.php?page=category_manage"/>';
			}
			else
			{
				$err .= '<li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
 				 Duplicate Category Name</li>';
			}
		}
    }
?>

<div class="container">
	<div align="center">
		<h1 style="padding-top: 1em; padding-bottom: 1em; font-weight: bold; color: orange;">Adding Category</h2>
	</div>
			 	<form id="add-category-form" name="add-category-form" method="post" action="" class="form-horizontal" role="form">
				<div class="form-group">
						    <label for="txtName" class="control-label">Category Name:  </label>
							<div class="col">
							      <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Enter Category Name" value='<?php echo isset($_POST["txtName"])?($_POST["txtName"]):"";?>'>
							</div>
					</div>
                    
					<div class="form-group">
						<div class="col">
						      <input type="submit"  class="btn btn-warning" name="btnAdd" id="btnAdd" value="Add New"/>
                              <input type="button" class="btn btn-warning" name="btnIgnore"  id="btnIgnore" value="Ignore" onclick="window.location='admin-index.php?page=category_manage'" /> 	
						</div>
					</div>
					<div class="form-group">
						<div class="col">
						<?php echo '<div style="color: red; list-style-type: none; list-style-position: outside;">'.$err.'</div>'; ?>
						</div>
					</div>
				</form>

				<div align="center"><h2>Current Category List</h2></div>
				<div>
				<table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>Category ID</strong></th>
                    <th><strong>Category Name</strong></th>
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
                </tr>
    
                <?php
                    }
                ?>
            </tbody>
        </table>
				</div>
	</div>
<?php
	}
	?>