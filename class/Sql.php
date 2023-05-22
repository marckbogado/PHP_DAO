<?php 

//escolhi o nome SQL para a classe
class Sql extends PDO {//PDO CLasse nativa do PHP!
    
    private $conn;//escopo principal

    //função para quando eu for estanciar a classe SQL, irá conectar automaticamente com o BANCO DE DADOS
    public function __construct() {
        
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "root");
    }

    private function setParams($statment, $parameters = array()) {

        foreach ($parameters as $key => $value) {

            $this->setParam($statment,$key, $value);
        }
    }

    private function setParam($statment, $key, $value) {

        $statment->bindParam($key, $value);
    }

    //para enviar os comandos para o BANCO
    public function query1($rawQuery, $params = array()) {
    
        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;
        
    }

    public function select($rawQuery, $params = array()) {

        $stmt = $this->query1($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}



?>