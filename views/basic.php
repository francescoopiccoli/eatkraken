<!DOCTYPE html>
<html lang="en">
<head>
  <title><?= $title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Khula">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/4978f3ffc8.js" crossorigin="anonymous"></script>
</head>
<body>

  <header>
  <?php require_once("widgets/navbar.php"); ?>
  </header>


<div class="container-fluid text-center mainbody">    
  <div class="row content">
    <div class="col-sm-3 .bg-secondary sidenav">
      <?= $sidebar_content; ?>
    </div>
    <div class="col-sm-9 text-left"> 
      <?= $body_content; ?>
    </div>
  </div>
</div>

<?php require_once("widgets/footer.php"); ?> 

</body>
</html>

