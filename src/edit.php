<?php
session_start();
include 'db.php';

$conn = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = $_POST['id'];
        $rasnaam = $_POST['rasnaam'];
        $soort = $_POST['soort'];
        $aantal = $_POST['aantal'];
        $tijdvak = $_POST['tijdvak'];
        $tijdcheck = $_POST['tijdcheck'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
    
        $stmt = $conn->prepare("UPDATE boom SET `rasnaam` = :rasnaam, `soort` = :soort, `aantal` = :aantal, `tijdvak` = :tijdvak, `tijdcheck` = :tijdcheck, `latitude` = :latitude, `longitude` = :longitude WHERE id = :id");
        $stmt->bindParam(":rasnaam", $rasnaam);
        $stmt->bindParam(":soort", $soort);
        $stmt->bindParam(":aantal", $aantal);
        $stmt->bindParam(":tijdvak", $tijdvak);
        $stmt->bindParam(":tijdcheck", $tijdcheck);
        $stmt->bindParam(":latitude", $latitude);
        $stmt->bindParam(":longitude", $longitude);
        $stmt->bindParam(":id", $_GET['id']);
        $stmt->execute();
        $msg = 'Succes!';
        header("Location: map.php");
    }
    $stmt = $conn->prepare('SELECT * FROM boom WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $boom = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$boom) {
        exit('bestaat niet!');
    }
} else {
    exit('Geen boom te vinden');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

<div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm">
<form action="edit.php?id=<?=$boom['id']?>" method="post">
    <div class="form-group mb-6">
    <input type="text" class="form-control bloc kw-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="rasnaam" placeholder="John Doe" value="<?=$boom['rasnaam']?>" id="naam"><label for="name"> Rasnaam</label>
    <input type="text" class="form-control bloc kw-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="soort" placeholder="John Doe" value="<?=$boom['soort']?>" id="soort"><label for="soort"> Soort</label>
    <input type="text" class="form-control bloc kw-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="aantal" placeholder="John Doe" value="<?=$boom['aantal']?>" id="aantal"><label for="aantal"> Aantal</label>
    <input type="text" class="form-control bloc kw-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="tijdvak" placeholder="John Doe" value="<?=$boom['tijdvak']?>" id="tijdvak"><label for="tijdvak"> tijdvak</label>
    <input type="number" class="form-control bloc kw-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="tijdcheck" step="any" placeholder="John Doe" value="<?=$boom['tijdcheck']?>" id="tijdcheck"><label for="tijdcheck"> tijdcheck</label>
    <input type="number" class="form-control bloc kw-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="latitude" step="any" placeholder="John Doe" value="<?=$boom['latitude']?>" id="latitude"><label for="latitude"> latitude</label>
    <input type="number" class="form-control bloc kw-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="longitude" step="any" placeholder="John Doe" value="<?=$boom['longitude']?>" id="longitude"><label for="longitude"> longitude</label>
    </div>
    <input type="submit" value="Update" class="w-full px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"></button>
  <form>
</div>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

      </body>
      </html>