<?php
require_once('../../controllers/ActorController.php');
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
$actorEdited = false;
$errorMsg = "";

$actorId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Si no hay ID válido, no se puede editar
if ($actorId <= 0) {
    $errorMsg = "ID inválido. No se puede editar.";
    $actor = null;
} else {
    $actor = getActorById($actorId);
    if (!$actor) {
        $errorMsg = "No existe una plataforma con el ID indicado.";
    }
}

// Detectar envío
if (isset($_POST['updateBtn'])) {
    $sendData = true;


// Procesar update
    $actorId = isset($_POST['actorId']) ? (int)$_POST['actorId'] : 0;
    $newName  = isset($_POST['actorName']) ? trim($_POST['actorName']) : "";
    $newSurname = isset($_POST['actorSurname']) ? trim($_POST['actorSurname']) : "";
    $newBirthdate = isset($_POST['actorBirthdate']) ? trim($_POST['actorBirthdate']) : "";
    $newNationality = isset($_POST['actorNationality']) ? trim($_POST['actorNationality']) : "";

    if ($newName === "" || $newSurname === "" || $newBirthdate === "" || $newNationality === "") {
        $errorMsg = "No pueden haber campos vacíos.";
    } else {
        $actorEdited = updateActor($actorId, $newName, $newSurname, $newBirthdate, $newNationality);
    }
}
$currentName = "";
$currentSurname = "";
$currentBirthdate = date("Y-m-d");
$currentNationality = "";

if ($sendData) {
    $currentName = isset($_POST['actorName']) ? trim($_POST['actorName']) : "";
    $currentSurname = isset($_POST['actorSurname']) ? trim($_POST['actorSurname']) : "";
    $currentBirthdate = isset($_POST['actorBirthdate']) ? trim($_POST['actorBirthdate']) : date("Y-m-d");
    $currentNationality = isset($_POST['actorNationality']) ? trim($_POST['actorNationality']) : "";
} else {
    $currentName = $actor ? $actor->getName() : "";
    $currentSurname = $actor ? $actor->getSurname() : ""; 
    $currentBirthdate = $actor ? $actor->getBithdate() : date("Y-m-d");
    $currentNationality = $actor ? $actor->getNationality() : "";
}

?>

<div class="container mt-4">
<?php if (!$sendData) { ?>
       <div class="col-12">
            <form name="edit_actor" action="edit.php?id=<?php echo (int)$actorId; ?>" method="POST">
                <input type="hidden" name="actorId" value="<?php echo (int)$actorId; ?>">
                    <div class="mb-3">
                        <label for="actorName" class="form-label">Nombre</label>
                        <input id="actorName"
                               name="actorName"
                               type="text"
                               class="form-control"
                               placeholder="Introduce nombre"
                               value="<?php echo htmlspecialchars($currentName); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="actorSurname" class="form-label">Apellido</label>
                        <input id="actorSurname"
                               name="actorSurname"
                               type="text"
                               class="form-control"
                               placeholder="Introduce apellido"
                               value="<?php echo htmlspecialchars($currentSurname); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="actorBirthdate" class="form-label">Fecha de Nacimiento</label>
                        <input id="actorBirthdate"
                               name="actorBirthdate"
                               type="date"
                               class="form-control"
                               placeholder="Introduce fecha de nacimiento"
                               value="<?php echo htmlspecialchars($currentBirthdate); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="actorNationality" class="form-label">Nacionalidad</label>
                        <input id="actorNationality"
                               name="actorNationality"
                               type="text"
                               class="form-control"
                               placeholder="Introduce nacionalidad"
                               value="<?php echo htmlspecialchars($currentNationality); ?>">
                    </div>

                    <input type="submit" value="Actualizar" class="btn btn-primary" name="updateBtn">
                    <a href="list.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    <?php } else { ?>
        <?php if ($actorEdited) { ?>
            <div class="alert alert-success" role="alert">
                Plataforma editada correctamente.
                <a href="list.php">Volver al listado de plataformas</a>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                La plataforma no se ha editado correctamente.
                <a href="edit.php?id=<?php echo (int)$actorId; ?>">Volver a intentar</a>
            </div>
        <?php }
    } ?>
</div>
</body>
</html>
