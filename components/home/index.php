<?php
    require "../../services/conexaoMysql.php";
    require "../login/autenticacao.php";
    session_start(); //Informa que quer usar a variáveis de sessão

    $pdo = mysqlConnect();

    //compara se existe
    if(!exitWhenNotLogged($pdo)){
        exit();
    }

    try {
        $sql = <<<SQL
        SELECT id, email, senhaHash
        FROM anunciante
        SQL;

        $stmt = $pdo->query($sql);
            
    }
    catch (Exception $e) {
        exit('Ocorreu uma falha: ' .$e->getMessage());
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Produtos</title>
</head>
<body>
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Senha</th>
                </tr>
            </thead>
            <?php
            while($row = $stmt->fetch()){
                $id = htmlspecialchars($row['id']);
                $email = htmlspecialchars($row['email']);
                $hash_senha = htmlspecialchars($row['senhaHash']);

                echo <<<HTML
                    <tr>
                        <th scope="row">$id</th>
                        <th scope="row">$email</th>
                        <th scope="row">$hash_senha</th>
                    </tr>
                HTML;
            }
            ?>
        </table>
        <a href="index.html">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg> Voltar</a>
    </div>
</body>
</html>