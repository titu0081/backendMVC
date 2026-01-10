<?php
require_once __DIR__ . '/../models/Director.php';

function listDirectors()
{
    $model = new Director();
    $directorList = $model->getAll();
    $directorObjetArray = [];

    foreach ($directorList as $directorItem) {
        $directorObjet = new Director(
            $directorItem->getId_director(),
            $directorItem->getName(),
            $directorItem->getSurname(),
            $directorItem->getBithdate(),
            $directorItem->getNationality()
        );
        array_push($directorObjetArray, $directorObjet);
    }

    return $directorObjetArray;
}

function storeDirector($directorName, $directorSurname, $directorBirthdate, $directorNationality)
{
    $newDirector = new Director(null, $directorName, $directorSurname, $directorBirthdate, $directorNationality);
    $directorCreated = $newDirector->store();
    return $directorCreated;
}


function updateDirector($directorId, $directorName, $directorSurname, $directorBirthdate, $directorNationality)
{
    $editDirector = new Director($directorId, $directorName, $directorSurname, $directorBirthdate, $directorNationality);
    $directorEdited = $editDirector->update();
    return $directorEdited;
}

function getDirectorById($directorId)
{
    $model = new Director();
    $director = $model->getById($directorId);
    return $director;
}


function deleteDirector($directorId)
{
    $deleteDirector = new Director($directorId, null, null, null, null);
    $directorDeleted = $deleteDirector->delete();
    return $directorDeleted;
}
