<?php
require_once __DIR__ . '/../models/Actor.php';

function listActors()
{
    $model = new Actor();
    $actorList = $model->getAll();
    $actorObjetArray = [];

    foreach ($actorList as $actorItem) {
        $actorObjet = new Actor(
            $actorItem->getId_actor(),
            $actorItem->getName(),
            $actorItem->getSurname(),
            $actorItem->getBithdate(),
            $actorItem->getNationality()
        );
        array_push($actorObjetArray, $actorObjet);
    }

    return $actorObjetArray;
}

function storeActor($actorName, $actorSurname, $actorBirthdate, $actorNationality)
{
    $newActor = new Actor(null, $actorName, $actorSurname, $actorBirthdate, $actorNationality);
    $actorCreated = $newActor->store();
    return $actorCreated;
}


function updateActor($actorId, $actorName, $actorSurname, $actorBirthdate, $actorNationality)
{
    $editActor = new Actor($actorId, $actorName, $actorSurname, $actorBirthdate, $actorNationality);
    $actorEdited = $editActor->update();
    return $actorEdited;
}

function getActorById($actorId)
{
    $model = new Actor();
    $actor = $model->getById($actorId);
    return $actor;
}

function deleteActor($actorId)
{
    $deleteActor = new Actor($actorId, null, null, null, null);
    $actorDeleted = $deleteActor->delete();
    return $actorDeleted;
}
