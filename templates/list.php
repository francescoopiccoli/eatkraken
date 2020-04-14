<!DOCTYPE html>
<html lang="en">
<?php include("widgets/common_head.php"); ?>
<body>

<?php include("widgets/navbar.php"); ?>

<div class="container-fluid text-center mainbody">    
  <div class="row content">
    <div class="col-sm-3 .bg-secondary sidenav text-left">
      <br><br>
      <h4>Deliverable to</h4>
      <div class="form-group">
        <select name="" id="" class="form-control"></select>
        <input type="text" name="" id="" class="form-control" placeholder="Address">
      </div>
      <br>
      <h4>Before (lo mettiamo?)</h4>
      <input type="datetime-local" name="" id="" class="form-control">
      <br>
      <h4>In category</h4>
      <select name="" id="" class="form-control"></select>
      <br>
      <h4>Show only</h4>
      <div class="">
        <input type="checkbox" name="" id="">
        <label for="">Gluten-free</label>
        <br>
        <input type="checkbox" name="" id="">
        <label for="">Lactose-free</label>
        <br>
        <input type="checkbox" name="" id="">
        <label for="">Vegan</label>
        <br>
        <input type="checkbox" name="" id="">
        <label for="">Mystery boxes</label>
        <br>
      </div>
    </div>
    <div class="col-sm-9 text-left"> 
      <h1>8 results in your area</h1>
      <p>All of them can deliver to your address.</p>
      
      <hr>
      <div class="row">
        <a class="col-md-2 col-sm-4 food-card" href="pizza">
          <div class="panel panel-default">
            <div class="panel-body list-thumb" style="background-image: url('https://cdn-media.italiani.it/site-caserta/2019/01/pizza-con-ananas-caserta-2.jpg'); background-size: cover; min-width: 100px; min-height: 120px;">
              
            </div>
            <div class="panel-footer">
              <b>Pizza Margherita</b> 
              <span class="text-right">$$$</span>
              <br>
              <small>Pizzeria Scarsa SNC</small>
              
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>


<?php include("widgets/footer.php"); ?>

</body>
</html>

