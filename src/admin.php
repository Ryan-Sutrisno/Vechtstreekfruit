<?php
session_start();
include('db.php');
if (!isset($_SESSION['id'])) {
      header("Location: login.php");
}
$conn = pdo_connect_mysql();

$prepare = $conn->prepare("SELECT * FROM boom");
$prepare->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../dist/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
<nav>
  <div class="w-full py-3 shadow-xl flex items-center justify-between px-10">
            <div class="flex gap-1 items-center">
               <img class='h-20 w-20' src="../src/images/logo.png" alt="">
               <h1 class="text-3xl font-semibold">Vechtstreek Fruit</h1>
            </div>

                <ul
                    class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white light:bg-gray-800 md:light:bg-gray-900 light:border-gray-700">
                    <li>
                        <a href="index.php"
                            class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-red-700 md:p-0 md:light:hover:text-white light:text-gray-400 light:hover:bg-gray-700 light:hover:text-white md:light:hover:bg-transparent light:border-gray-700">Home</a>
                    </li>

                    <li>
                        <a href="map.php"
                            class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-red-700 md:p-0 md:light:hover:text-white light:text-gray-400 light:hover:bg-gray-700 light:hover:text-white md:light:hover:bg-transparent light:border-gray-700">Map</a>
                    </li>

                    <li>
                        <a href="admin.php"
                            class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-red-700 md:p-0 md:light:hover:text-white light:text-gray-400 light:hover:bg-gray-700 light:hover:text-white md:light:hover:bg-transparent light:border-gray-700">Admin</a>
                    </li>

            <div>
               <a class='text-red-500 rounded-full  py-2 pr-4 pl-3 hover:bg-red-500 hover:text-white transition-all duration-300 ease-in' href="./logout.php">Log out</a>
            </div>
  </div>
  </nav>
<div class="w-full mx-auto">
  <div class="bg-white shadow-md rounded my-6">
    <table class="text-left w-full">
      <thead>
        <tr>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Rasnaam</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">soort</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">aantal</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">tijdvak</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">tijdcheck</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">lat</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">long</th> 
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Acties</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($prepare as $data) { ?>
          <tr class="hover:bg-grey-lighter">
            <td class="py-4 px-6 border-b border-grey-light"><?= $data['rasnaam'] ?></td>
            <td class="py-4 px-6 border-b border-grey-light"><?= $data['soort'] ?></td>
            <td class="py-4 px-6 border-b border-grey-light"><?= $data['aantal'] ?></td>
            <td class="py-4 px-6 border-b border-grey-light"><?= $data['tijdvak'] ?></td>
            <td class="py-4 px-6 border-b border-grey-light"><?= $data['tijdcheck'] ?></td>
            <td class="py-4 px-6 border-b border-grey-light"><?= $data['latitude'] ?></td>
            <td class="py-4 px-6 border-b border-grey-light"><?= $data['longitude'] ?></td>
            <td class="py-4 px-6 border-b border-grey-light"><a href="edit.php?id=<?= $data['id'] ?>" class="text-blue-500 hover:text-green-700">Edit</a> <br> <a href="delete.php?id=<?= $data['id'] ?>" class="text-blue-500 hover:text-red-700">Delete</a></td>
          </tr>
        <?php } ?>

      </tbody>
    </table>
  </div>
</div>
<script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
</body>
</html>
