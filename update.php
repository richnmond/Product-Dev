 <?php
/** @var $pdo  /PDO*/
 require_once "database.php";
 require_once  "functions.php";



$id = $_POST ['id'] ?? null;

if (!$id) {
    header('location: index.php');
    exit;
}
$statement = $pdo->prepare('SELECT*FROM products WHERE id=:id');
$statement->bindValue(':id',$id);
$statement->execute();
$product = $statement->fetch(PDO:: FETCH_ASSOC);

$error = [];

$title = $product ['title'];
$price = $product ['price'];
$description = $product ['description'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    require_once "validate_product.php";

    if (empty($errors)) {
       
        $statement = $pdo->prepare("UPDATE products SET $title = :title, 
                    $image = :image, $description = :description, 
                    $price = :price WHERE $id =:id");



        $statement->bindvalue(':title', $title);
        $statement->bindvalue(':image', $imagePath);
        $statement->bindvalue(':description', $description);
        $statement->bindvalue(':price', $price);
        $statement->bindvalue(':id', $id);
        $statement->execute();
        header('Location: index.php');



    }
}

?>
<?php include_once "views/partials/header.php"; ?>
<p>
    <a href="index.php" class="btn btn-secondary" > Go back to products</a>
</p>

<h1>update product <b> <?php echo $product ['title']?></h1>


<h1>Create New Product</h1>


<div class="alert alert-danger"</div>

<?php include_once "views/partials/header.php/form.php"?>

</body>
</form>
</html>
