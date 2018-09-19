<?php
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM stock WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['name'])  && isset($_POST['price']) && isset($_POST['decript'])&& isset($_POST['suma']) ) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $decript = $_POST['decript'];
  $sum = $_POST['suma'];
  $sql = 'UPDATE stock SET name=:name, price=:price, decript=:decript, suma=:suma  WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':price' => $price, ':decript' => $decript , ':suma' => $sum ,':id' => $id])) {
    header("Location: /");
  }



}


 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update person</h2>
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
          <input value="<?= $person->name; ?>" type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="price">price</label>
          <input type="number" value="<?= $person->price; ?>" name="price" id="price" class="form-control">
        </div>
        <div class="form-group">
          <label for="decript">decript</label>
          <input type="number" value="<?= $person->decript; ?>" name="decript" id="decript" class="form-control">
        </div>
        <div class="form-group">
          <label for="suma">suma</label>
          <input type="number" value="<?= $person->suma; ?>" name="suma" id="suma" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update person</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
