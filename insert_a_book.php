<?php
require_once "connection.php";
$conn = new Connection();
$pdo = $conn->connect();



$authors = $pdo->query("SELECT id, first_name, last_name FROM authors ORDER BY first_name ASC")->fetchAll(PDO::FETCH_ASSOC);
$publishers = $pdo->query("SELECT id, name FROM publishers ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author_id = $_POST['author'];
    $publisher_id = $_POST['publisher'];
    $year = $_POST['year'];

    $stmt = $pdo->prepare("INSERT INTO books (title, author_id, publisher_id, publication_year) VALUES (?, ?, ?, ?)");
   if ($stmt->execute([$title, $author_id, $publisher_id, $year])) {
        
        header("Location: about_our_collection.php?success=1");
        exit();
    } else {
        $message = "Error inserting book.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert a Book - Soul's Library</title>
    <link rel="icon" type="image/x-icon" href="assets/Book_25711.ico" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        body { font-family: 'Raleway', sans-serif; background-color: #fdf6f0; padding: 20px; }
        .form-container { max-width: 600px; margin: 50px auto; background: #fff7f0; padding: 30px; border-radius: 15px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
        .form-container h2 { text-align: center; margin-bottom: 20px; color: #d35400; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; font-size: 16px; }
        .form-group input:focus, .form-group select:focus { border-color: #d35400; outline: none; }
        .submit-btn { background-color: #d35400; color: white; padding: 12px 20px; border: none; border-radius: 10px; font-size: 18px; cursor: pointer; width: 100%; }
        .submit-btn:hover { background-color: #e67e22; }
        .message { text-align: center; margin-bottom: 15px; font-weight: bold; color: green; }


         .btn-bottom {
            margin: 20px auto;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .btn {
            display: inline-block;
            padding: 0.9rem 1.8rem;
            font-size: 16px;
            font-weight: 700;
            color: white;
            border: 3px solid rgb(252, 70, 100);
            cursor: pointer;
            position: relative;
            background-color: transparent;
            text-decoration: none;
            overflow: hidden;
            z-index: 1;
            font-family: inherit;
        }

        .btn::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgb(252, 70, 100);
            transform: translateX(-100%);
            transition: all .3s;
            z-index: -1;
        }

        .btn:hover::before {
            transform: translateX(0);
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Insert a new book in our library</h2>

    <?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>

    <form action="" method="post">
        <div class="form-group">
            <label for="title">A new title</label>
            <input type="text" name="title" id="title" placeholder="Enter book title..." required>
        </div>

       <div class="form-group">
    <label for="author">Author</label>
    <select name="author" id="author" required>
        <option value="">Select author...</option>
        <?php foreach($authors as $author): ?>
            <option value="<?= $author['id'] ?>">
                <?= htmlspecialchars($author['first_name'] . ' ' . $author['last_name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>


        <div class="form-group">
            <label for="publisher">Publisher</label>
            <select name="publisher" id="publisher" required>
                <option value="">Select publisher...</option>
                <?php foreach($publishers as $publisher): ?>
                    <option value="<?= $publisher['id'] ?>"><?= htmlspecialchars($publisher['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="year">Publication Year</label>
            <input type="number" name="year" id="year" placeholder="e.g., 2023" required min="1000" max="<?= date('Y') ?>">
        </div>

        <button type="submit" class="submit-btn">Insert Book</button>
    </form>
</div>
<div class="btn-bottom">

    <a class="btn" href="index.html">Back to home</a>

</div>


</body>
</html>
