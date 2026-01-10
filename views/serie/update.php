<?php
require_once __DIR__ . '/../../controllers/SeriesController.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idSerie = $_POST['id_serie'];
    $title = $_POST['title'];
    $idPlatform = $_POST['id_platform'];
    $idDirector = $_POST['id_director'];

    $actors = $_POST['actors'] ?? [];
    $languages = $_POST['languages'] ?? [];

    $controller = new SeriesController();
    $result = $controller->update($idSerie, $title, $idPlatform, $idDirector, $actors, $languages);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Actualizar Serie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <?php if ($result) { ?>
            <div class="alert alert-success shadow" role="alert">
                ✅ Serie actualizada correctamente.<br><br>
                <a href="list.php" class="btn btn-primary">Volver al listado</a>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger shadow" role="alert">
                ❌ La serie no se pudo actualizar.<br><br>
                <a href="edit.php?id=<?= (int)$idSerie ?>" class="btn btn-warning">Volver a intentar</a>
            </div>
        <?php } ?>

    </div>

</body>

</html>