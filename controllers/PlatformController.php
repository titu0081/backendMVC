<?php
    require_once('../../models/Platform.php');

    function listPlatforms(){
        $model = new Platform();
        $platformList = $model-> getAll() ;
        $platformObjetArray = [];

        foreach ($platformList as $platformItem){
            $platformObjet = new Platform($platformItem->getId_platform(), $platformItem->getName()) ;
            array_push($platformObjetArray, $platformObjet) ;
        }

        return $platformObjetArray ;
    }

    function storePlatform($platformName){
        $newPlatform = new Platform(null, $platformName) ;
        $platformCreated = $newPlatform -> store();
        return $platformCreated ;
    }

    function updatePlatform($platformId,$platformName){
        $editPlatform = new Platform($platformId, $platformName) ;
        $platformEdited = $editPlatform -> update();
        return $platformEdited ;
    }

    function deletePlatform($platformId){
        $deletePlatform = new Platform($platformId, null) ;
        $platformDeleted = $deletePlatform -> delete();
        return $platformDeleted;
    }

    function getPlatformById($platformId) {
    $model = new Platform();
    $platform = $model->getById($platformId) ;
    return $platform;
}
?>  