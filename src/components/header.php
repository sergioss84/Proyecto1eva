<?php
// Header: banderas + logout + título
$langSelected = $_GET['lang'] ?? ($_SESSION['lang'] ?? 'es');
$_SESSION['lang'] = $langSelected;
$lang = include __DIR__ . "/../lang/{$langSelected}.php";
?>

<HTML>
<header class="site-header">
    <div class="left">
        <h2><?= htmlspecialchars($lang['title']) ?></h2>
    </div>
</header>
<BODY>
    <div class="right">
        <a href="?=es"><img src="/img"></a>
        <a href="?=uk"><img src="/img"></a>
        <a class="flag" href="?lang=es<?= isset($_GET['from']) ? '&from='.$_GET['from'] : '' ?>" title="Español">ES</a>
        <a class="flag" href="?lang=en<?= isset($_GET['from']) ? '&from='.$_GET['from'] : '' ?>" title="English">EN</a>

        <?php if (isset($_SESSION["logueado"]) && $_SESSION["logueado"]): ?>
            <a class="logout" href="index.php?reset=true"><?= htmlspecialchars($lang['logout']) ?></a>
        <?php endif; ?>
    </div>
        </BODY>
        </HTML>