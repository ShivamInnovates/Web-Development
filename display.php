<html>
      <style>
          body{
            background-color:  #007bff;
          }
    
          h1{
            color:white;
          }

          table{
            background-color: white;
            border:2px solid, black;
          }

          .update, .delete{
            background-color: green;
            color:white;
            border-radius: 5px;
            text-style:none;
            height:25px;
            width:90px;
            font-weight:bold;
            cursor:pointer;
          }

          .delete{
            background-color: red;
          }
      </style>
</html>
<?php include('submit.php'); 
error_reporting(0);
 $query= "Select * from user_info";
 $data = mysqli_query($conn,$query);
 $total = mysqli_num_rows($data);
 

 if($total!=0)
 {
    ?>
    <h1 align="center"><u>Displaying Records</u></h1>
<center><table border="2px" cellspacing="7">
    <tr>
      <th width="0">ID</th>  
      <th width="20%">Name</th>
      <th width="10%">Gender</th>
      <th width="15%">Contact</th>
      <th width="20%">Email</th>
      <th width="10%">Password</th>
      <th width="20%">Operations</th>
    </tr>

    <?php
    while($result = mysqli_fetch_assoc($data))
    {
        echo "<tr>
        <td>$result[ID]</td>
        <td>$result[Name]</td>
        <td>$result[Gender]</td>
        <td>$result[Contact]</td>
        <td>$result[Email]</td>
        <td>$result[Password]</td>

        <td><a href='../PHP Form/update.php?id=$result[ID]'><input type='submit' 
        value='Update' class ='update'></a>

        <a href='../PHP Form/delete.php?id=$result[ID]'><input type='submit' 
        value='Delete' class ='delete' onclick= 'return checkDelete()'></a></td>
      </tr>";
    }        
 }
 else {
       echo "<h1>No record found</h1>";
 }

?>
</table></center>

<script>
      function checkDelete()
      {
         return confirm("Are you sure you want to delete this record ?");
      }
  </script>
    