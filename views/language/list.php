<?php
require_once('../../controllers/LanguageController.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1">
    <title>Listado de Idiomas disponibles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+ILRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container mt-4">
    <div class="col-12">
        <h1>Listado de Idiomas disponibles</h1>
        <a href="create.php" class="btn btn-primary mt-2">Nuevo</a>
    </div>

<?php
$languageList = listLanguages();

if (count($languageList) > 0) {
?>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Iso Code</th>
        </tr>
    </thead>    
    <tbody>
        <?php foreach ($languageList as $language) { ?>
            <tr>
                <td><?php echo $language->getId_language(); ?></td>
                <td><?php echo $language->getName(); ?></td>
                <td><?php echo $language->getIsoCode(); ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Acciones">
                        <a class="btn btn-success" href="edit.php?id=<?php echo $language->getId_language(); ?>">Editar</a>
                        <form name="delete_language" action="delete.php" method="POST" style="display:inline;">
                            <input type="hidden" name="languageId" value="<?php echo $language->getId_language(); ?>" >
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </div>
                </td>
            </tr>

            <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                Aun no existen idiomas ingresados.
            </div>
        <?php } ?>
        <div>
        <a href="../../index.html" class="btn btn-secondary">Inicio</a>
        </div>
    </div>
</body>
</html>

