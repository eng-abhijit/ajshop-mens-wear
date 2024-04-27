<?php

include 'config.php';

if(isset($_POST)){
    $s_id=$_POST['s_id'];
    $status=$_POST['status'];

    $update_table="update add_sub_category set status='$status' where id='$s_id'";
    $run_table=mysqli_query($conn,$update_table);
    if($run_table){
        ?>
        <script>
            location.replace("manage_sub_category.php");
            alert(" Update successful");
        </script>
        <?php
    }else{
        ?>
        <script>
             location.replace("manage_sub_category.php");
            alert(" Update Failed");
        </script>
        <?php
    }
    }




?>


