<?php
require_once('../../controllers/DirectorController.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1">
    <title>Ingreso de datos del Director</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+ILRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</head>
<body>  
    <div class="container mt-4">
        <?php
            $sendData = false;
            $directorCreated = false;
            if (isset($_POST['createBtn'])) {
                $sendData = true;
            }
            if($sendData){
                if(isset($_POST['directorName'], $_POST['directorSurname'], $_POST['directorBirthdate'], $_POST['directorNationality'])){
                    $directorCreated = storeDirector($_POST['directorName'], $_POST['directorSurname'],
                    $_POST['directorBirthdate'], $_POST['directorNationality']); ;
                }
            }
            if (!$sendData) {
                ?>
                <div class="row">
                    <div class="col-12">
                        <h1>Ingresar informacion del Director</h1>
                    </div>
                    <div class="col-12">
                        <form name="create_director" action="" method="POST">
                            <div class="mb-3">
                                <div class="mb-2">
                                <label for="directorName" class="form-label">Nombre</label>
                                <input id="directorName" name="directorName" type="text" placeholder="Introduce nombre">
                                </div><div class="mb-2">
                                <label for="directorSurname" class="form-label">Apellido</label>
                                <input id="directorSurname" name="directorSurname" type="text" placeholder="Introduce apellido">
                                </div><div class="mb-2">
                                <label for="directorBirthdate" class="form-label">Fecha de nacimiento</label>
                                <input id="directorBirthdate" name="directorBirthdate" type="date" >
                                </div>
                                <label for="directorNationality" class="form-label">Nacionalidad</label>
                                <input id="directorNationality" name="directorNationality" type="text" placeholder="Introduce Nacionalidad">
                                </div>
                            <input type="submit" value="Crear" class="btn btn-primary" name="createBtn" >
                            <a href="list.php" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
                <?php
                } else {
                    if ($directorCreated) {
                ?>
                <div class="row">
                <div class="alert alert-success" role="alert">
                     Director ingresado correctamenre. <a href="list.php">Volver al listado de Directores</a>
                    </div>
                <?php
                } else {
                ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        No se pudo ingresar el Director correctamente. <a href="create.php">Volver a ingresar Director</a>
                    </div>
                </div>
                <?php
                }
            }
            ?>
</div>
</body>
</html>