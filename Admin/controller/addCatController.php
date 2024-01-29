<?php
    include_once "../config/dbconnect.php";
    
    if(isset($_POST['upload']))
    {
       
        $catname = $_POST['cat_name'];
       
         $insert = mysqli_query($conn,"INSERT INTO categories
         (cat_name) 
         VALUES ('$catname')");
 
         if(!$insert)
         {
             echo mysqli_error($conn);
             header("Location: ../index.php?categories=error");
         }
         else
         {
             echo "Records added successfully.";
             header("Location: ../index.php?categories=success");
         }
     
    }
        
?>