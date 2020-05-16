<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php"); ?>

<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/common_head.php"); ?>


<body style="background-image: linear-gradient(white, #2e3333); height: 80%;">
<div class="container text-center allButFooter" style="margin-top:15%">
  <div style="">
    <h1>EATKRAKEN</h1>
    <br>
    <form method="POST" action="restaurant/add-dish.php">
  <div style="width:50%; margin-left:25%">
    <div class="input-group">
    <span>
      <input style="height:46px;" type="password" class="form-control" name="login" placeholder="Enter your token"></span>
      <span class="input-group-btn">
      <input type="submit" value="Log in" class="btn btn-default btn-lg" name="submit"  style="font-family:'Acme'; color: #73C6A0; border-color: #73C6A0">
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
    </form>
    <br><br><br>
    <img style="width:10%" src="https://icons.iconarchive.com/icons/google/noto-emoji-animals-nature/512/22297-octopus-icon.png">
  </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/footer.php"); ?>
</body>
</html>

