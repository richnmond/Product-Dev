<?php

$pdo = new PDO('mysql:host=localhost; port=3306;dbname=product dev','root','');
$pdo->setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
$error = [];

$title = 'title';
$price = 'price';
$description = 'description';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST ['title']; //test
    $description = $_POST ['description'];
    $price = $_POST ['price'];
    $date = date('Y-m-d H:i:s');


    if (!$title) {
        $errors[] = 'product title is required';
    }


    if (!$price) {
        $errors[] = 'product price is required';
    }
if (!is_dir('image')) {
    mkdir('image');
}



    if (empty($errors)) {
        $image = $_FILES ['image'] ?? null;

        $imagePath = '';

        if ($image && $image['tmp_name']) {

            $imagePath = 'path/to/your/image/file.jpg';

            if (!is_dir(dirname($imagePath))) {
                mkdir(dirname($imagePath), 0777, true);
            }


            move_uploaded_file($image['tmp_name'], $imagePath);
        }


        $statement = $pdo->prepare("INSERT INTO products (title, image, description, price, create_date)
              VALUES (':title',  ':image',':description', $price, ':date')");


        $statement->bindvalue(':title', $title);
        $statement->bindvalue(':image', '');
        $statement->bindvalue(':description', $description);
        $statement->bindvalue(':price', $price);
        $statement->bindvalue(':date', $title);

        header('Location: index.php');
        exit();




    }
}

function randomString($n)
{
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$str = '';
for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $str .= $characters[$index];


}
return $str;
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">
    <title>product dev</title>
</head>
<body>

<p>
    <a href="index.php" class="btn btn-secondary" > Go back to products</a>
</p>

<h1>Create New Product</h1>

<div class="alert alert-danger">

    <?php if (!empty($errors)) :?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>


<form action="" method="post" enctype="multipart/form-data">
    <!-- Form fields go here -->
    <div class="form-group">
        <label for="image">Product Image</label>
        <br>
        <input type="file" name="image" required>
    </div>
        <label for="title">Product Title</label>
        <input type="text" name="title"  value="<?php echo $title?>" required>
    </div>
    <div class="form-group">
        <label for="description">Product Description</label>
        <textarea name="description"  value="<?php echo $description?>" required></textarea>
    </div>
    <div class="form-group">
        <label for="price">Product Price</label>
        <input type="text" name="price" "<?php echo $price?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</body>
</form>
</html>
