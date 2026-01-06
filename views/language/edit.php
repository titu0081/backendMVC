<?php
require_once('../../controllers/PlatformController.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1">
    <title>Editar plataforma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+ILRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</head>

<body>
<?php
$sendData = false;
$platformEdited = false;
$errorMsg = "";

$platformId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Si no hay ID válido, no se puede editar
if ($platformId <= 0) {
    $errorMsg = "ID inválido. No se puede editar.";
    $platform = null;
} else {
    $platform = getPlatformById($platformId);
    if (!$platform) {
        $errorMsg = "No existe una plataforma con el ID indicado.";
    }
}

// Detectar envío
if (isset($_POST['updateBtn'])) {
    $sendData = true;
}

// Procesar update
    $postedId = isset($_POST['platformId']) ? (int)$_POST['platformId'] : 0;
    $newName  = isset($_POST['platformName']) ? trim($_POST['platformName']) : "";
    if ($newName === "") {
        $errorMsg = "La plataforma ingresada ya existe.";
    } else {
        $platformEdited = updatePlatform($postedId, $newName);} // <- controlador


// Para el input: si falló y hay POST, mostramos lo escrito; si no, el valor de BD
$currentName = "";
if ($sendData) {
    $currentName = isset($_POST['platformName']) ? trim($_POST['platformName']) : "";
} else {
    $currentName = $platform ? $platform->getName() : "";
}
?>

<div class="container mt-4">
<?php if (!$sendData) { ?>
       <div class="col-12">
            <form name="edit_platform" action="edit.php?id=<?php echo (int)$platformId; ?>" method="POST">
                <input type="hidden" name="platformId" value="<?php echo (int)$platformId; ?>">
                    <div class="mb-3">
                        <label for="platformName" class="form-label">Nombre plataforma</label>
                        <input id="platformName"
                               name="platformName"
                               type="text"
                               class="form-control"
                               placeholder="Introduce nombre de la plataforma"
                               value="<?php echo htmlspecialchars($currentName); ?>">
                    </div>

                    <input type="submit" value="Actualizar" class="btn btn-primary" name="updateBtn">
                    <a href="list.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    <?php } else { ?>
        <?php if ($platformEdited) { ?>
            <div class="alert alert-success" role="alert">
                Plataforma editada correctamente.
                <a href="list.php">Volver al listado de plataformas</a>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                La plataforma no se ha editado correctamente.
                <a href="edit.php?id=<?php echo (int)$platformId; ?>">Volver a intentar</a>
            </div>
        <?php }
    } ?>
</div>
</body>
</html>
