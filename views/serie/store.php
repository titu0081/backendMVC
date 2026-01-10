<?php
require_once __DIR__ . '/../../controllers/SeriesController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $idPlatform = $_POST['id_platform'];
    $idDirector = $_POST['id_director'];

    // Si no selecciona nada, se manda array vacío
    $actors = $_POST['actors'] ?? [];
    $languages = $_POST['languages'] ?? [];

    $controller = new SeriesController();
    $result = $controller->store($title, $idPlatform, $idDirector, $actors, $languages);

    if ($result) {
        header("Location: list.php");
        exit;
    } else {
        echo "❌ Error al crear la serie o ya existe.";
    }
}
