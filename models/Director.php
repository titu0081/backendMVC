<?php
    require_once('../../models/DBConection.php');
    class Director{
        private $id_director;
        private $name;
        private $surname;
        private $birthdate;
        private $nationality;

        public function __construct($idDirector = null, $nameDirector = null, $surnameDirector = null, $birthdateDirector = null, $nationalityDirector = null){
            if(!is_null($idDirector)){
            $this->id_director = $idDirector;
            }
            if(!is_null($nameDirector)){
                $this->name = $nameDirector;
            }    
            if(!is_null($surnameDirector)){
                $this->surname = $surnameDirector;
            }    
            if(!is_null($birthdateDirector)){
                $this->birthdate = $birthdateDirector;
            }    
            if(!is_null($nationalityDirector)){
                $this->nationality = $nationalityDirector;
            }    
        }

        public function getId_director(){
            return $this->id_director;
        }

        public function getName(){
            return $this->name;
        }

        public function getSurname(){
            return $this->surname;
        }

        public function getBithdate(){
            return $this->birthdate;
        }

        public function getNationality(){
            return $this->nationality;
        }

        public function setId_director($id_director) {
            $this->id_director = $id_director;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function setSurname($surname){
            $this->surname = $surname;
        }

        public function setBirthdate($birthdate){
            $this->birthdate = $birthdate;
        }

        public function setNationality($nationality){
            $this->nationality = $nationality;
        }

        public function getAll(){
        $mysqli = DBConection::getConection();
        
        $query = $mysqli->query('SELECT * FROM directors');
        $listData = [] ; 

        foreach($query as $item){
            $itemObject = new Director($item['id_director'],$item['name'],$item['surname'],$item['birthdate'],$item['nationality']);
            array_push($listData, $itemObject) ;
            #$listData[]= $itemObject; Otra forma de introducirlo en el array
        }
        return $listData;
        
    }

    public function store(){
        $directorCreated = false ;
        $mysqli = DBConection::getConection();

        if($resultInsert = $mysqli->query("INSERT INTO directors (name, surname, birthdate, nationality) 
        VALUES ('$this->name', '$this->surname', '$this->birthdate', '$this->nationality')") ){
            $directorCreated = true ;
        }

        return $directorCreated ;
    }

    public function update(){
        $directorEdited = false ;
        $mysqli = DBConection::getConection();

        if($resultEdit = $mysqli->query("UPDATE directors set name = '".$this->name.
        "', surname = '".$this->surname."', birthdate = '".$this->birthdate."', nationality = '".$this->nationality.
        "' WHERE id_director = ".$this->id_director)){
            $directorEdited = true ;
        }

        return $directorEdited ;
    }

    /*
    public function delete(){
        $directorDeleted = false ;
        $mysqli = DBConection::getConection();

        if($resultDelete = $mysqli->query("DELETE FROM directors WHERE id_director = ".$this->id_director)){
            $directorDeleted = true ;
        }

        return $directorDeleted ;
    }

    //Funcion para obtener una plataforma por su ID
    public function getById($id) {
    $mysqli = DBConection::getConection();

    $query = $mysqli->query(
        "SELECT * FROM directors WHERE id_director = ".(int)$id
    );

    $director = null;

    if ($row = $query->fetch_assoc()) {
        $director = new Director($row['id_director'], $row['name']);
    }

    return $director;
}
    */
}
?>