<?php
require_once "connection.php";
$conn = new Connection();
$pdo = $conn->connect();


$sort = 'ASC'; 
if (isset($_GET['sort'])) {
    if ($_GET['sort'] === 'asc') {
        $sort = 'ASC';
    } elseif ($_GET['sort'] === 'desc') {
        $sort = 'DESC';
    }
}
/*ia toate randurile din books si le sorteaza in fuctie de anul publciarii */
$stmt = $pdo->query("SELECT * FROM books ORDER BY publication_year $sort");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Soul's Library</title>
    <link rel="icon" type="image/x-icon" href="assets/Book_25711.ico"/>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />

    <style>
        body {
            background-image: url("assets/img/books3.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Raleway', sans-serif;
            margin: 0;
            padding: 20px 0;
        }

        table {
            margin: 20px auto;
            background-color: white;
            color: black;
            border-collapse: collapse;
            width: 80%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        th, td {
            border: 2px solid #333;
            padding: 10px 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        
        .button-bottom {
            margin: 20px auto;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .Btn-Container {
            width: 140px;
            height: 80px;
            border-radius: 40px;
            background-color: rgba(161, 35, 35, 1);
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0px 0px 10px rgba(180, 160, 255, 0.5);
            color: white;
            font-weight: 600;
            font-size: 14px;
            text-align: center;
            line-height: 1.2;
            padding: 10px;
        }

        .Btn-Container:hover {
            background-color: rgb(181, 160, 255);
            transform: scale(1.05);
        }

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



<table border="5">
    <tr> 
        <th>ID</th>
        <th>Title</th>
        <th>Publication year</th>
        <th>Author ID</th>
        <th>Publisher ID</th>
    </tr>
<!--se parcurge fiecare rand din tabela si se transpune in tabel b ul e linia curenta-->
    <?php foreach ($books as $b): ?>
    <tr>
        <td><?= htmlspecialchars($b['id']) ?></td>
        <td><?= htmlspecialchars($b['title']) ?></td>
        <td><?= htmlspecialchars($b['publication_year']) ?></td>
        <td><?= htmlspecialchars($b['author_id']) ?></td>
        <td><?= htmlspecialchars($b['publisher_id']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="button-bottom">
    <button class="Btn-Container" onclick="window.location.href='?sort=asc'"> <!--fin linkul url -->
        ↑<br>Ascending<br>Sort by Year
    </button>
    <button class="Btn-Container" onclick="window.location.href='?sort=desc'">
        ↓<br>Descending<br>Sort by Year
    </button>
</div>

<div class="btn-bottom">
    <a class="btn" href="authors_db.php">See Author IDs</a>
    <a class="btn" href="publishers_db.php">See Publisher IDs</a>
    <a class="btn" href="about_our_collection.html">Home</a>
</div>
    <!--butoanele sunt legate de style ul de mai sus-->
</body>
</html>
