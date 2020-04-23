<!DOCTYPE html>
<html lang="en">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/common_head.php"); ?>
<body>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/navbar.php"); ?>


  <div class="container-fluid text-center mainbody">    
    <div class="row content">
      <div class="col-sm-12 text-left"> 
        <h2>Pending orders</h2>
        <p>By accepting an order, you agree to deliver it on time at the specified conditions.</p>
        
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">User</th>
              <th scope="col">Order</th>
              <th scope="col">Due total</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">18355</th>
              <td>
                <b>Francesco Ricci</b><br>
                Via Alto Adige, 5 <br>
                00100 Bolzano (BZ) <br>
                <a href="tel:+393310123456">+39 331 012 3456</a>
              </td>
              <td>
                3x <b>Greta Burger</b> (€5)<br>
                <i>"Without onions, thanks!!!!!"</i>
                <br>
                2x <b>Large Coke</b> (€2.5)
                <hr>
                <b>Home delivery</b> (€5)
              </td>
              <td>€25</td>
              <td>
                Deliver within <b>40 minutes</b><br>
                <button class="btn btn-success btn-sm">
                  Accept
                </button> 
                <button class="btn btn-danger btn-sm">
                  Refuse
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <h2>Past orders</h2>
        see above, just instead of "actions" one sees "status" label (accepted/refused)
      </div>
    </div>
  </div>

  <?php include($_SERVER['DOCUMENT_ROOT'] . "/templates/widgets/footer.php"); ?>


</body>
</html>

