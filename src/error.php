<?php
session_start();
$langSelected = $_GET['lang'] ?? ($_SESSION['lang'] ?? 'es');
$lang = include __DIR__ . "/lang/{$langSelected}.php";
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($langSelected) ?>">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include "components/header.php"; ?>

<div class="error-container">
    <h1><?= htmlspecialchars($lang['exceeded']) ?></h1>
    <a class="back" href="index.php?reset=true"><?= htmlspecialchars($lang['reset']) ?></a>
</div>

<?php include "components/footer.php"; ?>
</body>
</html>
