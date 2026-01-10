<?php
require_once __DIR__ . '/../../controllers/SeriesController.php';

$seriesList = (new SeriesController())->index();   // función del controller
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1">
    <title>Listado de series</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-4">

        <div class="d-flex align-items-center justify-content-between mb-3">
            <h1>Listado de series</h1>
            <a href="create.php" class="btn btn-primary mt-2">Crear serie</a>
        </div>

        <?php if (count($seriesList) > 0) { ?>

            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Plataforma</th>
                        <th>Director</th>
                        <th>Actores</th>
                        <th>Idiomas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($seriesList as $serie) { ?>
                        <tr>
                            <td><?= $serie['id_series'] ?></td>
                            <td><?= $serie['title'] ?></td>
                            <td><?= $serie['platform'] ?></td>
                            <td><?= $serie['director'] ?></td>
                            <td><?= $serie['actors'] ?></td>
                            <td><?= $serie['languages'] ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a class="btn btn-success" href="edit.php?id=<?= $serie['id_series'] ?>">Editar</a>

                                    <!-- Botón que abre el modal -->
                                    <button
                                        type="button"
                                        class="btn btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal<?= $serie['id_series'] ?>">
                                        Borrar
                                    </button>
                                </div>
                            </td>

                        </tr>
                        <div class="modal fade" id="deleteModal<?= $serie['id_series'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Confirmar eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        ¿Estás seguro que deseas eliminar la serie
                                        <strong><?= $serie['title'] ?></strong>?
                                        <br><br>
                                        Esta acción no se puede deshacer.
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancelar
                                        </button>

                                        <form action="delete.php" method="POST">
                                            <input type="hidden" name="id_series" value="<?= $serie['id_series'] ?>">
                                            <button type="submit" class="btn btn-danger">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </tbody>
            </table>

        <?php } else { ?>

            <div class="alert alert-warning">
                Aún no existen series registradas.
            </div>

        <?php } ?>

    </div>



</body>

</html>