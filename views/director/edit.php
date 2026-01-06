<?php
require_once('../../controllers/DirectorController.php');
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
$directorEdited = false;
$errorMsg = "";

// Detectar envío
if (isset($_POST['updateBtn'])) {
    $sendData = true;
}

// Procesar update
    $directorId = isset($_POST['directorId']) ? (int)$_POST['directorId'] : 0;
    $newName  = isset($_POST['directorName']) ? trim($_POST['directorName']) : "";
    $newSurname = isset($_POST['directorSurname']) ? trim($_POST['directorSurname']) : "";
    $newBirthdate = isset($_POST['directorBirthdate']) ? trim($_POST['directorBirthdate']) : "";
    $newNationality = isset($_POST['directorNationality']) ? trim($_POST['directorNationality']) : "";

    if ($newName === "" || $newSurname === "" || $newBirthdate === "" || $newNationality === "") {
        $errorMsg = "No pueden haber campos vacíos.";
    } else {
        $directorEdited = updateDirector($directorId, $newName, $newSurname, $newBirthdate, $newNationality);
    }

$currentName = "";
$currentSurname = "";
$currentBirthdate = date("Y-m-d");
$currentNationality = "";

if ($sendData) {
    $currentName = isset($_POST['directorName']) ? trim($_POST['directorName']) : "";
    $currentSurname = isset($_POST['directorSurname']) ? trim($_POST['directorSurname']) : "";
    $currentBirthdate = isset($_POST['directorBirthdate']) ? trim($_POST['directorBirthdate']) : "";
    $currentNationality = isset($_POST['directorNationality']) ? trim($_POST['directorNationality']) : "";
} else {
    $currentName = $director ? $director->getName() : "";
    $currentSurname = $director ? $director->getSurname() : ""; 
    $currentBirthdate = $director ? $director->getBithdate() : date("Y-m-d");
    $currentNationality = $director ? $$director->getNationality() : "";
}
?>

<div class="container mt-4">
<?php if (!$sendData) { ?>
       <div class="col-12">
            <form name="edit_director" action="edit.php?id=<?php echo (int)$directorId; ?>" method="POST">
                <input type="hidden" name="directorId" value="<?php echo (int)$directorId; ?>">
                    <div class="mb-3">
                        <label for="directorName" class="form-label">Nombre</label>
                        <input id="directorName"
                               name="directorName"
                               type="text"
                               class="form-control"
                               placeholder="Introduce nombre"
                               value="<?php echo htmlspecialchars($currentName); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="directorSurname" class="form-label">Apellido</label>
                        <input id="directorSurname"
                               name="directorSurname"
                               type="text"
                               class="form-control"
                               placeholder="Introduce apellido"
                               value="<?php echo htmlspecialchars($currentSurname); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="directorBirthdate" class="form-label">Fecha de Nacimiento</label>
                        <input id="directorBirthdate"
                               name="directorBirthdate"
                               type="date"
                               class="form-control"
                               placeholder="Introduce fecha de nacimiento"
                               value="<?php echo htmlspecialchars($currentBirthdate); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="directorNationality" class="form-label">Nacionalidad</label>
                        <input id="directorNationality"
                               name="directorNationality"
                               type="text"
                               class="form-control"
                               placeholder="Introduce nacionalidad"
                               value="<?php echo htmlspecialchars($currentSurname); ?>">
                    </div>

                    <input type="submit" value="Actualizar" class="btn btn-primary" name="updateBtn">
                    <a href="list.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    <?php } else { ?>
        <?php if ($directorEdited) { ?>
            <div class="alert alert-success" role="alert">
                Plataforma editada correctamente.
                <a href="list.php">Volver al listado de plataformas</a>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                La plataforma no se ha editado correctamente.
                <a href="edit.php?id=<?php echo (int)$directorId; ?>">Volver a intentar</a>
            </div>
        <?php }
    } ?>
</div>
</body>
</html>
