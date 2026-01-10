<?php
require_once "connection.php";
$conn = new Connection();
$pdo = $conn->connect();

$sort = isset($_GET['sort']) && $_GET['sort'] === 'desc' ? 'DESC' : 'ASC';


$stmt = $pdo->query("
    SELECT 
        p.id,
        p.name,
        (SELECT GROUP_CONCAT(b.id ORDER BY b.id SEPARATOR ',')
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


<button onclick="window.location.href='about_our_collection.php'">
    <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
        <path d="M874.69 495.52c0 11.3-9.17 20.47-20.47 20.47l-604.77 0 
        188.08 188.08c7.99 7.99 7.99 20.95 0 28.94
        -4 3.99-9.24 5.99-14.47 5.99
        -5.24 0-10.48-1.99-14.48-5.99
        l-223-223c-3.83-3.83-5.99-9.04-5.99-14.47
        0-5.43 2.16-10.63 5.99-14.47
        l223-223c7.99-7.99 20.96-7.99 28.95 0
        7.99 8.00 7.99 20.96 0 28.95
        l-188.07 188.07 604.75 0
        C865.52 475.06 874.69 484.22 874.69 495.52z"></path>
    </svg>
    <span>Back</span>
</button>


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
            <td><?= htmlspecialchars($p['id']) ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= htmlspecialchars($p['book_ids']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
