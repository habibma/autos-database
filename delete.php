<?php
session_start();
require_once "pdo.php";

// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    die("ACCESS DENIED");
}

// Ensure that an autos_id is provided in the GET request
if (!isset($_GET['auto_id']) || !is_numeric($_GET['auto_id'])) {
    $_SESSION['error'] = "Missing or invalid auto_id";
    header("Location: view.php");
    return;
}

// Fetch existing record
$stmt = $pdo->prepare("SELECT * FROM autos WHERE auto_id = :id");
$stmt->execute([':id' => $_GET['auto_id']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    $_SESSION['error'] = "Invalid automobile ID";
    header("Location: view.php");
    return;
}

// Handle form submission (Delete Confirmation)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("DELETE FROM autos WHERE auto_id = :id");
    $stmt->execute([':id' => $_GET['auto_id']]);

    $_SESSION['success'] = "Record deleted";
    header("Location: view.php");
    return;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Entry - <?php echo htmlentities($_SESSION['name']); ?></title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
    <div class="min-h-screen flex flex-col items-center content-center p-4">

        <h1 class="text-lg my-2">Confirm Deletion</h1>
        <p>Are you sure you want to delete <strong><?php echo htmlentities($row['make'] . " " . $row['model']); ?></strong>?</p>
        <form method="POST" class="my-10">
            <button class="rounded-md bg-gray-200 border border-transparent py-1 px-4 text-center text-sm transition-all text-slate-600 hover:bg-gray-300 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit">Delete</button>
            <a class="rounded-md bg-gray-200 border border-transparent py-1 px-4 text-center text-sm transition-all text-slate-600 hover:bg-gray-300 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" href="index.php">Cancel</a>
        </form>
</body>
</html>