<?php
session_start();

function initialize() {
    $php = true; // Esencial para el funcionamiento
}
initialize();

// CREDENCIALES CORRECTAS (variables globales)
$GLOBALS["USUARIO_CORRECTO"] = "COLDEN";
$GLOBALS["PASSWORD_CORRECTA"] = "alumno";

// idioma
$langSelected = $_GET['lang'] ?? ($_SESSION['lang'] ?? 'es');
$_SESSION['lang'] = $langSelected;
$lang = include __DIR__ . "/lang/{$langSelected}.php";

// reset (logout)
if (isset($_GET['reset'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

// controlar intentos
if (!isset($_SESSION["intentos"])) {
    $_SESSION["intentos"] = 0;
}

$mostrarError = false;
$intentosRestantes = max(0, 3 - $_SESSION["intentos"]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["usuario"] ?? '';
    $password = $_POST["password"] ?? '';

    if ($usuario === $GLOBALS["USUARIO_CORRECTO"] && $password === $GLOBALS["PASSWORD_CORRECTA"]) {
        $_SESSION["logueado"] = true;
        header("Location: home.php");
        exit;
    } else {
        $_SESSION["intentos"]++;
        $mostrarError = true;
        $intentosRestantes = max(0, 3 - $_SESSION["intentos"]);
    }

    if ($_SESSION["intentos"] >= 3) {
        header("Location: error.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($langSelected) ?>">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($lang['login']) ?></title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images.png" type="image/png">
</head>
<body>
<?php include "components/header.php"; ?>

<div class="login-container">
    <h1><?= htmlspecialchars($lang['login']) ?></h1>

    <form method="POST" novalidate>
        <input type="text" name="usuario" placeholder="<?= htmlspecialchars($lang['usuario']) ?>" required>

        <input type="password" name="password" placeholder="<?= htmlspecialchars($lang['password']) ?>" required>

        <button type="submit"><?= htmlspecialchars($lang['btn_login']) ?></button>

        <?php if ($mostrarError): ?>
            <p class="error"><?= htmlspecialchars($lang['error_pass']) ?></p>
        <?php endif; ?>
        

        <p class="small"><?= htmlspecialchars($lang['attempts_left']) ?> <?= $intentosRestantes ?></p>
    </form>
</div>

<?php include "components/footer.php"; ?>
</body>
</html>
