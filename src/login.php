<!-- BACK-END -->
<?php
session_start();
// require_once "userController.php";
$servername = "localhost";
$username = "root";
$password = "";
try {
    $conectie = new PDO("mysql:host=$servername;dbname=vechtstreekfruit", $username, $password);

    $conectie->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
};
$erorrMessage = "";
if (isset($_POST["submit"])) {
    $email2 = $_POST["email2"];
    $password2 = $_POST["password1"];

    $sqlResult = $conectie->query("SELECT * FROM gebruikers_accounts WHERE email = '$email2' AND password = '$password2'")->fetch();
    if ($sqlResult) {
        $_SESSION['id'] = $sqlResult['id'];
        header("Location: index.php "); //    <--- redirect naar front_page/index(.php)
    } else {
        $erorrMessage = "Email or password is incorrect";
        // echo "<h1 class='center'>wachtwoord/email is niet validate! </h1>";
        
        // echo '<script type="text/javascript">alert("wachtwoord/email is niet validate!")</script>';
        // header("Refresh: 0; url=login.php");

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log in </title>
  <link rel="stylesheet" href="../dist/output.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css"> -->
</head>
<body>
  <section class="flex flex-col md:flex-row h-screen items-center">

    <div class="bg-red-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
      <img src="./images/figma.jpg" alt="" class="w-full h-full object-cover">
    </div>

    <div class="bg-white w-full md:mx-auto lg:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
          flex items-center justify-center">

      <div class="w-full h-100">

        <h1 class="text-xl font-bold">Vechtstreek Fruit</h1>
        <h1 class="text-xl md:text-2xl font-bold leading-tight mt-12">Login in to your account</h1>

        <form class="mt-6" action="#" method="POST">
          <div>
            <label class="block text-gray-700">Email address</label>
            <input type="email" name="email2" id="" placeholder="Enter Email Address" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required>
          </div>

          <div class="mt-4"> 
            <label class="block text-gray-700">Password</label>
            <input type="password" name="password1" id="" placeholder="Enter Password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                  focus:bg-white focus:outline-none" required>
          </div>
<?php
if ($erorrMessage) {
    echo "<h1 class='center' style='color: red; margin-top: 10px;'>wachtwoord/email is niet validate! </h1>";       
  }  
?>

          <!-- <div class="text-right mt-2">
            <a href="forget.php" class="text-sm font-semibold text-gray-700 hover:text-blue-700 focus:text-blue-700">Forgot Password?</a>
          </div> -->

          <button type="submit" name="submit" class="w-full block bg-red-700 hover:bg-red-400 focus:bg-red-400 text-white font-semibold rounded-lg
                px-4 py-3 mt-6 transition-all duration-300 ease-linear">Login</button>
        </form>

        <hr class="my-6 border-gray-300 w-full">

        <p class="mt-8">
          Need an account?
          <a href="register.php" class="text-red-700 hover:text-red-500 font-semibold">
            Create an account
          </a>
        </p>

        <p class="text-sm text-gray-500 mt-12">&copy; .</p>
      </div>

    </div>

  </section>

  <script>
		// function show() {
		// 	var x = document.getElementById("password1");                   <--- Zichtbaarheid voor password als nodig.
		// 	if (x.type === "password") {
		// 		x.type = "text";
		// 	} else {
		// 		x.type = "password";
		// 	}
		// }
	</script>
</body>
</html>
