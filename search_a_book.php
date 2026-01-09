<?php
require_once "connection.php";
$conn = new Connection();
$pdo = $conn->connect();

$search = "";

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}

$results = [];

if (!empty($search)) {
    $sql = "
        SELECT title, publication_year
        FROM books
        WHERE title LIKE :search
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':search' => "%$search%"
    ]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("assets/img/Books-1.jpg");
        }

        table {
            margin: 40px auto;
            border-collapse: collapse;
            width: 70%;
            background-color: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #c16565ff;
            text-align: left;
        }

        th {
            background-color: #760303ff;
        }

        .no-results {
            text-align: center;
            margin-top: 30px;
            font-size: 18px;
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

<a class="btn" href="search_a_book.html">Search other book </a>
<?php if (!empty($search)): ?>

    <?php if (count($results) > 0): ?>
        <table>
            <tr>
                <th>Title</th>
                <th>Publication year</th>
               
            </tr>

            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars(string: $row['publication_year']) ?></td>

                    
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <div class="no-results">
            No books found for "<strong><?= htmlspecialchars($search) ?></strong>"
        </div>
    <?php endif; ?>

<?php else: ?>
    <div class="no-results">
        Please enter a book title to search.
    </div>
<?php endif; ?>

</body>
</html>
