<!-- BACK-END -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
try {
    $conectie = new PDO("mysql:host=$servername;dbname=vechtstreekfruit", $username, $password);

    $conectie->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
//  als 
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password1 = $_POST["password1"];
    $vollenaam = $_POST["vollenaam"];

        $sql = "INSERT INTO  `gebruikers_accounts` (email, PASSWORD, vollenaam)
        VALUES (:email, :password1, :vollenaam)";

        $stmt = $conectie->prepare($sql);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password1', $password1);
        $stmt->bindParam(':vollenaam', $vollenaam);

        $stmt->execute();
        echo "Uw wachtwoord is correct!";
        header("Location: login.php");
}
?>
<!-- FRONT-END -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registratie </title>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css"> -->
  <link rel="stylesheet" href="../dist/output.css">
</head>
<body>
  <section class="flex flex-col md:flex-row h-screen items-center">

    <div class="bg-green-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
      <img src="./images/boom.jpeg" alt="" class="w-full h-full object-cover">
    </div>

    <div class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
          flex items-center justify-center">

      <div class="w-full h-100">

        <h1 class="text-xl font-bold">Vechtstreek Fruit</h1>
        <h1 class="text-xl md:text-2xl font-bold leading-tight mt-12">Create an Account</h1>

        <form class="mt-6" action="#" method="POST">
          <div>
            <label class="block text-gray-700">Full Name</label>
            <input type="text" name="vollenaam" id="" placeholder="Enter Full Name" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required>
          </div>

          <div class="mt-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" id="" placeholder="Enter Email" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required>
          </div>

          <div class="mt-4">
            <label class="block text-gray-700">Password</label>
            <input type="password" name="password1" id="" placeholder="Enter Password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                  focus:bg-white focus:outline-none" required>
          </div>

          <!-- <div class="text-right mt-2">
            <a href="forget.php" class="text-sm font-semibold text-gray-700 hover:text-blue-700 focus:text-blue-700">Forgot Password?</a>
          </div> -->

          <button type="submit" name="submit" class="w-full block bg-green-700 hover:bg-green-700 focus:bg-green-400 text-white font-semibold rounded-lg
                px-4 py-3 mt-6">Create an Account</button>
        </form>

        <hr class="my-6 border-gray-300 w-full">
<!-- 
        <button type="button" class="w-full block bg-white hover:bg-gray-100 focus:bg-gray-100 text-gray-900 font-semibold rounded-lg px-4 py-3 border border-gray-300">
          <div class="flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-6 h-6" viewBox="0 0 48 48"><defs><path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/></defs><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/><path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/><path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/><path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/></svg>
              <span class="ml-4">
              Sign
              Up
              With
              Google
              </span>
          </div>
        </button> -->

        <p class="mt-8">
          Already have an Account?
          <a href="login.php" class="text-green-700 hover:text-green-500 font-semibold">
            Login
          </a>
        </p>

        <p class="text-sm text-gray-500 mt-12">&copy; .</p>
      </div>

    </div>

  </section>

  <!-- <script>
		function show() {
			var x = document.getElementById("password1");                       <--- zichtbaarheid voor password als nodig.
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		} -->
	</script>
</body>
</html>
