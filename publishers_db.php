<?php
require_once "connection.php";
$conn = new Connection();
$pdo = $conn->connect();

$sort = isset($_GET['sort']) && $_GET['sort'] === 'desc' ? 'DESC' : 'ASC';

/* concatenarea id-urilor din books conform editurilor */
$stmt = $pdo->query("

    SELECT 
        p.id,
        p.name,
        (SELECT GROUP_CONCAT(b.title SEPARATOR ',')
         FROM books b
         WHERE b.publisher_id = p.id) AS book_ids
    FROM publishers p
    ORDER BY p.name $sort
");

$publishers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Soul's Library</title>
    <link rel="icon" type="image/x-icon" href="assets/Book_25711.ico"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700" rel="stylesheet" />
    <style>
        body {
            background-image: url("assets/img/books3.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Raleway', sans-serif;
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
            position: fixed;
            bottom: 210px;        
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 20px;           
            z-index: 1000;
        }
        .Btn-Container {
            width: 140px;
            height: 80px;
            border-radius: 40px;
            background-color: rgba(161, 35, 35, 1);
            border: none;
            display: flex;
            flex-direction: column;
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



<div class="button-bottom">
    <button class="Btn-Container" onclick="window.location.href='?sort=asc'">
        Ascending
        <br>Sort by publisher name
    </button>

    <button class="Btn-Container" onclick="window.location.href='?sort=desc'">
        Descending
        <br>Sort by publisher name
    </button>
</div>

<div class="btn-bottom">
    <a class="btn" href="about_our_collection.php">See Books IDs</a>
    <a class="btn" href="about_our_collection.html">Home</a>
</div>

<table border="5">
    <tr>
        <th>ID</th>
        <th>Nume</th>
        <th>Cărți (ID-uri)</th>
    </tr>
    <?php foreach ($publishers as $p): ?>
        <tr>
    <!-- transpunerea in tabel  -->
            <td><?= htmlspecialchars($p['id']) ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= htmlspecialchars($p['book_ids']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
