<?php
require 'db.php';
$message = '';
if (isset ($_POST['name'])  && isset($_POST['price']) ) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $decript = $_POST['decript'];
  $suma = $_POST['suma'];
  $sql = 'INSERT INTO stock(name,price,decript,suma) VALUES(:name,:price,:decript,:suma)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':price' => $price, ':decript' => $decript, ':suma' => $suma])) {
    $message = 'data inserted successfully';
  }



}


 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Add stock</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="price">price</label>
          <input type="price" name="price" id="price" class="form-control">
        </div>
        <div class="form-group">
          <label for="decript">Email</label>
          <input type="decript" name="decript" id="decript" class="form-control">
        </div>
        <div class="form-group">
          <label for="suma">Email</label>
          <input type="suma" name="suma" id="suma" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Add stock</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
