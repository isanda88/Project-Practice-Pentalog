<?php
require_once "connection.php";
$conn = new Connection();
$pdo = $conn->connect();


$sort = 'ASC'; // default
if (isset($_GET['sort'])) {
    if ($_GET['sort'] === 'asc') {
        $sort = 'ASC';
    } elseif ($_GET['sort'] === 'desc') {
        $sort = 'DESC';
    }
}

$stmt = $pdo->query("SELECT * FROM authors ORDER BY last_name $sort");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>








<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Soul's Library</title>

<style>
body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    background-image: url("assets/img/books3.jpg");
    background-size: cover;
    background-position: center;
    font-family: 'Raleway', sans-serif;
}

/* Tabel */
table {
    margin: 50px auto 150px auto; /* jos lăsăm spațiu pentru butoane */
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
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 20px;
    z-index: 1000;
}

/* Stil butoane mari */
.Btn-Container {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background-color: rgb(20, 20, 20);
    border: none;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0px 0px 10px rgba(180, 160, 255, 0.5);
}

/* Hover efect */
.Btn-Container:hover {
    background-color: rgb(181, 160, 255);
    transform: scale(1.1);
}

/* SVG stil */
.svgIcon {
    width: 24px;
    height: 24px;
    fill: white;
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

<!-- From Uiverse.io by Jedi-hongbin --> 
<button onclick="window.location.href='authors_db.php'">
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


<a class="btn" href="about_our_collection.html">Home </a>

<table border="5">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Age</th>
        <th>Books</th>
    </tr>
    <?php foreach ($books as $b): ?>
    <tr>
         <td><?= htmlspecialchars($b['id']) ?></td>
        <td><?= htmlspecialchars($b['first_name']) ?></td>
        <td><?= htmlspecialchars($b['last_name']) ?></td>
        <td><?= htmlspecialchars($b['age']) ?></td>
        <td><?= htmlspecialchars($b['books']) ?></td>

        
    </tr>
    <?php endforeach; ?>


    
</table>




</body>
</html>