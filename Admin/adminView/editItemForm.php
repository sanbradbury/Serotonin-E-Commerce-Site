
<div class="container p-5">

<h4>Edit Product Detail</h4>
<?php
    include_once "../config/dbconnect.php";
	$ID=$_POST['record'];
	$qry=mysqli_query($conn, "SELECT * FROM products WHERE product_id='$ID'");
	$numberOfRow=mysqli_num_rows($qry);
	if($numberOfRow>0){
		while($row1=mysqli_fetch_array($qry)){
      $catID=$row1["category_id"];
?>
<form id="update-Items" onsubmit="updateItems()" enctype='multipart/form-data'>
	<div class="form-group">
      <input type="text" class="form-control" id="product_id" value="<?=$row1['product_id']?>" hidden>
    </div>
    <div class="form-group">
      <label for="name">Product Name:</label>
      <input type="text" class="form-control" id="p_name" value="<?=$row1['prod_name']?>">
    </div>
    <div class="form-group">
      <label for="gender">Product Description:</label>
      <input type="text" class="form-control" id="gender" value="<?=$row1['gender']?>">
    </div>
    <div class="form-group">
      <label for="price">Unit Price:</label>
      <input type="number" class="form-control" id="p_price" value="<?=$row1['price']?>">
    </div>
    <div class="form-group">
      <label>Category:</label>
      <select id="category">
        <?php
          $sql="SELECT * from categories WHERE category_id='$catID'";
          $result = $conn-> query($sql);
          if ($result-> num_rows > 0){
            while($row = $result-> fetch_assoc()){
              echo"<option value='". $row['category_id'] ."'>" .$row['cat_name'] ."</option>";
            }
          }
        ?>
        <?php
          $sql="SELECT * from categories WHERE category_id!='$catID'";
          $result = $conn-> query($sql);
          if ($result-> num_rows > 0){
            while($row = $result-> fetch_assoc()){
              echo"<option value='". $row['category_id'] ."'>" .$row['cat_name'] ."</option>";
            }
          }
        ?>
      </select>
    </div>
      <div class="form-group">
         <img width='200px' height='150px' src='<?=$row1["prod_image"]?>'>
         <div>
            <label for="file">Choose Image:</label>
            <input type="text" id="existingImage" class="form-control" value="<?=$row1['prod_image']?>" hidden>
            <input type="file" id="newImage" value="">
         </div>
    </div>
    <div class="form-group">
      <button type="submit" style="height:40px" class="btn btn-primary">Update Item</button>
    </div>
    <?php
    		}
    	}
    ?>
    </div>
  </form>

    