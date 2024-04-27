<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already added';
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image) VALUES('$name', '$price', '$image')") or die('query failed');

      if($add_product_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
         }
      }else{
         $message[] = 'product could not be added!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_products.php');

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

h1{
  font-size: 30px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
}
table{
  width:100%;
  table-layout: fixed;
}
.tbl-header{
  background-color: rgba(255,255,255,0.3);
 }
.tbl-content{
  height:300px;
  overflow-x:auto;
  margin-top: 0px;
  border: 1px solid rgba(255,255,255,0.3);
}
th{
  padding: 20px 15px;
  text-align: left;
  font-weight: 500;
  font-size: 12px;
  color: #fff;
  text-transform: uppercase;
}
td{
  padding: 15px;
  text-align: left;
  vertical-align:middle;
  font-weight: 300;
  font-size: 12px;
  color: #fff;
  border-bottom: solid 1px rgba(255,255,255,0.1);
}


/* demo styles */

@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
/* body{
  background: -webkit-linear-gradient(left, #25c481, #25b7c4);
  background: linear-gradient(to right, #25c481, #25b7c4);
  font-family: 'Roboto', sans-serif;
} */
.t1{
    background: -webkit-linear-gradient(left, #25c481, #25b7c4);
  background: linear-gradient(to right, #25c481, #25b7c4);
  font-family: 'Roboto', sans-serif;
  position:relative;
  top:150px;
}
.tbl-header{
    
}
section{
  margin: 50px;
}


/* follow me template */
.made-with-love {
  margin-top: 40px;
  padding: 10px;
  clear: left;
  text-align: center;
  font-size: 10px;
  font-family: arial;
  color: #fff;
}
.made-with-love i {
  font-style: normal;
  color: #F50057;
  font-size: 14px;
  position: relative;
  top: 2px;
}
.made-with-love a {
  color: #fff;
  text-decoration: none;
}
.made-with-love a:hover {
  text-decoration: underline;
}


/* for custom scrollbar for webkit browser*/

::-webkit-scrollbar {
    width: 6px;
} 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
} 
::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
}
</style>
</head>
<body>
   
<?php include 'admin_header.php'; ?>
<?php include ("manage_product.php");?>


<div class="box1">
  <div class="two "style="position:relative;left:00px;top:100px; ">
        <div class="register">
          <h3 style="font-size:18px; position:relative;left:150px;" >Add Category</h3>
          <form id="reg-form1" method="POST">

          
          <div>
              <label for="" style="font-size:15px;">Category Name</label>
              <select name="cat_id" id="" >
                <option value="">-- Select Category--</option>
                <?php
            $get_cat="select * from add_category where status='on'";
            $run_cat=mysqli_query($conn,$get_cat);
            while($row=mysqli_fetch_array($run_cat)){
                ?>
                 <option value="<?php echo $row['catagory_id']; ?>"><?php echo $row['catagory_name']; ?></option>
                 <?php
            }

              ?>
              
              </select>
            </div>

            <div>
              <label for="name1" style="font-size:15px;"> Sub Cat Name</label>
              <input type="text" style="font-size:12px;" name="sub_name" id="name1" spellcheck="false" placeholder="Enter category name"/>
            </div>
            <div>
              <label for="" style="font-size:15px;"> Sub Cat Status</label>
              <select name="sub_status" id="" >
                <option value="">-- Select Status--</option>
                <option value="on">On</option>
                <option value="of">Of</option>
              </select>
            </div>
            
              <label></label>
              <div class="b"></div>
              <input style="font-size:14px;font-weight: bold;position:relative;left:200px;top:-25px;"type="submit" name="submit" value="Submit" id="create-account1" class="button"/>
              </div>
            </div>
          </form>
          
          </div>
        </div>
      </div>
</div>


<div class="t1">
<section>
  <!--for demo wrap-->
  <h1 style="color:purple;font-size:25px;font-weight:bolder;">All SUB CATEGORY PRODUCT</h1>
  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
          <th style="font-size:16px;font-weight:bolder;">Sub Catagory Id</th>
          <th style="font-size:16px;font-weight:bolder;">Catagory Id</th>
          <th style="font-size:16px;font-weight:bolder;">Sub Catagory Name</th>
          <th style="font-size:16px;font-weight:bolder;">Status</th>
          <th style="font-size:16px;font-weight:bolder;">Update Status</th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
        <?php
        $get_sub_cat="select * from add_sub_category";
        $run_sub_cat=mysqli_query($conn,$get_sub_cat);
        while($row_sub=mysqli_fetch_array($run_sub_cat)){
            ?>

        <tr> 
          <td style="font-size:18px;font-weight:bolder;"><?php echo $row_sub['id'];?></td>
          <td style="font-size:18px;font-weight:bolder;"><?php echo $row_sub['catagory_id'];?></td>
          <td style="font-size:18px;font-weight:bolder;"><?php echo $row_sub['sub_catagory_name'];?></td>
          <td style="font-size:18px;font-weight:bolder;"><?php echo $row_sub['status'];?></td>
          <form action="sub_cat_up.php" method="POST">
          <td >
          <form action="sub_cat_up.php" method="POST">
            <input type="text" name="s_id" value="<?php echo $row_sub['id'];?>" hidden>
           <select name="status" id="">
           <option value="">--select--</option>
            <option value="on">on</option>
            <option value="off">off</option>
           </select>
           <input style="font: size 15px; " type="submit" name="submit" value="update">
          </form>


          </td>
        </tr>
       <?php
        }
        
        ?>
        
       
        
       
        
       
        
       
     
        
        
        
      </tbody>
    </table>
  </div>
</section>




   






<script>
    $(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
</script>
<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>

<?php

if(isset($_POST['submit'])){
$cat_id=$_POST['cat_id'];
$sub_name=$_POST['sub_name'];
$sub_status=$_POST['sub_status'];
$insdata="insert into add_sub_category(catagory_id,sub_catagory_name,status)values('$cat_id','$sub_name','$sub_status')";
$run_data=mysqli_query($conn,$insdata);

if($run_data){
    ?>
    <script>
        location.replace("manage_sub_category.php");
        alert(" Sub Category Added");
    </script>
    <?php
}else{
    ?>
    <script>
        location.replace("manage_sub_category.php");
        alert(" Not Added Sub Category");
    </script>
    <?php
}
}
?>