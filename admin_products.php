<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};




if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   
   $delete_data="delete from products where id='$delete_id' ";
   $run_delete_data=mysqli_query($conn,$delete_data);
   if($run_delete_data){
    ?>
    <script>
        location.replace("admin_products.php");
        alert("Product Delete successful");
    </script>
    <?php
  }else{
    ?>
    <script>
        location.replace("admin_products.php");
        alert("Product Not Deleted");
    </script>
    <?php
  }


}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

   $imagelocation=$_FILES['update_image']['tmp_name'];
   $imagename=$_FILES['update_image']['name'];
   $imgagedestination="uploaded_img/".$imagename;
   move_uploaded_file($imagelocation,"uploaded_img/".$imagename);

   $update_data="update products set price='$update_price',image='$imgagedestination' where id='$update_p_id'";
   $run_update=mysqli_query($conn,$update_data);

   if($run_update){
    ?>
    <script>
        location.replace("admin_products.php");
        alert("Product Updated");
    </script>
    <?php
  }else{
    ?>
    <script>
        location.replace("admin_products.php");
        alert("Product Not Submited");
    </script>
    <?php
  }

   

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
<style>
     @import "compass/css3";

$back-color: #F0F0F0;
$green-border: #72B372;

@mixin linear-gradient($top, $bottom) {
  background: $top;
  background: -webkit-linear-gradient($top, $bottom);
	background: -moz-linear-gradient($top, $bottom);
	background: -o-linear-gradient($top, $bottom);
	background: linear-gradient($top, $bottom);
}

