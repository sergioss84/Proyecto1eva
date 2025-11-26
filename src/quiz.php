<?php
session_start();
if (!isset($_SESSION["logueado"]) || !$_SESSION["logueado"]) {
    header("Location: index.php");
    exit;
}

$langSelected = $_GET['lang'] ?? ($_SESSION['lang'] ?? 'es');
$lang = include __DIR__ . "/lang/{$langSelected}.php";

$showResult = false;
$score = 0;
$total = 10;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $correct = [
        "q1" => "IAPWE",
        "q2" => "Si", 
        "q3" => "PHP", 
        "q4" => "Gonzalo el mejor", 
        "q5" => "6", 
        "q6" => "Si",
        "q7" => "Programación",
        "q8" => "Gonzi Skater",
        "q9" => "Si",
        "q10" => "IAPWE"
    ];

    // comprobar q1 (texto)
    if (isset($_POST['q1']) && trim($_POST['q1']) === $correct['q1']) $score++;

    // q2 (radio)
    if (isset($_POST['q2']) && $_POST['q2'] === $correct['q2']) $score++;

    // q3 (checkbox)
    $q3 = $_POST['q3'] ?? [];
    if (is_array($q3)) {
        // puntuación si al menos una opción correcta marcada
        $common = array_intersect($q3, $correct['q3']);
        if (count($common) >= 1) $score++;
    }

    // q4 (select)
    if (isset($_POST['q4']) && $_POST['q4'] === $correct['q4']) $score++;

    // q5 (number exact)
    if (isset($_POST['q5']) && $_POST['q5'] === $correct['q5']) $score++;

    // q6 (yes/no)
    if (isset($_POST['q6']) && $_POST['q6'] === $correct['q6']) $score++;

    // q7 (text)
    if (isset($_POST['q7']) && trim($_POST['q7']) === $correct['q7']) $score++;

    // q8 (radio)
    if (isset($_POST['q8']) && $_POST['q8'] === $correct['q8']) $score++;

    // q9 (yes/no)
    if (isset($_POST['q9']) && $_POST['q9'] === $correct['q9']) $score++;

    // q10 (text)
    if (isset($_POST['q10']) && trim($_POST['q10']) === $correct['q10']) $score++;

    $showResult = true;
}
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($langSelected) ?>">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($lang['quiz']) ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include "components/header.php"; ?>

<main class="main-content">
    <h1><?= htmlspecialchars($lang['quiz']) ?></h1>

    <?php if ($showResult): ?>
        <div class="result">
            <h2><?= htmlspecialchars($lang['score']) ?>: <?= $score ?> / <?= $total ?></h2>
            <a class="btn" href="home.php">Volver</a>
        </div>
    <?php else: ?>
        <form method="POST">
            <ol class="quiz-list">
                <li>
                    <label>1. ¿Cómo se llama esta asignatura?</label><br>
                    <input type="text" name="q1" required>
                </li>

                <li>
                    <label>2. ¿Te gusta esta asignatura?</label><br>
                    <label><input type="radio" name="q2" value="option1"> Si</label>
                    <label><input type="radio" name="q2" value="option2"> No</label>
                </li>

                <li>
                    <label>3. Lenguaje de programación favorito</label><br>
                    <label><input type="checkbox" name="q3[]" value="php"> PHP</label>
                    <label><input type="checkbox" name="q3[]" value="java"> Java</label>
                    <label><input type="checkbox" name="q3[]" value="python"> Python</label>
                </li>

                <li>
                    <label>4. Elige un profesor:</label><br>
                    <select name="q4">
                        <option value="gonzalo">Gonzalo</option>
                        <option value="gonzi">Gonzi</option>
                        <option value="gonzalothebest">Gonzalo el mejor</option>
                    </select>
                </li>

                <li>
                    <label>5. ¿Cuántos temas tiene este modulo?</label><br>
                    <input type="number" name="q5" min="0" required>
                </li>

                <li>
                    <label>6. ¿Tenemos recuperaciones?</label><br>
                    <label><input type="radio" name="q6" value="Si"> Sí</label>
                    <label><input type="radio" name="q6" value="No"> No</label>
                </li>

                <li>
                    <label>7. ¿Materia principal? </label><br>
                    <input type="text" name="q7" required>
                </li>

                <li>
                    <label>8. ¿Cuál es tu tema favorito?</label><br>
                    <label><input type="radio" name="q8" value="option1"> PHP</label>
                    <label><input type="radio" name="q8" value="option2"> Gonzi Skater</label>
                </li>

                <li>
                    <label>9. ¿Tenemos plataforma educativa?</label><br>
                    <label><input type="radio" name="q9" value="Si"> Sí</label>
                    <label><input type="radio" name="q9" value="No"> No</label>
                </li>

                <li>
                    <label>10. ¿Asignatura mas aprobada?</label><br>
                    <input type="text" name="q10" required>
                </li>
            </ol>

            <button type="submit" class="btn">Enviar</button>
        </form>
    <?php endif; ?>
</main>

<?php include "components/footer.php"; ?>
</body>
</html>
