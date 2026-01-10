<?php
require_once "connection.php";
$conn = new Connection();
$pdo = $conn->connect();

// drop down cu editurile
$sql = "SELECT id, name FROM publishers ORDER BY name ASC";
$stmt = $pdo->query($sql);
$all_publishers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// variabile pentru editare
$selected_id = isset($_POST['publisher_id']) ? $_POST['publisher_id'] : null;
$publisher_name = "";
$success_message = "";

// editura selectata
if ($selected_id) {
    $sql = "SELECT * FROM publishers WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $selected_id]);
    $publisher = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$publisher) {
        die("Editura nu există.");
    }

    $publisher_name = $publisher['name'];
}

// daca am modificat
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $new_name = trim($_POST['name']);

    $update = "UPDATE publishers SET name = :name WHERE id = :id";
    $stmt = $pdo->prepare($update);
    $stmt->execute([
        ':name' => $new_name,
        ':id' => $selected_id
    ]);

    $success_message = "Editura a fost actualizată cu succes!";
    $publisher_name = $new_name;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Soul's Library</title>
         <link rel="icon" type="image/x-icon" href="assets/Book_25711.ico" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <header>
            <h1 class="site-heading text-center text-faded d-none d-lg-block">
                 <span class="site-heading-upper text-primary mb-3">For your soul every book is very beautiful...</span>
                 <span class="site-heading-lower">Collection for you</span>
            </h1>
        </header>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
            <div class="container">
                <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="index.html">Home</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="about_our_collection.html">About</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="search_a_book.html">Search a book</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="edit_the_library.php">Edit the publisher name for a book</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="delete_a_book.php">Delete a book</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="page-section cta">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                            <h2 class="section-heading mb-5">
                                
                            </h2>
                            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                <li class="list-unstyled-item list-hours-item d-flex">
                                  
                               

                        <div class="container py-5">
                            <h1 class="mb-4 text-center">You can edit the publisher name for a book :) </h1>
<!-- editura pe care o selectez -->
                            <?php if ($success_message): ?>
                                <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
                            <?php endif; ?>

                            <form method="post" class="mb-4">
                                <div class="mb-3">
                                    <label for="publisher_id" class="form-label">I want to edit the publisher</label>
                                    <select name="publisher_id" id="publisher_id" class="form-select" onchange="this.form.submit()">
                                        <option value="">select a publisher... </option>
                                        <?php foreach ($all_publishers as $pub): ?>
                                            <option value="<?= $pub['id'] ?>" <?= ($pub['id'] == $selected_id) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($pub['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </form>
<!-- editura modificata -->
                            <?php if ($selected_id): ?>
                                <form method="post">
                                    <input type="hidden" name="publisher_id" value="<?= $selected_id ?>">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Publisher Name</label>
                                        <input type="text" name="name" id="name" class="form-control" 
                                            value="<?= htmlspecialchars($publisher_name) ?>" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            <?php endif; ?>

                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>



                            </ul>
                            <p class="address mb-5">
                                <em>
                                    <strong>The only way to do great work is to love what you do</strong>
                                    <br />
                                    
                                </em>
                            </p>
                            <p class="mb-0">
                                <small><em>Call Anytime</em></small>
                                <br />
                                0784722157
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section about-heading">
            <div class="container">
                <img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="assets/img/about.jpg" alt="..." />
                <div class="about-heading-content">
                    <div class="row">
                        <div class="col-xl-9 col-lg-10 mx-auto">
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer text-faded text-center py-5">
            <div class="container"><p class="m-0 small">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>




































