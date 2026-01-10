<?php
require_once __DIR__ . '/../../controllers/SeriesController.php';
$data = (new SeriesController())->create();
$actors = $data['actors'];
$languages = $data['languages'];
$platforms = $data['platforms'];
$directors = $data['directors'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear Serie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Crear Nueva Serie</h2>
                    </div>
                    <div class="card-body p-4">
                        <form action="store.php" method="POST">
                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold">Título *</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <div class="mb-3">
                                <label for="id_platform" class="form-label fw-bold">Plataforma *</label>
                                <select class="form-select" id="id_platform" name="id_platform" required>
                                    <option value="">-- Seleccione una plataforma --</option>
                                    <?php foreach ($platforms as $p) { ?>
                                        <option value="<?= htmlspecialchars($p->getId_platform()) ?>">
                                            <?= htmlspecialchars($p->getName()) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="id_director" class="form-label fw-bold">Director *</label>
                                <select class="form-select" id="id_director" name="id_director" required>
                                    <option value="">-- Seleccione un director --</option>
                                    <?php foreach ($directors as $d) { ?>
                                        <option value="<?= htmlspecialchars($d->getId_director()) ?>">
                                            <?= htmlspecialchars($d->getName() . ' ' . $d->getSurname()) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="actors" class="form-label fw-bold">Actores (selección múltiple)</label>
                                <select class="form-select" id="actors" name="actors[]" multiple size="8">
                                    <?php foreach ($actors as $a) { ?>
                                        <option value="<?= htmlspecialchars($a->getId_actor()) ?>">
                                            <?= htmlspecialchars($a->getName() . ' ' . $a->getSurname()) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <small class="form-text text-muted">Mantén pulsado Ctrl (Windows) o Cmd (Mac) para seleccionar varios</small>
                            </div>

                            <div class="mb-4">
                                <label for="languages" class="form-label fw-bold">Idiomas (selección múltiple)</label>
                                <select class="form-select" id="languages" name="languages[]" multiple size="6">
                                    <?php foreach ($languages as $l) { ?>
                                        <option value="<?= htmlspecialchars($l->getId_language()) ?>">
                                            <?= htmlspecialchars($l->getName()) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <small class="form-text text-muted">Mantén pulsado Ctrl (Windows) o Cmd (Mac) para seleccionar varios</small>
                            </div>

                            <div class="d-grid gap-2 d-flex justify-content-end">
                                <a href="list.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Guardar Serie
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>