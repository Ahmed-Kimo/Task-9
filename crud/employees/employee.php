
<?php

include_once './database.php' ;
?>


<!-- header -->
<?php include_once './layouts/header.php' ; ?>


<!-- nav -->
<?php include_once './layouts/nav.php' ; ?>


<!-- table -->
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="p-3 col text-center mt-5 text-white bg-primary"> All Employees </h2>
</div>

<?php
if(count($db->read("employees"))) :
?>

<div class="col-sm-12">
        <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Department</th>
      <th scope="col">Password</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($db->read('employees') as $row) : ?>
    <tr>
      
      <td> <?php echo strtoupper($row['Name']) ?> </td>
      <td> <?php echo ($row['Email']) ?> </td>
      <td> <?php echo strtoupper($row['Department']) ?> </td>
      <td> <?php echo ($row['Password']) ?> </td>

      <td> 
            <a href="./edit.php?id=<?php echo $row['id'] ?>" class="text-primary">
           <input type="submit" value="Edit">
           </a>
           <!-- <i class="fa-solid fa-pen-to-square"></i> -->
         </td>

      <td>
      <a href="./delete.php?id=<?php echo $row['id'] ?>" class="text-danger">
           <input type="submit" value="delete">
           </a>
           <!-- <i class="fa-solid fa-delete-left"></i> -->
      </td>

    </tr>
    <?php endforeach ; ?>
  </tbody>
</table>
<?php else : ?>
    <div class="col-sm-12">
        <h2 class="alert alert-danger mt-5 text-center">Not Found Data</h2>
    </div>
<?php endif ; ?>
</div>

        
    </div>
</div>


<!-- footer -->
<?php include_once './layouts/footer.php' ; ?>