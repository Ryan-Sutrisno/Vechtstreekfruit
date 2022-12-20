<?php
session_start();
include('db.php');
if (!isset($_SESSION['id'])) {
      header("Location: login.php");
}
$conn = pdo_connect_mysql();


//voegt informatie toe naar de database
if(isset($_POST['insert'])){
    $rasnaam = $_POST['rasnaam'];
    $soort = $_POST['soort'];
    $aantal = $_POST['aantal'];
    $tijdvak = $_POST['tijdvak'];
    $tijdcheck = $_POST['tijdcheck'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    if (empty($rasnaam) || empty($soort) || empty($aantal) || empty($tijdvak) || empty($tijdcheck) || empty($latitude) || empty($longitude)) {
        echo 'U forgot to fill something in';
     } else{
        $insert = $conn->prepare("INSERT INTO `boom` (`rasnaam`, `soort`, `aantal`, `tijdvak`, `tijdcheck`, `latitude`, `longitude`) VALUES (?, ?, ?, ?, ?, ?, ?)"); 
        $insert->execute([$rasnaam, $soort, $aantal, $tijdvak, $tijdcheck, $latitude, $longitude]); echo 'Information inserted'; 
        header("Location: map.php"); } 
    
    }

        //het presenteren van de informatie in de database
        $prepare = $conn->prepare("SELECT * FROM boom ORDER BY id");
        $prepare->execute([]);
?>
<!DOCTYPE html>
<html>

<head>
  <title>Leaflet Quick Start Example</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../dist/output.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
  <link href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.78.0/dist/L.Control.Locate.min.css" rel="stylesheet">
  <link href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" rel="stylesheet">
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
  <script charset="utf-8" src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.78.0/dist/L.Control.Locate.min.js"></script>
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
  <div id="map" class="z-0" style="width: 100%; height: 600px"></div>
  
  <div aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full"
    id="authentication-modal" tabindex="-1">
    <div class="relative w-full max-w-md h-full md:h-auto">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button
          class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
          id="close" type="button">
          <svg aria-hidden="true" class="w-5 h-5" viewbox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              fill-rule="evenodd"></path>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="py-6 px-6 lg:px-8">
          <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">
            Voeg een boom toe</h3>
          <form action="" class="space-y-6" id="form" method="post" name="form">
            <div class="inputBox">
              <label
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                for="rasnaam">rasnaam:</label>
              <input class="box" name="rasnaam" placeholder="Enter your rasnaam"
                required="" type="text">
            </div>
            <label
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              for="soort">Soort:</label>
            <div class="inputBox">
              <input class="box" name="soort" placeholder="Enter your soort"
                required="" type="text">
            </div>
            <label
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              for="aantal">aantal:</label>
            <div class="inputBox">
              <input class="box" name="aantal" placeholder="Enter your aantal"
                required="" type="number">
            </div>
            <label
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              for="tijdvak">tijdvak:</label>
            <div class="inputBox">
              <input class="box" name="tijdvak" placeholder="Enter your tijdvak"
                required="" type="text">
            </div>
            <label
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              for="tijdcheck">tijdcheck:</label>
            <div class="inputBox">
              <input class="box" name="tijdcheck"
                placeholder="Enter your tijdcheck" required="" type="text">
            </div>
            <label
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              for="latitude">latitude:</label>
            <div class="inputBox">
              <input class="box" id="latitude" name="latitude" required=""
                step="any" type="number">
            </div>
            <label
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              for="longitude">longitude:</label>
            <div class="inputBox">
              <input class="box" id="longitude" name="longitude" required=""
                step="any" type="number">
            </div>
            <div class="flex justify-between">
              <div class="flex items-start">
                <button
                  class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  name="insert" type="submit" value="Insert">Insert
                  information</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
</body>

</html>

<script>
          // De kaart initialiseren en toevoegen
          var map = L.map('map').setView([52.25459030239216, 5.040947601205085], 17.5);

L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        noWrap: true,
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
}).addTo(map);
// De icon van de marker
var myIcon = L.icon({
        iconUrl: './images/tree.svg',
        iconSize: [30, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
})

function checkDelete() {
        return confirm('Are you sure?');
}

// nieuwe marker toevoegen aan de kaart en popup toevoegen met de informatie van de boom in de database
var database = <?php echo json_encode($prepare->fetchAll(PDO::FETCH_ASSOC)); ?>;
       for (var i = 0; i < database.length; i++) {
           var a = database[i];
           let rasnaam = a.rasnaam;
              let soort = a.soort;
                let aantal = a.aantal;
                let tijdvak = a.tijdvak;
                let tijdcheck = a.tijdcheck;
                let latitude = a.latitude;
                let longitude = a.longitude;
           var marker = L.marker([a['latitude'], a['longitude']], {icon: myIcon}).addTo(map);
           marker.bindPopup(
               '<b>rasnaam:</b> ' + rasnaam + '<br>' + 
                '<b>soort:</b> ' + soort + '<br>' +
                '<b>aantal:</b> ' + aantal + '<br>' +
                '<b>tijdvak:</b> ' + tijdvak + '<br>' +
                '<b>tijdcheck:</b> ' + tijdcheck + '<br>' +
                '<b>latitude:</b> ' + latitude + '<br>' +
                '<b>longitude:</b> ' + longitude + '<br>' +
                '<a href="edit.php?id=' + a['id'] + '">Edit</a> | <a href="delete.php?id=' + a['id'] + '" onclick="return checkDelete()">Delete</a>'
           );
        }
        // Een nieuwe marker toevoegen aan de kaart
        map.addEventListener('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
                modal = document.getElementById('authentication-modal');
                modal.classList.add('active');
                modal.classList.remove('hidden');
        });

        if (document.getElementById('close')) {
                document.getElementById('close').addEventListener('click', function() {
                        modal = document.getElementById('authentication-modal');
                        modal.classList.remove('active');
                        modal.classList.add('hidden');
                });
        }
        // De locatie van de gebruiker ophalen
        L.control.locate().addTo(map);

  </script>
