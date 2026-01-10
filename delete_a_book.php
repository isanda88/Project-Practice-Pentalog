<?php
require_once "connection.php";
$conn = new Connection();
$pdo = $conn->connect();



/* search anterior + stergere  */
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete books</title>


    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("assets/img/Books-1.jpg");
        }

        form.search {
            text-align: center;
            margin-top: 120px;
        }

        input[type="text"] {
            padding: 8px;
            width: 250px;
        }

        table {
            margin: 80px auto;
            border-collapse: collapse;
            width: 70%;
            background-color: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid rgb(230, 13, 13);
            text-align: left;
        }

        th {
            background-color: #760303ff;
            color: white;
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

        form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #dea20c;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

form.example button:hover {
  background: #e78208;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}
    </style>


</head>
<body>

<a class="btn" href="about_our_collection.html">Home</a>

<!-- forma de search -->
<form method="get" class="search">
    <input type="text" name="search" placeholder="Search book title..."
           value="<?= htmlspecialchars($search) ?>">
    <button class="btn" type="submit">Search</button>
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

</body>
</html>
