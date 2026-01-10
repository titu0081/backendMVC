<?php
    require_once __DIR__ . '/../models/DBConection.php';
    class Language{
        private $id_language;
        private $name;
        private $iso_code;
        
        public function __construct($idLanguage = null, $nameLanguage = null, $iso_codeLanguage = null){
            if(!is_null($idLanguage)){
            $this->id_language = $idLanguage;
            }
            if(!is_null($nameLanguage)){
                $this->name = $nameLanguage;
            }
            if(!is_null($iso_codeLanguage)){
                $this->iso_code = $iso_codeLanguage;
            }
        }

        public function getId_language(){
            return $this->id_language;
        }

        public function getName(){
            return $this->name;
        }

        public function getIsoCode(){
            return $this->iso_code;
        }

        public function setId_language($id_language) {
            $this->id_language = $id_language;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function setIsoCode($iso_code){
            $this->iso_code = $iso_code;
        }

        public function getAll(){
        $mysqli = DBConection::getConection();
        
        $query = $mysqli->query('SELECT * FROM languages');
        $listData = [] ; 

        foreach($query as $item){
            $itemObject = new Language($item['id_language'],$item['name'], $item['iso_code']) ;
            array_push($listData, $itemObject) ;
            #$listData[]= $itemObject; Otra forma de introducirlo en el array
        }
        return $listData;
    }

    public function store(){
        $languageCreated = false ;
        $mysqli = DBConection::getConection();

        $checkQuery = "SELECT id_language FROM languages WHERE name = '".$this->name."' AND iso_code = '".$this->iso_code."' LIMIT 1";

        $checkResult = $mysqli->query($checkQuery);

        if($checkResult->num_rows > 0){
            return false ;
        }

        //Tarea: Comprobar que no existe otra plataforma con el mismo nombre
        if($resultInsert = $mysqli->query("INSERT INTO languages (name, iso_code) VALUES ('$this->name' , '$this->iso_code')") ){
            $languageCreated = true ;
        }
        return $languageCreated ;
    }

    public function update(){
        $languageEdited = false ;
        $mysqli = DBConection::getConection();

        if($resultEdit = $mysqli->query("UPDATE languages set name = '".$this->name."', iso_code = '".$this->iso_code."' WHERE id_language = ".$this->id_language)){
            $languageEdited = true ;
        }

        return $languageEdited ;
    }

    public function delete(){
        $languageDeleted = false ;
        $mysqli = DBConection::getConection();

        if($resultDelete = $mysqli->query("DELETE FROM languages WHERE id_language = ".$this->id_language)){
            $languageDeleted = true ;
        }

        return $languageDeleted ;
    }

    //Funcion para obtener una plataforma por su ID
    public function getById($id) {
    $mysqli = DBConection::getConection();

    $query = $mysqli->query(
        "SELECT * FROM languages WHERE id_language = ".(int)$id
    );

    $language = null;

    if ($row = $query->fetch_assoc()) {
        $language = new Language($row['id_language'], $row['name'], $row['iso_code']);
    }

    return $language;
}
}
?>