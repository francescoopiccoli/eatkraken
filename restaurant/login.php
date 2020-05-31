<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php"); ?>

<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/common_head.php"); ?>


<body style="background-image: linear-gradient(white, #2e3333); height: 80%;">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/navbar.php"); ?>

<div class="container text-center allButFooter" style="margin-top:7%">
  <div style="">
    <h1>EATKRAKEN</h1>
    <h2>Enter in your restaurant account</h2>
    <br>

    <form method="POST" action="/restaurant/auth.php">
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
    <br>
    <b style="color: red; font-family: 'Acme'"><?= (isset($_GET['error']) ? "Wrong token, please try again!" : "") ?></b>
    <br><br>
    <img alt="eatkraken_logo" title="eatkraken_logo" style="width:10%" src="https://icons.iconarchive.com/icons/google/noto-emoji-animals-nature/512/22297-octopus-icon.png">
  </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/footer.php"); ?>
</body>
</html>

