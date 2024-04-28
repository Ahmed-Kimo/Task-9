<!-- header -->
<?php include_once './layouts/header.php' ; ?>
<!-- nav -->
<?php include_once './layouts/nav.php' ; ?>


<?php $row = $db->find('employees' , $_GET['id']) ; ?>
<?php if(isset($_GET['id']) && is_numeric($_GET['id'])) : ?>
<?php if($row) : ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="p-3 col text-center mt-5 text-white bg-primary"> Edit Employees </h2>
</div>


</div>
</div>


    
   
    <?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $error = '' ;
    $success = '' ;

   $name = filter_var($_POST['name'] , FILTER_SANITIZE_STRING) ;
   $email = filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL) ;
   $department = filter_var($_POST['department'] , FILTER_SANITIZE_STRING) ;
   $password = filter_var($_POST['password'] , FILTER_SANITIZE_STRING) ;


   $departments = ['it' , 'cs' , 'is'] ;

   if(empty($name) || empty($email) || empty($department)){
    $error = 'Please Fill All fields' ;
   }else{

    if(filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)){
    $department = strtolower($department) ;
        if(in_array($department , $departments)){

            if(!empty($password)){
                $password = filter_var($_POST['password'] , FILTER_SANITIZE_STRING) ;

       if(strlen($password) > 6){

          $password = $db->enc_password($password) ;

   }else{
        $error = "Password Must be Greater Than 6 chars !" ;
       }

    } else{
        $password = $row['Password'] ; 
    }

       $sql = " UPDATE `employees` SET `Name` = '$name' , `Email` = '$email' ,
        `Department` = '$department' , `Password` = '$password' WHERE `id` = $row[id] ; " ;
        $success = $db->update($sql) ;

        }else{
                 $error = 'This Department Not Found' ;
        }

    }else {
            $error = 'Please type Valid Email' ;
    }

   }

}

?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
    <?php if(!empty($error)) : ?>
            <h2 class="p-2 col text-center mt-5 alert alert-danger">
          <?php echo $error ; ?>
            </h2>
    <?php endif ; ?>

    <?php if(!empty($success)) : ?>
            <h2 class="p-2 col text-center mt-5 alert alert-info">
          <?php echo $success ; ?>
            </h2>
    <?php endif ; ?>
        </div>
    </div>
</div>

    <!-- form -->
<div class="container">
    <div class="row">
        <div class="col-8 mt-5 ml-5">
        <form class="border bg-success" action="<?php $_SERVER['PHP_SELF'] ; ?>" method="post">
<div class="container mt-5">
<div class="mb-5">

    <input type="text" class="form-control" placeholder="Name" name="name"
    value="<?php echo $row['Name'] ; ?>">
    
  </div>

<div class="mb-5">
    
    <input type="text" class="form-control" placeholder="Email address" name="email" 
    value="<?php echo $row['Email'] ; ?>">
    
  </div>

<div class="mb-5">
    
    <input type="text" class="form-control" placeholder="Department" name="department"
    value="<?php echo $row['Department'] ; ?>">
    
  </div>

  <div class="mb-5">
    
    <input type="password" class="form-control" placeholder="Password" name="password">
  </div>
  
  <button type="submit" class="btn btn-primary mb-5">Update</button>
</div>
</form>


       </div>
    </div>
</div>

 <?php endif ; ?>
 <?php endif ; ?>




<!-- footer -->
<?php include_once './layouts/footer.php' ; ?>