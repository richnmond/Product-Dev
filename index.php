<?php

/** @var $pdo  /PDO*/
require_once "database.php";
require_once " function.php";

$search = $_GET['search'] ?? '';
if ($search) {
    $statement = $pdo->prepare('SELECT *FROM products WHERE title LIKE :title ORDER BY create_date DESC');
$statement->bindValue(':title', "%search%");
} else {
    $statement = $pdo->prepare('SELECT*FROM products ORDER BY create_date DESC');
}
$products = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include_once "views/partials/header.php"; ?>
<p>
    <a href="Create.php" Class="btn btn-success"> Create Product</a>
</p>

<form>
    <div class="input-group mb-3">
        <input type="text" class="form-control"
               placeholder="Search for Products"
               name="search" value <?php echo $search ?>>
        <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="Submit">search</button>
    </div>

    </div>
</form>


<h1>product dev</h1>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Title</th>
        <th scope="col">Price</th>
        <th scope="col">Create_date</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
   <?php foreach($products as $i => $product): ?>
       <th scope="row"><?php echo $i + 1 ?></th>
       <td><?php echo $product ['Title']?></td>
       <td><?php echo $product ['Price']?></td>
       <td><?php echo $product ['Create_date']?></td>
       <td>
           <button type="button" class="btn btn-sm btn-outline-primary">Edit</button>
           <a href="index.php?id <?php echo $product['id']?>" type="button" class="btn btn-sm btn-outline-danger">Delete</a>
       </td>

    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>