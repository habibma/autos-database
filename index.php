<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Habib Mote - Autos Database</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
    <div class="h-screen flex flex-col justify-center items-center content-center">
        <h1 class="text-lg my-2">Welcome the Automobile Database</h1>
        <p class="my-2">Please <a class="text-red-500" href="login.php">Log In</a></p>
        <p>Attempt to go to <a class="text-red-500" href="autos.php">autos.php</a> without logging in - it should fail.</p>
    </div>
    <footer class="flex items-center justify-center py-2">
        <a class=" mt-2 text-xs text-gray-700" href="about.html">About This Project</a>
    </footer>
</body>
</html>
