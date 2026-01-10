<?php
require_once __DIR__ . '/../models/Series.php';
require_once __DIR__ . '/ActorController.php';
require_once __DIR__ . '/LanguageController.php';
require_once __DIR__ . '/PlatformController.php';
require_once __DIR__ . '/DirectorController.php';

class SeriesController
{

    public function index()
    {
        $serie = new Series();
        return $serie->getAll();
    }

    public function store($title, $idPlatform, $idDirector, $actors = [], $languages = [])
    {
        $serie = new Series(null, $title, $idPlatform, $idDirector);
        $created = $serie->store();

        if (!$created) return false;

        $mysqli = DBConection::getConection();
        $idSerie = $mysqli->insert_id;

        // Guardar actores
        foreach ($actors as $idActor) {
            $mysqli->query("INSERT INTO series_actor (id_series, id_actor) VALUES ($idSerie, $idActor)");
        }

        // Guardar idiomas
        foreach ($languages as $idLanguage) {
            $mysqli->query("INSERT INTO series_language (id_series, id_language) VALUES ($idSerie, $idLanguage)");
        }

        return true;
    }

    public function update($idSerie, $title, $idPlatform, $idDirector, $actors = [], $languages = [])
    {
        $serie = new Series($idSerie, $title, $idPlatform, $idDirector);
        $updated = $serie->update();

        if (!$updated) return false;

        $mysqli = DBConection::getConection();

        // Limpiar relaciones
        $mysqli->query("DELETE FROM series_actor WHERE id_series = $idSerie");
        $mysqli->query("DELETE FROM series_language WHERE id_series = $idSerie");

        // Insertar nuevas relaciones
        foreach ($actors as $idActor) {
            $mysqli->query("INSERT INTO series_actor (id_series, id_actor) VALUES ($idSerie, $idActor)");
        }

        foreach ($languages as $idLanguage) {
            $mysqli->query("INSERT INTO series_language (id_series, id_language) VALUES ($idSerie, $idLanguage)");
        }

        return true;
    }

    public function delete($idSerie)
    {
        $serie = new Series($idSerie);
        return $serie->delete();
    }

    public function show($idSerie)
    {
        $serie = new Series();
        return $serie->getById($idSerie);
    }

    public function create()
    {
        $actors = listActors();
        $languages = listLanguages();
        $platforms = listPlatforms();
        $directors = listDirectors();


        return [
            'actors' => $actors,
            'languages' => $languages,
            'platforms' => $platforms,
            'directors' => $directors
        ];
    }

    public function getSerieRelations($idSerie)
    {
        $serie = new Series();
        return [
            'actors' => $serie->getActorsBySeries($idSerie),
            'languages' => $serie->getLanguagesBySeries($idSerie)
        ];
    }
}