.main > div {
  display: inline-block;
  width: 49%;
  margin-top: 10px;
}
.two{
    .register {
       border: none; 
        
        h3 {
          border-bottom-color: #909090;
        }
    
        .sep{
          border-color: #909090;
        }
    }
}
.register {
  	width: 500px;
  	margin: 10px auto;
  	padding: 10px;
  	border: 7px solid $green-border;
  	border-radius: 10px;
  	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	  color: #444;
  	background-color: $back-color;
  	box-shadow: 0 0 20px 0 #000000;
  	
  h3 {
	  	margin: 0 15px 20px;
	  	border-bottom: 2px solid $green-border;
	  	padding: 5px 10px 5px 0;
	  	font-size: 1.1em;
	}

	div{
		margin: 0 0 15px 0;
	  	border : none;
	}

	label {
	  	display: inline-block;
	  	width: 25%;
	  	text-align: right;
	  	margin: 10px
	}

	input[type=text], input[type=password]{
  		width: 65%; 
  		font-family: "Lucida Grande","Lucida Sans Unicode",Tahoma,Sans-Serif;
  		padding: 5px;
  		font-size: 0.9em;
  		border-radius: 5px;
  		background: rgba(0, 0, 0, 0.07);
	}
  
  input[type=text]:focus, input[type=password]:focus{
		background: #FFFFFF;
	}

	.button {
  		font-size: 1em;
  		border-radius: 8px;
  		padding: 10px;
  		border: 1px solid #59B969;
  		box-shadow: 0 1px 0 0 #60BD49 inset;
  		@include linear-gradient(#63E651, #42753E);
  		
		&:hover {
  			@include linear-gradient(#51DB1C, #6BA061);
  		}
	}
	
	.sep {
	  	border: 1px solid $green-border;
	  	position: relative;
	  	margin: 35px 20px;
	}

	.or {
	  	position: absolute;
	  	width: 50px;
	 	left: 50%;
	  	background: $back-color;
	  	text-align: center;
	  	margin: -10px 0 0 -25px;
	  	line-height: 20px;
	}

	.connect {
	  	width: 400px;
	  	margin: 0 auto;
	  	text-align: center;
	}

	.social-buttons {
	  	display: inline-block;
	  	min-width: 150px;
	  	height: 50px;
	  	margin: 0 5px 10px;
	  	border-radius: 10px;
	  	text-shadow: 1px 1px 5px #000000;

	  	a {
	  		display: block;
	  		height: 100%;
	  		text-decoration: none;
	  		color: #FFFFFF;
	  		padding: 10px 15px;
		}

		span {
	  		font-size: 30px;
	  		margin-left: 35px;
		}
	}

	
	
}
</style>
</head>
<body>
   
<?php include 'admin_header.php'; ?>
<?php include ("manage_product.php");?>
<!-- product CRUD section starts  -->
 
<!-- <section class="add-products">

   <h1 class="title">shop products</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>add product</h3>
      <input type="text" name="name" class="box" placeholder="enter product name" required>
      <input type="number" min="0" name="price" class="box" placeholder="enter product price" required>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="add product" name="add_product" class="btn">
   </form>

</section> -->
<div class="box1">
  <div class="two "style="position:relative;left:00px;top:100px; ">
        <div class="register">
          <h3 style="font-size:18px; position:relative;left:150px;" >Add Category</h3>
          <form id="reg-form1" method="POST" enctype="multipart/form-data">

          
          <div>
              <label for="" style="font-size:15px;"> Sub Cat Name</label>
              <select name="sub_name" id="" >
                <option value="">-- Select Sub Category--</option>
                <?php
            $get_cat="select * from add_sub_category where status='on'";
            $run_cat=mysqli_query($conn,$get_cat);
            while($row=mysqli_fetch_array($run_cat)){
                ?>
                 <option value="<?php echo $row['sub_catagory_name']; ?>"><?php echo $row['sub_catagory_name']; ?></option>
                 <?php
            }

              ?>
              
              </select>
            </div>

            <div>
              <label for="name1" style="font-size:15px;"> Product Name</label>
              <input type="text" style="font-size:12px;" name="p_name" id="name1"  placeholder="Enter category name"/>
            </div>
            <div>
              <label for="p_price" style="font-size:15px;"> Product Price</label>
              <input type="text" style="font-size:12px;" name="price" id="p_price"  placeholder="Enter category name"/>
            </div>
            <div>
              <label for="mnbhimage" style="font-size:15px;"> Product Image</label>
              <input type="file" style="font-size:12px;" name="image"  placeholder="Enter category name"/>
            </div>

            <div>
              <label for="" style="font-size:15px;"> Sub Cat Status</label>
              <select name="p_status" id="" >
                <option value="">-- Select Status--</option>
                <option value="on">On</option>
                <option value="of">Of</option>
              </select>
            </div>
            
              <label></label>
              <div class="b"></div>
              <input style="font-size:14px;font-weight: bold;position:relative;left:200px;top:-25px;"type="submit" name="submit_p" value="Submit" id="create-account1" class="button"/>
              </div>
            </div>
          </form>
          
          </div>
        </div>
      </div>
</div>

<!-- product CRUD section ends -->

<!-- show products  -->

<section class="show-products"style="position:relative;top:150px;">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <img style="position:relative;top:1px;" src="<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['product_name']; ?></div>
         <div class="price">₹<?php echo $fetch_products['price']; ?></div>
         
         <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img style="position:relative;top:1px;" src="<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['product_name']; ?>" class="box" required placeholder="enter product name">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter product price">
      <input type="file" class="box" name="update_image" >
      <input type="submit" value="update" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>







<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
<?php
if(isset($_POST['submit_p'])){
    $pname=$_POST['p_name'];
    $name=$_POST['sub_name'];
    $pprice=$_POST['price'];
    $pstatus=$_POST['p_status'];
    $pimage=$_FILES['image'];

    $imagelocation=$_FILES['image']['tmp_name'];
    $imagename=$_FILES['image']['name'];
    $imgagedestination="uploaded_img/".$imagename;
    move_uploaded_file($imagelocation,"uploaded_img/".$imagename);

  $ins_product="insert into products(name,product_name,price,image,product_status)values('$name','$pname','$pprice','$imgagedestination','$pstatus')";
  $run_data=mysqli_query($conn,$ins_product);
  if($run_data){
    ?>
    <script>
        location.replace("admin_products.php");
        alert("Product Submited");
    </script>
    <?php
  }else{
    ?>
    <script>
        location.replace("admin_products.php");
        alert("Product Not Submited");
    </script>
    <?php
  }

}

?>