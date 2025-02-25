<?php
session_start();
require_once "pdo.php";

if (!isset($_SESSION['name'])) {
    die("ACCESS DENIED: Not logged in");
}

// Fetch automobile records
$stmt = $pdo->query("SELECT * FROM autos");
$autos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle Flash Messages
$success = $_SESSION['success'] ?? false;
unset($_SESSION['success']);
$error = $_SESSION['error'] ?? false;
unset($_SESSION['error']);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Automobile Database</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
    <div class="min-h-screen flex flex-col items-center content-center p-4">
        <h1 class="text-lg my-2 self-start">Welcome, <?= htmlentities($_SESSION['name']) ?>!</h1>

        <?php if ($success) echo "<p style='color:green;'>" . htmlentities($success) ."</p>"; ?>
        <?php if ($error) echo "<p style='color:red;'>" . htmlentities($error) ."</p>"; ?>
        <div class="mx-auto flex max-w-sm items-center gap-x-4 bg-white p-6 justify-center">
            <h2>Automobiles</h2>
        </div>
        <table class="border-collapse border border-gray-400">
            <thead>
                <tr>
                  <th class="border border-gray-300 p-2">Make</th>
                  <th class="border border-gray-300 p-2">Model</th>
                  <th class="border border-gray-300 p-2">Year</th>
                  <th class="border border-gray-300 p-2">Mileage</th>
                  <th class="border border-gray-300 p-2">Action</th>
                </tr>
            <thead>
            <?php foreach ($autos as $auto): ?>
            <tr>
                <td class="border border-gray-300 p-2"><?= htmlentities($auto['make']) ?></td>
                <td class="border border-gray-300 p-2"><?= htmlentities($auto['model']) ?></td>
                <td class="border border-gray-300 p-2"><?= htmlentities($auto['year']) ?></td>
                <td class="border border-gray-300 p-2"><?= htmlentities($auto['mileage']) ?> miles</td>
                <td>
                    <form action="POST">
                        <a class="border border-gray-300 p-2" href="edit.php?auto_id=<?= htmlentities($auto['auto_id']) ?>">Edit</a>
                        <a class="border border-gray-300 p-2" href="delete.php?auto_id=<?= htmlentities($auto['auto_id']) ?>">Delete</a>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <div class="flex w-max items-center gap-x-10 justify-center content-center my-10">
            <a class="rounded-md bg-green-800 py-1 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-green-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" href="add.php">Add New Entry</a></a>
            <a class="rounded-md bg-gray-200 border border-transparent py-1 px-4 text-center text-sm transition-all text-slate-600 hover:bg-gray-300 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" href="logout.php">Logout</a>
        </div>
    </div>
    <footer class="flex justify-center py-2">
        <a class=" mt-2 text-xs text-gray-700" href="about.html">About This Project</a>
    </footer>
</body>
</html>
