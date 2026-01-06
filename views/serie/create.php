<?php
require_once('../../controllers/PlatformController.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1">
    <title>Ingreso de plataformas</title>
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
            $platformCreated = false;
            if (isset($_POST['createBtn'])) {
                $sendData = true;
            }
            if($sendData){
                if(isset($_POST['platformName'])){
                    $platformCreated = storePlatform($_POST['platformName']) ;
                }
            }
            if (!$sendData) {
                ?>
                <div class="row">
                    <div class="col-12">
                        <h1>Crear plataforma</h1>
                    </div>
                    <div class="col-12">
                        <form name="create_platform" action="" method="POST">
                            <div class="mb-3">
                                <label for="platformName" class="form-label">Nombre plataforma</label>
                                <input id="platformName" name="platformName" type="text" placeholder="Introduce nombre de la plataforma">
                            </div>
                            <input type="submit" value="Crear" class="btn btn-primary" name="createBtn" >
                        </form>
                    </div>
                </div>
                <?php
                } else {
                    if ($platformCreated) {
                ?>
                <div class="row">
                <div class="alert alert-success" role="alert">
                    Plataforma creada correctamente. <a href="list.php">Volver al listado de plataforformas</a>
                    </div>
                <?php
                } else {
                ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        La plataforma no se ha creado correctamente. <a href="create.php">Volver a ingresar plataforma</a>
                    </div>
                </div>
                <?php
                }
            }
            ?>
</div>
</body>
</html>