
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

        <!-- <link href="css/styles.css" rel="stylesheet" /> -->
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


button {
 display: flex;
 height: 3em;
 width: 100px;
 align-items: center;
 justify-content: center;
 background-color: #eeeeee4b;
 border-radius: 3px;
 letter-spacing: 1px;
 transition: all 0.2s linear;
 cursor: pointer;
 border: none;
 background: #fff;
}

button > svg {
 margin-right: 5px;
 margin-left: 5px;
 font-size: 20px;
 transition: all 0.4s ease-in;
}

button:hover > svg {
 font-size: 1.2em;
 transform: translateX(-5px);
}

button:hover {
 box-shadow: 9px 9px 33px #d1d1d1, -9px -9px 33px #ffffff;
 transform: translateY(-2px);
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

        /* Stil butoane */
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

        .Btn-Container svg {
            width: 24px;
            height: 24px;
            fill: white;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }

        .Btn-Container:hover svg {
            transform: scale(1.2);



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

 <button onclick="window.location.href='about_our_collection.html'">
  <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
    <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 
    188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099
    -4.001127 3.990894-9.240455 5.996574-14.46955 5.996574
    -5.239328 0-10.478655-1.995447-14.479783-5.996574
    l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955
    0-5.433756 2.159176-10.632151 5.996574-14.46955
    l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0
    7.992021 8.002254 7.992021 20.957311 0 28.949332
    l-188.073446 188.073446 604.753497 0
    C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z">
    </path>
  </svg>
  <span>Back</span>
</button>



    <div class="button-bottom">
        <button class="Btn-Container" onclick="window.location.href='sort_books_by_publisher_name.php?sort=asc'">
            <br>Ascending
            <br>Sort by publisher name
        </button>

        <button class="Btn-Container" onclick="window.location.href='sort_books_by_publisher_name.php?sort=desc'">
            <br>Descending
            <br>Sort by publisher name
        </button>
    </div>




</body>


<?php
require_once "connection.php";
$conn = new Connection();
$pdo = $conn->connect();

$stmt = $pdo -> query("SELECT * FROM publishers");
$books = $stmt -> fetchAll(PDO::FETCH_ASSOC);

?>


<table border="5">
    <tr>
        <th>ID</th>
        <th>Nume</th>
        <th>Cărți</th>
       
    </tr>

<?php
foreach ($books as $b): ?>
<tr>
        <td><?= htmlspecialchars(string: $b['id']) ?></td>
        <td><?= htmlspecialchars($b['name']) ?></td>
        <td><?= htmlspecialchars($b['books']) ?></td>
        
    </tr>
    <?php endforeach; ?>
</table>