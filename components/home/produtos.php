<?php
    require_once "../../services/conexaoMysql.php";
    $pdo = mysqlConnect();

    class Produtos {
        public $titulo;
        public $descricao;
        public $preco;

        function __construct($id, $email, $senhaHash){
            $this->id = $id;
            $this->email = $email;
            $this->senhaHash = $senhaHash;
        }
    }

    try {
        $sql = <<<SQL
        SELECT id, email, senhaHash
        FROM anunciante
        SQL;

        $stmt = $pdo->query($sql);

        while($row = $stmt->fetch()){

        }
    }
    catch (Exception $e) {
        exit('Ocorreu uma falha: ' .$e->getMessage());
    }
?>