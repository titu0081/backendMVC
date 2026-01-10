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
            $languageCreated = false;
            if (isset($_POST['createBtn'])) {
                $sendData = true;
            }
            if($sendData){
                if(isset($_POST['languageName']) || isset($_POST['languageIso_code'])){
                    $languageCreated = storeLanguage($_POST['languageName'], $_POST['languageIso_code']); 
                }
            }
            if (!$sendData) {
                ?>
                <div class="row">
                    <div class="col-12">
                        <h1>Ingresar Nuevo Idioma</h1>
                    </div>
                    <div class="col-12">
                        <form name="create_language" action="" method="POST">
                            <div class="mb-3">
                                <label for="languageName" class="form-label">Nombre idioma</label>
                                <input id="languageName" name="languageName" type="text" placeholder="Nombre del idioma">
                            </div>
                            <div class="mb-3">
                                <label for="languageIso_code" class="form-label">Iso Code Idioma</label>
                                <input id="languageIso_code" name="languageIso_code" type="text" placeholder="Codigo ISO del idioma">
                            </div>
                            <input type="submit" value="Crear" class="btn btn-primary" name="createBtn" >
                        </form>
                    </div>
                </div>
                <?php
                } else {
                    if ($languageCreated) {
                ?>
                <div class="row">
                <div class="alert alert-success" role="alert">
                    Idioma ingresado correctamente. <a href="list.php">Volver al listado de idiomas</a>
                    </div>
                <?php
                } else {
                ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        Idioma no se ha creado correctamente. <a href="create.php">Volver a ingresar idioma</a>
                    </div>
                </div>
                <?php
                }
            }
            ?>
</div>
</body>
</html>