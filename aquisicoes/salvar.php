<?php

include("verificar-autenticidade.php");
include("conexao-pdo.php");
//verifica se está vindo informações via post
if ($_POST) {
    //verifica campos obrigatórios
    if (empty($_POST["NOME"]) || empty($_POST["CPF"]) || empty($_POST["WHATSAPP"]) || empty($_POST["EMAIL"]) ) {
        $_SESSION["tipo"] = 'warning';
        $_SESSION["title"] = 'Ops!';
        $_SESSION["msg"] = 'Por favor, preencha os campos obrigatórios.';
        header("location: ./");
        exit;
    } else {
        $PK_CLIENTE = trim($_POST["PK_CLIENTE"]);
        $NOME = trim($_POST["NOME"]);
        $CPF = trim($_POST["CPF"]);
        $WHATSAPP = trim($_POST["WHATSAPP"]);
        $EMAIL = trim($_POST["EMAIL"]);

        try {
            if (empty($PK_CLIENTE)) {
                $sql = "
             INSERT INTO clientes (NOME,CPF,WHATSAPP,EMAIL)
             VALUES(:NOME,:CPF,:WHATSAPP,:EMAIL)
             ";
                $stmt = $coon->prepare($sql);
                $stmt->bindParam(':NOME',$NOME);
                $stmt->bindParam(':CPF',$CPF);
                $stmt->bindParam(':WHATSAPP',$WHATSAPP);
                $stmt->bindParam(':EMAIL',$EMAIL);
            } else {
                $sql = "
                UPDATE clientes SET NOME =:NOME, CPF =:CPF,WHATSAPP =:WHATSAPP, EMAIL =:EMAIL
                WHERE PK_CLIENTE = :PK_CLIENTE
                ";
                $stmt = $coon->prepare($sql);
                $stmt->bindParam(':PK_CLIENTE', $PK_CLIENTE);
                $stmt->bindParam(':NOME', $NOME);
                $stmt->bindParam(':CPF', $CPF);
                $stmt->bindParam(':WHATSAPP', $WHATSAPP);
                $stmt->bindParam(':EMAIL', $EMAIL);
            }

            //executa inset ou update acima
            $stmt->execute();
            $_SESSION["tipo"] = 'success';
            $_SESSION["title"] = 'Oba!';
            $_SESSION["msg"] = 'Registro salvo com sucesso!';
            
            header("location: ./");
            exit;
        } catch (PDOException $ex) {
            $_SESSION["tipo"] = 'error';
            $_SESSION["title"] = 'Ops!';
            $_SESSION["msg"] =  '$ex->getMessage()';
            header("location: ./");
            exit;
        }
    }
}
