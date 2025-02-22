<?php
require_once "pdo.php";
session_start();

if (!isset($_SESSION['name'])) {
    echo '</br>';
    echo '<a class=" mt-2 text-xs text-gray-700" href="login.php">Go to the Login Page</a>';
    echo '</br>';
    echo '</br>';
    die("NO Access to this Page!");
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    return;
}

if (isset($_POST['add'])) {
    if (strlen($_POST['make']) < 1) {
        $_SESSION['error'] = "Make is required";
    } elseif (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
        $_SESSION['error'] = "Mileage and year must be numeric";
    } else {
        $stmt = $pdo->prepare("INSERT INTO autos (make, year, mileage) VALUES (:mk, :yr, :mi)");
        $stmt->execute([
            ':mk' => $_POST['make'],
            ':yr' => $_POST['year'],
            ':mi' => $_POST['mileage']
        ]);
        $_SESSION['success'] = "Record inserted";
    }
    header("Location: autos.php");
    return;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Habib Mote - Autos Database</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
    <div class="min-h-screen md:flex items-center content-center">
        <section class="mx-auto flex flex-col items-center content-center">
            <div class="mx-auto flex max-w-sm items-center gap-x-4 bg-white p-6 justify-center">
                <h1>Tracking Autos for <?= htmlentities($_SESSION['name']) ?></h1>
            </div>
            <?php
            if (isset($_SESSION['error'])) {
                echo '<p class="mx-auto flex max-w-sm items-center gap-x-4 bg-white p-6 justify-center" style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n";
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo '<p class="mx-auto flex max-w-sm items-center gap-x-4 bg-white p-6 justify-center" style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n";
                unset($_SESSION['success']);
            }
            ?>
            <div class="mx-auto flex max-w-sm items-center gap-y-2 rounded-xl bg-white p-6 shadow-lg outline outline-black/5 dark:bg-slate-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                <form method="POST">
                    <div class="w-full max-w-sm min-w-[200px] my-3">
                        <label class="mb-2 text-sm text-slate-600" for="make">Make:</label>
                        <input class="bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." class="outline-solid outline-black m-2" type="text" name="make" id="make"><br/>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px] my-3">
                        <label class="mb-2 text-sm text-slate-600" for="year">Year:</label>
                        <input class="bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." class="outline-solid outline-black m-2" type="text" name="year" id="year"><br/>
                    </div>
                    <label class="mb-2 text-sm text-slate-600" for="mileage">Mileage:</label>
                    <input class="bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Type here..." class="outline-solid outline-black m-2" type="text" name="mileage" id="mileage"><br/>
                    <div class="flex w-max items-center gap-x-10 justify-center content-center my-10">
                        <input class="rounded-md bg-green-800 py-1 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-green-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit" value="Add" name="add">
                        <input class="rounded-md bg-gray-200 border border-transparent py-1 px-4 text-center text-sm transition-all text-slate-600 hover:bg-gray-300 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit" name="logout" value="Logout">
                    </div>
                </form>
            </div>
        </section>
        <section class="mx-auto flex flex-col items-center content-center p-2">
            <div class="mx-auto flex max-w-sm items-center gap-x-4 bg-white p-6 justify-center">
                <h2>Automobiles</h2>
            </div>
            <table class="border-collapse border border-gray-400">
            <thead>
                <tr>
                  <th class="border border-gray-300 p-2">Make</th>
                  <th class="border border-gray-300 p-2">Year</th>
                  <th class="border border-gray-300 p-2">Mileage</th>
                </tr>
                <?php
                    $stmt = $pdo->query("SELECT make, year, mileage FROM autos");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo '<td class="border border-gray-300 p-2">' . htmlentities($row['make']) . "</td>";
                        echo '<td class="border border-gray-300 p-2">' . htmlentities($row['year']) . "</td>";
                        echo '<td class="border border-gray-300 p-2">'. htmlentities($row['mileage']) . "</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </section>
    </div>
    <footer class="flex items-center justify-center py-2">
        <a class=" mt-2 text-xs text-gray-700" href="about.html">About This Project</a>
    </footer>
</body>
</html>
