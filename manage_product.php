<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin:0%;
            padding:0%;
        }
      ul{
        background-color:rgb(58, 39, 227);
        display:flex;
        list-style: none;
        align-items: center;
            justify-content: center;
            gap:100px;
            color:orange;
            font-weight: bolder;
            font-size: 20px;
      } 
      li{
        margin:10px;
        padding:15px;
       
      }
      a{
        color:orange;
      }
    </style>
</head>
<body>
    <ul>
        <li> <a href="manage_category.php">Category</a></li>
        <li> <a href="manage_sub_category.php">Subcategory</a></li>
        <li><a href="admin_products.php">Product</a></li>
    </ul>
</body>
</html>