<?php
    function checkLogin($pdo, $email, $senha){
        $sql = <<<SQL
            SELECT has_senha
            FROM cliente
            WHERE email = ?
            SQL;
        
        try{
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $row = $stmt->fetch();
            if(!$row){
                return false;
            }
            else {
                return password_verify($senha, $row['hash_senha']);
            }
        }
        catch(Exception $e){
            exit('Falha inesperada: ' .$e->getMessage());
        }

        $errorMsg = "";

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            require "../../services/conexaoMysql.php";
            $pdo = mysqlConnect();

            $email = $_POST["email"] ?? "";
            $senha = $_POST["senha"] ?? "";

            if(checkLogin($pdo, $email, $senha)){
                header("location:");
                exit();
            }
            else{
                $errorMsg = "E-mail ou senha inválido!";
            }
        }
        
    }
?>