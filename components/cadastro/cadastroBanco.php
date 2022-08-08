<?php
    
    function cadastro($pdo, $nome, $cpf, $email, $hashsenha, $telefone){
        try{
            $sql = <<<SQL
                INSERT INTO anunciante (nome, cpf, email, senhaHash, telefone)
                VALUES (?, ?, ?, ?, ?)
                SQL;
    
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $cpf, $email, $hashsenha, $telefone]);

            return true;
        }
        catch(Exception $e){
            if ($e->errorInfo[1] === 1062)
                exit('Dados duplicados: ' . $e->getMessage());
            else
                exit('Falha ao cadastrar os dados: ' . $e->getMessage());
        }
    }
?>