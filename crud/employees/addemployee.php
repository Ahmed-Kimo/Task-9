<!-- header -->
<?php include_once './layouts/header.php' ; ?>


<!-- nav -->
<?php include_once './layouts/nav.php' ; ?>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $error = '' ;
    $success = '' ;

   $name = filter_var($_POST['name'] , FILTER_SANITIZE_STRING) ;
   $email = filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL) ;
   $department = filter_var($_POST['department'] , FILTER_SANITIZE_STRING) ;
   $password = filter_var($_POST['password'] , FILTER_SANITIZE_STRING) ;

   $departments = ['it' , 'cs' , 'is'] ;

   if(empty($name) || empty($email) || empty($department) || empty($password)){
    $error = 'Please Fill All fields' ;
   }else{

    if(filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)){
    $department = strtolower($department) ;
        if(in_array($department , $departments)){

       if(strlen($password) > 6){
  
         $newpassword = $db->enc_password($password) ;

         $sql = " INSERT INTO `employees` (`Name` , `Email` , `Department` , `Password`) 
         VALUES ('$name' , '$email' , '$department' , '$newpassword') " ;
        $success = $db->insert($sql) ;

       }else{
        $error = 'Password Must Be Greater Than 6 Chars !' ; 
       }

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
   
            <h2 class="p-2 col text-center mt-5 alert alert-primary">
          Add New Employee
            </h2>
    
        </div>
    </div>
</div>

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

    <input type="text" class="form-control" placeholder="Name" name="name">
    
  </div>

<div class="mb-5">
    
    <input type="text" class="form-control" placeholder="Email address" name="email">
    
  </div>

<div class="mb-5">
    
    <input type="text" class="form-control" placeholder="Department" name="department">
    
  </div>

  <div class="mb-5">
    
    <input type="password" class="form-control" placeholder="Password" name="password">
  </div>
  
  <button type="submit" class="btn btn-primary mb-5">Submit</button>
</div>
</form>
        </div>
    </div>
</div>


<!-- footer -->
<?php include_once './layouts/footer.php' ; ?>
