<?php

    function checkPassword($pdo, $email, $senha){
        $sql = <<<SQL
            SELECT senhaHash
            FROM anunciante
            WHERE email = ?
            SQL;
        
        try{
            //Utiliza statements para previnir ataques do tipo SQL injection
            //pois precisamos inserir dados fornecidos por usuários.
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $senhaHash = $stmt->fetchColumn();
            if(!$senhaHash){
                return false; //email não encontrado
            }
            if(!password_verify($senha, $senhaHash)){
                return false; //senha incorreta
            }
            else {
                return $senhaHash; //email e senha corretos
            }
        }
        catch(Exception $e){
            exit('Falha inesperada: ' .$e->getMessage());
        }
    }

        function checkLogged($pdo){

            //verifica se as variáveis de sessão foram criadas no momento do login
            if(!isset($_SESSION['emailUsuario'], $_SESSION['loginString'])){
                return false;
            }
            $email = $_SESSION['emailUsuario'];

            //Resgata a senha hash armazenada para conferência
            $sql = <<<SQL
                SELECT senhaHash
                FROM anunciante
                WHERE email = ?
                SQL;
        
        try{
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $senhaHash = $stmt->fetchColumn();
            if(!$senhaHash){
                return false;
            }

            //Gera uma nova string de login com base nos dados atuais do navegador do usuário
            //e compara com a string de login gerada anteriormente no momento do login
            $loginStringCheck = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);
            
            if(!hash_equals($loginStringCheck, $_SESSION['loginString'])){
                return false;
            }
            return true;
        }
        catch(Exception $e){
            exit('Falha inesperada: ' .$e->getMessage());
        }
    }

    function exitWhenNotLogged($pdo){
        if(!checkLogged($pdo)){
            header("Location: ../login/login.html");
            exit();
        }
    }
?>