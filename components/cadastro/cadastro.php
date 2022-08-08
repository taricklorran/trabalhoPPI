<?php

require_once "../../services/conexaoMysql.php";
require_once "cadastroBanco.php";

    class RequestResponse{
        public $success;
        public $detail;

        function __construct($success, $detail){
            $this->success = $success;
            $this->detail = $detail;
        }
    }

    $nome = $_POST["nome"] ?? "";
    $cpf = $_POST["cpf"] ?? "";
    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";
    $telefone = $_POST["telefone"] ?? "";

    $validaDados = true;

    if(empty($nome)){
        $response = new RequestResponse(false, 'O campo nome deve ser preenchido.');
        $validaDados = false;
    }
    else{
        if(empty($cpf)){
            $response = new RequestResponse(false, 'O campo CPF deve ser preenchido.');
            $validaDados = false;
        }
        else{
            if(empty($email)){
                $response = new RequestResponse(false, 'O campo e-mail deve ser preenchido.');
                $validaDados = false;
            }
            else{
                if(empty($senha)){
                    $response = new RequestResponse(false, 'O campo Senha deve ser preenchido.');
                    $validaDados = false;
                }
            }
        }
    }

    if($validaDados == true){
        $hashsenha = password_hash($senha, PASSWORD_DEFAULT);

        $pdo = mysqlConnect();
    
        if(cadastro($pdo, $nome, $cpf, $email, $hashsenha, $telefone)){
            $response = new RequestResponse(true, '../login/login.html');
        }
        else{
            $response = new RequestResponse(false, '');
        }
        echo json_encode($response);
    }
    else{
        echo json_encode($response);
    }



?>