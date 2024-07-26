<?php

/** @var $pdo  /PDO*/
require_once "database.php";
require_once "functions.php";

$error = [];

$title = '';
$price = '';
$description = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
            require_once "validate_product.php";

            if(empty($errors)) {

        $statement = $pdo->prepare("INSERT INTO products (title, image, description, price, create_date)
              VALUES (':title',  ':image',':description', $price, ':date')");


        $statement->bindvalue(':title', $title);
        $statement->bindvalue(':image', '');
        $statement->bindvalue(':description', $description);
        $statement->bindvalue(':price', $price);
        $statement->bindvalue(':date',   $date, date('Y-m-d H:i:s'));

        header('Location: index.php');
        exit();




    }
}

?>

<?php include_once "views/partials/header.php"; ?>

<p>
    <a href="index.php" class="btn btn btn-sm secondary" > Go back to products</a>
</p>
<h1>Create New Product</h1>
<?php include_once "views/products/form.php"?>

</body>
</html>