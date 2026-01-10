<?php
require_once('../../controllers/DirectorController.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1">
    <title>Eliminar plataforma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+ILRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</head>

<body>
<?php

$directorDeleted = false;

$directorId = isset($_POST['directorId']) ? (int)$_POST['directorId'] : 0;


if ($directorId > 0) {
    $directorDeleted = deleteDirector($directorId);
}

?>

<div class="container mt-4">
    <?php if ($directorDeleted) { ?>
            <div class="alert alert-success" role="alert">
                Plataforma eliminada correctamente.
                <a href="list.php">Volver al listado de plataformas</a>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                La plataforma no se ha eliminado correctamente.
                <a href="edit.php?id=<?php echo (int)$directorId; ?>">Volver a intentar</a>
            </div>
        <?php }
    ?>
</div>
</body>
</html>
