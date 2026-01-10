<?php
require_once __DIR__ . '/../models/Language.php';

function listLanguages()
{
    $model = new Language();
    $languageList = $model->getAll();
    $languageObjetArray = [];

    foreach ($languageList as $languageItem) {
        $languageObjet = new Language($languageItem->getId_language(), $languageItem->getName(), $languageItem->getIsoCode());
        array_push($languageObjetArray, $languageObjet);
    }

    return $languageObjetArray;
}

function storeLanguage($languageName, $languageIso_code)
{
    $newLanguage = new Language(null, $languageName, $languageIso_code);
    $languageCreated = $newLanguage->store();
    return $languageCreated;
}

function updateLanguage($languageId, $languageName, $languageIso_code)
{
    $editLanguage = new Language($languageId, $languageName, $languageIso_code);
    $languageEdited = $editLanguage->update();
    return $languageEdited;
}

function deleteLanguage($languageId)
{
    $deleteLanguage = new Language($languageId, null, null);
    $languageDeleted = $deleteLanguage->delete();
    return $languageDeleted;
}

function getLanguageById($languageId)
{
    $model = new Language();
    $language = $model->getById($languageId);
    return $language;
}
