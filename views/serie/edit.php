<?php
require_once __DIR__ . '/../../controllers/SeriesController.php';

$idSerie = $_GET['id'] ?? null;
if (!$idSerie) {
    die("ID de serie no proporcionado");
}

$controller = new SeriesController();
$serie = $controller->show($idSerie);
$data = $controller->create();
$relations = $controller->getSerieRelations($idSerie);

$actors = $data['actors'];
$languages = $data['languages'];
$platforms = $data['platforms'];
$directors = $data['directors'];

$seriesActors = $relations['actors'];
$seriesLanguages = $relations['languages'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Serie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Editar Serie</h4>
                    </div>

                    <div class="card-body">

                        <form action="update.php" method="POST">

                            <input type="hidden" name="id_serie" value="<?= $serie->getId_series() ?>">

                            <!-- Título -->
                            <div class="mb-3">
                                <label class="form-label">Título</label>
                                <input type="text" name="title" class="form-control"
                                    value="<?= $serie->getTitle() ?>" required>
                            </div>

                            <!-- Plataforma -->
                            <div class="mb-3">
                                <label class="form-label">Plataforma</label>
                                <select name="id_platform" class="form-select" required>
                                    <?php foreach ($platforms as $p) { ?>
                                        <option value="<?= $p->getId_platform() ?>"
                                            <?= $p->getId_platform() == $serie->getId_platform() ? 'selected' : '' ?>>
                                            <?= $p->getName() ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Director -->
                            <div class="mb-3">
                                <label class="form-label">Director</label>
                                <select name="id_director" class="form-select" required>
                                    <?php foreach ($directors as $d) { ?>
                                        <option value="<?= $d->getId_director() ?>"
                                            <?= $d->getId_director() == $serie->getId_director() ? 'selected' : '' ?>>
                                            <?= $d->getName() . ' ' . $d->getSurname() ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Actores -->
                            <div class="mb-3">
                                <label class="form-label">Actores</label>
                                <select name="actors[]" class="form-select" multiple size="6">
                                    <?php foreach ($actors as $a) { ?>
                                        <option value="<?= $a->getId_actor() ?>"
                                            <?= in_array($a->getId_actor(), $seriesActors) ? 'selected' : '' ?>>
                                            <?= $a->getName() . ' ' . $a->getSurname() ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Idiomas -->
                            <div class="mb-3">
                                <label class="form-label">Idiomas</label>
                                <select name="languages[]" class="form-select" multiple size="6">
                                    <?php foreach ($languages as $l) { ?>
                                        <option value="<?= $l->getId_language() ?>"
                                            <?= in_array($l->getId_language(), $seriesLanguages) ? 'selected' : '' ?>>
                                            <?= $l->getName() ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Botones -->
                            <div class="d-flex justify-content-between">
                                <a href="list.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Actualizar Serie</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>