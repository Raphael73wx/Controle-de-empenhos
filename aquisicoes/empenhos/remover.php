<?php

include("../verificar-autenticidade.php");
include("../conexao-pdo.php");
//verifica se está vindo informações via post
// echo base64_decode($_GET["ref"]);exit;
if (empty($_GET["ref"])){
    header("location: ./");

}else {
    $pk_pedidos= base64_decode($_GET["ref"]);
    $sql="
    DELETE FROM pedidos
    WHERE pk_pedidos = :pk_pedidos
    ";
    try {
        $stmt = $coon->prepare($sql);
        $stmt->bindParam(':pk_pedidos', $pk_pedidos);
        $stmt->execute();

        $_SESSION["tipo"] = "success";
        $_SESSION["title"] = "Oba!";
        $_SESSION["msg"] = "Registro removido com sucesso!";

        header("location: ./");
        exit;
        
    }catch(PDOException $ex) {
        $_SESSION["tipo"] = "error";
        $_SESSION["title"] = "Ops!";
        if ($ex->getCode() == 23000 ) {
            $_SESSION["msg"] ="Não é possivel excluir este servico pois esta sendo utilizado em outro local";
        }else {
        $_SESSION["msg"] = $ex->getMessage();
        }
        header("location: ./");
        exit;
    }
}