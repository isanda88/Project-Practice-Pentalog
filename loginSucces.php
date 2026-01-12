<?php
require_once "connection.php";
$conn = new Connection();
$pdo = $conn->connect();

// PARTEA DE LA EDIT PUBLISHER
$sql = "SELECT id, name FROM publishers ORDER BY name ASC";
$stmt = $pdo->query($sql);
$all_publishers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// variabile pentru editare
$selected_id = isset($_POST['publisher_id']) ? $_POST['publisher_id'] : null;
$publisher_name = "";
$success_message = "";

// editura selectata din baza de date
if ($selected_id) {
    $sql = "SELECT * FROM publishers WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $selected_id]);
    $publisher = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$publisher) {
        die("Editura nu există.");
    }

    $publisher_name = $publisher['name']; /*ce am selectat apare in camp */
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


//PARTEA DE CAUTARE + STERGERE

$search = "";
$results = [];

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
    if ($search !== "") {
        $stmt = $pdo->prepare("
            SELECT id, title, publication_year
            FROM books
            WHERE title LIKE :search
        ");
        $stmt->execute([
            ':search' => "%$search%"
        ]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

if (isset($_POST['delete_id'])) {
    $deleteId = (int)$_POST['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = :id");
    $stmt->execute([':id' => $deleteId]);

    header("Location: about_our_collection.php?search=" . urlencode($_POST['search']));
    exit;
}

//PARTEA DE INSERARE

    $authors = $pdo->query("SELECT id, first_name, last_name FROM authors ORDER BY first_name ASC")->fetchAll(PDO::FETCH_ASSOC);
    $publishers = $pdo->query("SELECT id, name FROM publishers ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);

/* date citite prin post, valorile transmise e utilizator */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert_book'])) {
    $title = $_POST['title'];
    $author_id = $_POST['author'];
    $publisher_id = $_POST['publisher'];
    $year = $_POST['year'];

    /*inserare in baza de date*/
    $stmt = $pdo->prepare("INSERT INTO books (title, author_id, publisher_id, publication_year) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$title, $author_id, $publisher_id, $year])) {
        header("Location: about_our_collection.php?success=1"); 
        exit();
    } else {
        $message = "Error inserting book.";
    }
}

?>
<!--HTML FINAL; -->

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

<!--FORMA CAUTARE  -->

        <style>
            form.example input[type=text] {
            padding: 20px;
            font-size: 15px;
            border: 1px solid grey;
            float: left;
            width: 100%;
            background: #f1f1f1;
            }

            form.example button {
            float: left;
            width: 20%;
            padding: 10px;
            background: #2196F3;
            color: white;
            font-size: 17px;
            border: 1px solid grey;
            border-left: none;
            cursor: pointer;
            }

            form.example button:hover {
            background: #0b7dda;
            }

            form.example::after {
            content: "";
            clear: both;
            display: table;
            }

        </style>


<!--INSERT STYLE-->
<style>
        /*o forma mai simplificata*/
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
                        <!-- <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="search_a_book.html">Search a book</a></li> -->
                        <!-- <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="edit_the_library.php">Edit the publisher name for a book</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="delete_a_book.php">Delete a book</a></li>
                         <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="insert_a_book.php">Insert a book in library</a></li> -->
                         <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="Datalogin.php">Login</a></li>
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

  <!-- CAUTAREA--

<br>
<br>
<br>
<br>
<h1>You can search a book from our library...</h1>
<br>






<!-- forma de search -->


 <form class="example" action="search_a_book.php" method="get">
                                <input type="text" placeholder="Search book title..." name="search" required>
                                <button type="submit">Search</button>
                            </form>
<!--cat timp am ceva in forma de cautare, se transpune linie cu linie in tabel-->
<?php if ($search !== ""): ?>

    <?php if (count($results) > 0): ?>
        <table>
            <tr>
                <th>Title</th>
                <th>Year</th>
                <th>Action</th>
            </tr>

            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['publication_year']) ?></td>
                    <td>
                        <form method="post"
                              onsubmit="return confirm('Delete this book?');">
                            <input type="hidden" name="delete_id"
                                   value="<?= $row['id'] ?>">
                            <input type="hidden" name="search"
                                   value="<?= htmlspecialchars($search) ?>">
                            <button class="btn" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <div class="no-results">
            No books found for "<strong><?= htmlspecialchars($search) ?></strong>"
        </div>
    <?php endif; ?>

<?php endif; ?>

<br>
<br>
<br>
<br>
<br>

<div class="form-container">
    <h2>Insert a new book in our library</h2>

    <form action="" method="post">
        <input type="hidden" name="insert_book" value="1">

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
            <input type="number" name="year" id="year" placeholder="e.x., 2026" required min="1000" max="<?= date('Y') ?>">
        </div>

        <button type="submit" class="submit-btn">Insert</button>
    </form>
</div>










</body>








<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>















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






<a class="btn" href="about_our_collection.html">Home</a>















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




































