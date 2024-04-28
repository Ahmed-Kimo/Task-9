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
            <h2 class="p-3 col text-center mt-5 text-white bg-primary"> Delete Employees </h2>
</div>

<h2 class="p-2 col text-center mt-5 alert alert-info">
          <?php echo $db->delete('employees' , $row['id']) ; ?>
            </h2>

<?php endif ; ?>
<?php endif ; ?>

<!-- footer -->
<?php include_once './layouts/footer.php' ; ?>