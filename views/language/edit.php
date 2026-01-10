<?php
require_once('../../controllers/LanguageController.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1">
    <title>Editar idioma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+ILRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</head>

<body>
<?php
$sendData = false;
$languageEdited = false;
$errorMsg = "";

$languageId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Si no hay ID válido, no se puede editar
if ($languageId <= 0) {
    $errorMsg = "ID inválido. No se puede editar.";
    $language = null;
} else {
    $language = getLanguageById($languageId);
    
}

// Detectar envío
if (isset($_POST['updateBtn'])) {
    $sendData = true;
}

// Procesar update
    $postedId = isset($_POST['languageId']) ? (int)$_POST['languageId'] : 0;
    $newName  = isset($_POST['languageName']) ? trim($_POST['languageName']) : "";
    $newIsocode  = isset($_POST['languageIso_code']) ? trim($_POST['languageIso_code']) : "";
    if ($newName === "" || $newIsocode === "") {
        $errorMsg = "La plataforma ingresada ya existe."; 
    } else {
        $languageEdited = updateLanguage($postedId, $newName, $newIsocode);
    }


// Para el input: si falló y hay POST, mostramos lo escrito; si no, el valor de BD
$currentName = "";
$currentIsocode = "";
if ($sendData) {
    $currentName = isset($_POST['languageName']) ? trim($_POST['languageName']) : "";
    $currentIsocode = isset($_POST['languageIso_code']) ? trim($_POST['languageIso_code']) : "";
} else {
    $currentName = $language ? $language->getName() : "";
    $currentIsocode = $language ? $language->getIsoCode() : "";
}
?>

<div class="container mt-4">
<?php if (!$sendData) { ?>
       <div class="col-12">
            <form name="edit_language" action="edit.php?id=<?php echo (int)$languageId; ?>" method="POST">
                <input type="hidden" name="languageId" value="<?php echo (int)$languageId; ?>">
                    <div class="mb-3">
                        <label for="languageName" class="form-label">Idioma</label>
                        <input id="languageName"
                               name="languageName"
                               type="text"
                               class="form-control"
                               placeholder="Introduce nombre del idioma"
                               value="<?php echo htmlspecialchars($currentName); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="languageIso_code" class="form-label">Isocode</label>
                        <input id="languageIso_code"
                               name="languageIso_code"
                               type="text"
                               class="form-control"
                               placeholder="Introduce el código ISO del idioma"
                               value="<?php echo htmlspecialchars($currentIsocode); ?>">
                    </div>

                    <input type="submit" value="Actualizar" class="btn btn-primary" name="updateBtn">
                    <a href="list.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    <?php } else { ?>
        <?php if ($languageEdited) { ?>
            <div class="alert alert-success" role="alert">
                Plataforma editada correctamente.
                <a href="list.php">Volver al listado de plataformas</a>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                La plataforma no se ha editado correctamente.
                <a href="edit.php?id=<?php echo (int)$languageId; ?>">Volver a intentar</a>
            </div>
        <?php }
    } ?>
</div>
</body>
</html>
