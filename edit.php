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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['make']) || empty($_POST['model']) || empty($_POST['year']) || empty($_POST['mileage'])) {
        $_SESSION['error'] = "All fields are required";
        header("Location: edit.php?autos_id=" . $_GET['auto_id']);
        return;
    }

    if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
        $_SESSION['error'] = "Year and mileage must be numeric";
        header("Location: edit.php?autos_id=" . $_GET['auto_id']);
        return;
    }

    // Update database with new values
    $stmt = $pdo->prepare("UPDATE autos SET make = :mk, model = :md, `year` = :yr, mileage = :mi WHERE auto_id = :id");
    $stmt->execute([
        ':mk' => $_POST['make'],
        ':md' => $_POST['model'],
        ':yr' => $_POST['year'],
        ':mi' => $_POST['mileage'],
        ':id' => $_GET['auto_id']
    ]);

    $_SESSION['success'] = "Record edited";
    header("Location: view.php");
    return;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Entry - <?php echo htmlentities($_SESSION['name']); ?></title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
    <div class="min-h-screen flex flex-col place-content-center items-center p-4">
        <div class="mx-auto flex flex-col max-w-sm items-center gap-x-4 bg-white p-6 place-content-center">
            <h1>Edit Automobile</h1>
        </div>
        <?php
        // Display flash messages
        if (isset($_SESSION['error'])) {
            echo '<p style="color: red;">' . htmlentities($_SESSION['error']) . '</p>';
            unset($_SESSION['error']);
        }
        ?>
        <div class="mx-auto flex max-w-sm items-center gap-y-2 rounded-xl bg-white p-6 shadow-lg outline outline-black/5 dark:bg-slate-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
            <form method="POST">
                <div class="w-full max-w-sm min-w-[200px] my-3">
                    <label class="mb-2 text-sm text-slate-600" for="make">Make:</label>
                    <input class="bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" value="<?php echo htmlentities($row['make']); ?>" type="text" name="make" id="make"><br/>
                </div>
                <div class="w-full max-w-sm min-w-[200px] my-3">
                    <label class="mb-2 text-sm text-slate-600" for="model">Model:</label>
                    <input class="bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" value="<?php echo htmlentities($row['model']); ?>" type="text" name="model" id="model"><br/>
                </div>
                <div class="w-full max-w-sm min-w-[200px] my-3">
                    <label class="mb-2 text-sm text-slate-600" for="year">Year:</label>
                    <input class="bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" value="<?php echo htmlentities($row['year']); ?>" type="text" name="year" id="year"><br/>
                </div>
                <label class="mb-2 text-sm text-slate-600" for="mileage">Mileage:</label>
                <input class="bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" value="<?php echo htmlentities($row['mileage']); ?>" type="text" name="mileage" id="mileage"><br/>
                <div class="flex w-max items-center gap-x-10 justify-center content-center my-10">
                    <input class="rounded-md bg-green-800 py-1 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-green-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit" value="Save">
                    <a class="rounded-md bg-gray-200 border border-transparent py-1 px-4 text-center text-sm transition-all text-slate-600 hover:bg-gray-300 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" href="view.php">Cancel</a>
                 </div>
            </form>
        </div>
    </div>
</body>
</html>
