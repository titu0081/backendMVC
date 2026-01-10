<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1">
    <title>Eliminar Actor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+ILRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php
    require_once __DIR__ . '/../../controllers/SeriesController.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die("Acceso no permitido");
    }

    $idSerie = $_POST['id_series'] ?? null;

    if (!$idSerie) {
        die("ID de serie no proporcionado");
    }

    $controller = new SeriesController();
    $deleted = $controller->delete($idSerie);


    ?>

    <div class="container mt-4">
        <?php if ($deleted) { ?>
            <div class="alert alert-success" role="alert">
                Serie eliminada correctamente.
                <a href="list.php" class="btn btn-primary ms-3">Volver</a>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                No se eliminó la serie.
                <a href="list.php" class="btn btn-secondary ms-3">Volver</a>
            </div>
        <?php }
        ?>
    </div>
</body>

</html>