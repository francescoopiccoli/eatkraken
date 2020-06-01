<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/session.php"); 
$title = "Login - Eatkraken"?>

<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/common_head.php"); ?>

<body id="login-page-background">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/navbar.php"); ?>

<div class="container text-center main-content magin-top-7-per-cent">
  <div>
    <h1>EATKRAKEN</h1>
    <h2>Enter in your restaurant account</h2>
    <br>

    <form method="POST" action="/restaurant/auth.php">
      <div id="login-page-elements-centered">
        <div class="input-group">
        <span>
          <input id="token-field-login-page" type="password" class="form-control" name="login" placeholder="Enter your token"></span>
          <span class="input-group-btn">
          <input type="submit" value="Log in" class="btn btn-default btn-lg btn-approve" name="submit">
          </span>
        </div><!-- /input-group -->
      </div><!-- /.col-lg-6 -->
    </form>
    <br>
    <b id="login-error-message"><?= (isset($_GET['error']) ? "Wrong token, please try again!" : "") ?></b>
    <br><br>
    <img alt="eatkraken_logo" title="eatkraken_logo" class="octopus-logo" src="../images/logo_image.png">
  </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/footer.php"); ?>
</body>
</html>

