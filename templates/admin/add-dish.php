<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/common_head.php"); ?>
<body>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/navbar.php"); ?>


<div class="container-fluid text-center mainbody">    
  <div class="row content">
    <div class="col-sm-12 text-left"> 
      <h1>Add new dish</h1>
      
      <form action="" class="text-center">
        <input type="text" class="form-control" placeholder="Name" required>
        <br>
        <input type="text" class="form-control" placeholder="Short description" required>
        <br>
        <input type="text" class="form-control" placeholder="Category" required>
        <br>
        <input type="text" class="form-control" placeholder="Price" required>
        <br>
        <input type="text" class="form-control" placeholder="Ingredients" required>
        <br>
        <input type="text" class="form-control" placeholder="Allergenes (select)" required>
        <br>
        <input type="text" class="form-control" placeholder="......" required>
        <br>
        <br>
        <input type="submit" value="Send" class="btn btn-success">
      </form>
    </div>
  </div>
</div>

<br><br>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>

</body>
</html>

