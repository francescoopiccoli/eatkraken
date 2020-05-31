<nav class="navbar navbar-inverse navbar-custom">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" style="border:none" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/">
        <i class="fas fa-utensils"></i> 
        <span class="navbar-logo"><b>EATKRAKEN</b></span>
      </a>
    </div>
    <div class="collapse navbar-collapse navbar-right" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="/" title="Homepage"><i class="fas fa-home "></i></a></li>
        <li><a href="/list.php" title="Check the list"><i class="fas fa-clipboard-list "></i></a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/views/widgets/checkout.php"); ?>
      </ul>
    </div>
  </div>
</nav>