<?php
session_start();
if (!isset($_SESSION["logueado"]) || !$_SESSION["logueado"]) {
    header("Location: index.php");
    exit;
}

$langSelected = $_GET['lang'] ?? ($_SESSION['lang'] ?? 'es');
$_SESSION['lang'] = $langSelected;
$lang = include __DIR__ . "/lang/{$langSelected}.php";
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($langSelected) ?>">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($lang['team_title']) ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include "components/header.php"; ?>

<main class="main-content">
    <h1><?= htmlspecialchars($lang['welcome']) ?></h1>

    <section class="team">
        <h2><?= htmlspecialchars($lang['team_title']) ?></h2>

        <div class="team-grid">
            <div class="card">
                <img src="https://via.placeholder.com/150" alt="Miembro">
                <h3>Ana</h3>
                <p>Diseño</p>
            </div>

            <div class="card">
                <img src="https://via.placeholder.com/150" alt="Miembro">
                <h3>David</h3>
                <p>Back-end</p>
            </div>

            <div class="card">
                <img src="https://via.placeholder.com/150" alt="Miembro">
                <h3>Marcos</h3>
                <p>Front-end</p>
            </div>
        </div>
    </section>

    <section style="margin-top:30px; text-align:center;">
        <a class="btn" href="quiz.php"><?= htmlspecialchars($lang['quiz']) ?></a>
    </section>
</main>

<?php include "components/footer.php"; ?>
</body>
</html>
