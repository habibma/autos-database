<?php
session_start();
require_once "pdo.php";

if (!isset($_SESSION['name'])) {
    die("ACCESS DENIED: Not logged in");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['make']) || empty($_POST['year']) || empty($_POST['mileage'])) {
        $_SESSION['error'] = "All fields are required";
        header("Location: add.php");
        return;
    }

    if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
        $_SESSION['error'] = "Year and mileage must be numeric";
        header("Location: add.php");
        return;
    }

    $stmt = $pdo->prepare("INSERT INTO autos (make, model, `year`, mileage) VALUES (:mk, :md, :yr, :mi)");
    $stmt->execute([
        ':mk' => $_POST['make'],
        ':md' => $_POST['model'],
        ':yr' => $_POST['year'],
        ':mi' => $_POST['mileage']
    ]);

    $_SESSION['success'] = "Record inserted";
    header("Location: view.php");
    return;
}

// Display error messages
$error = $_SESSION['error'] ?? false;
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Automobile</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
    <div class="min-h-screen flex flex-col place-content-center p-4">
        <div class="mx-auto flex flex-col max-w-sm items-center gap-x-4 bg-white p-6 place-content-center">
            <h1>Add a New Automobile</h1>
        </div>
        <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>

        <div class="mx-auto flex max-w-sm items-center gap-y-2 rounded-xl bg-white p-6 shadow-lg outline outline-black/5 dark:bg-slate-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
            <form method="POST">
                <div class="w-full max-w-sm min-w-[200px] my-3">
                    <label class="mb-2 text-sm text-slate-600" for="make">Make:</label>
                    <input class="bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." type="text" name="make" id="make"><br/>
                </div>
                <div class="w-full max-w-sm min-w-[200px] my-3">
                    <label class="mb-2 text-sm text-slate-600" for="model">Model:</label>
                    <input class="bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." type="text" name="model" id="model"><br/>
                </div>
                <div class="w-full max-w-sm min-w-[200px] my-3">
                    <label class="mb-2 text-sm text-slate-600" for="year">Year:</label>
                    <input class="bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." type="text" name="year" id="year"><br/>
                </div>
                <label class="mb-2 text-sm text-slate-600" for="mileage">Mileage:</label>
                <input class="bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." type="text" name="mileage" id="mileage"><br/>
                <div class="flex w-max items-center gap-x-10 justify-center content-center my-10">
                    <input class="rounded-md bg-green-800 py-1 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-green-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit" value="Add" name="add">
                    <a class="rounded-md bg-gray-200 border border-transparent py-1 px-4 text-center text-sm transition-all text-slate-600 hover:bg-gray-300 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" href="view.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <footer class="flex justify-center py-2">
        <a class=" mt-2 text-xs text-gray-700" href="about.html">About This Project</a>
    </footer>
</body>
</html>
