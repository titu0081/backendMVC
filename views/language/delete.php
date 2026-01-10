<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../../controllers/LanguageController.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1">
    <title>Eliminar Idioma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+ILRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</head>

<body>
<?php

$languageDeleted = false;
$errorMsg = "";

$languageId = isset($_POST['languageId']) ? (int)$_POST['languageId'] : 0;


if ($languageId > 0) {
    $languageDeleted = deleteLanguage($languageId);
}

?>

<div class="container mt-4">
    <?php if ($languageDeleted) { ?>
            <div class="alert alert-success" role="alert">
                El idioma ha sido eliminado correctamente.
                <a href="list.php">Volver al listado de plataformas</a>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                El idioma no ha sido eliminado correctamente.
                <a href="edit.php?id=<?php echo (int)$languageId; ?>">Volver a intentar</a>
            </div>
        <?php }
    ?>
</div>
</body>
</html>
