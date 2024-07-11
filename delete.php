<?php include('submit.php'); 
$id= $_GET['id'];
$query= "Delete from user_info where id='$id'";
$data = mysqli_query($conn,$query);

if($data)
{
    echo "<script>alert('Record deleted');</script>";
    ?>
    <meta http-equiv = "refresh" content = "0; url = http://localhost/ShivamProject/PHP Form/display.php" />

    <?php
}
     else {
        echo "<script>alert('Failed to delete the Record');</script>";
    }
?>


