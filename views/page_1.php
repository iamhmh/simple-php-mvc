<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page 1</title>
</head>
<body>
    <h1>Contenu de la page 1</h1>
    <h1>Liste des articles</h1>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <h2><?= htmlspecialchars($article['title']) ?></h2> <!--je sécurise les données avec htmlspecialchars-->
                <p><?= htmlspecialchars($article['content']) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
