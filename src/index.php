<?php session_start();

if (!isset($_SESSION['id'])) {
      header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vechtstreek Fruit</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css"> -->
    <link rel="stylesheet" href="../dist/output.css">
    <link rel="stylesheet" href="../dist/leaflet.css">
    <link href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" rel="stylesheet">
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
            <div>
               <a class='text-red-500 rounded-full  py-2 pr-4 pl-3 hover:bg-red-500 hover:text-white transition-all duration-300 ease-in' href="./logout.php">Log out</a>
            </div>
  </div>
  </nav>

      <main class='container mx-auto flex flex-col xl:flex-row justify-between gap-10 my-10'>
         <div class='border-8 border-black rounded-xl w-full xl:w-2/3'>
            <a href="./map.php">
               <img class='w-full' src="../src/images/map.png" alt="">
            </a>
          </div>
      </main>
      <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
</body>
</html>
