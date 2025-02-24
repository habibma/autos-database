<?php
session_start();
require_once "pdo.php";

if (isset($_POST['email']) && isset($_POST['pass'])) {
    unset($_SESSION['name']);

    if (strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1) {
        $_SESSION['error'] = "Email and password are required";
        header("Locaton: login.php");
        return;
    } elseif (!strpos($_POST['email'], '@')) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: login.php");
        return;
    }

    $salt = 'XyZzy12*_';
    $check = hash('md5', $salt . $_POST['pass']);
    $stmt = $pdo->prepare("SELECT name FROM users WHERE email= :email AND password = :pass");
    $stmt->execute([':email' => $_POST['email'], ':pass' => $check]);
    $row = $stmt->fetch((PDO::FETCH_ASSOC));
    if ($row) {
        $_SESSION['name'] = $row['name'];
        header("Location: view.php");
        return;
    } else {
        $_SESSION['error'] = "Incorrect password";
        header("Location: login.php");
        return;
    }
}

$error = $_SESSION['error'] ?? false;
unset($_SESSION['error']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Habib Mote - Login</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body class="flex flex-col">
    <div class="h-screen md:flex items-center content-center">
        <div class="mx-auto flex flex-col max-w-sm items-center gap-x-4 bg-white p-6 justify-center">
            <h1 class="text-lg">Please Log In</h1>
            <p class="text-sm text-gray-700">Enter credentials (user@example.com / php123)</p>
            <?php
            if ($error) {
                echo '<p class="mx-auto flex max-w-sm items-center gap-x-4 bg-white p-6 justify-center" style="color: red;">' . htmlentities($error) . "</p>\n";
            }
            ?>
        </div>
        <div class="mx-auto flex max-w-sm items-center gap-y-2 rounded-xl bg-white p-6 shadow-lg outline outline-black/5 dark:bg-slate-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
            <form method="POST">
                <div class="w-full max-w-sm min-w-[200px] my-3">
                    <label class="block mb-2 text-sm text-slate-600" for="email">Email:</label>
                    <input class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." type="text" name="email" id="email"><br/>
                </div>
                <div class="w-full max-w-sm min-w-[200px] my-3">
                    <label class="block mb-2 text-sm text-slate-600" for="pass">Password:</label>
                    <input class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." class="outline-solid outline-black m-2" type="password" name="pass" id="pass"><br/>
                    <p class="flex items-start mt-2 text-xs text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" class="w-5 h-5 mr-1.5">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                        </svg>
                    Use the credentials provided in the left section.
                    </p>
                </div>
                <div class="flex w-max items-center gap-x-10 justify-center content-center my-10">
                    <button class="rounded-md bg-green-800 py-1 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-green-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit">Log In</button>
                    <a class="rounded-md bg-gray-200 border border-transparent py-1 px-4 text-center text-sm transition-all text-slate-600 hover:bg-gray-300 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" href="index.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <footer class="flex items-center justify-center py-2 justify-self-end">
        <a class=" mt-2 text-xs text-gray-700" href="about.html">About This Project</a>
    </footer>
</body>
</html>
