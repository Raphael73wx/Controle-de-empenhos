<?php

include("../verificar-autenticidade.php");
include("../conexao-pdo.php");
//verifica se está vindo informações via post
if ($_POST) {
    //verifica campos obrigatórios
    if (empty($_POST["pedido"]) || empty($_POST["forma_p"]) || empty($_POST["endereco"])) {
        $_SESSION["tipo"] = 'warning';
        $_SESSION["title"] = 'Ops!';
        $_SESSION["msg"] = 'Por favor, preencha os campos obrigatórios.';
        header("location: ./");
        exit;
    } else {
        $pk_pedidos = trim($_POST["pk_pedidos"]);
        $pedido = trim($_POST["pedido"]);
        $forma_p = trim($_POST["forma_p"]);
        $endereco = trim($_POST["endereco"]);
        $data_ini = trim($_POST["data_ini"]);
        $data_fim = trim($_POST["data_fim"]);
        $numero_p = trim($_POST["numero_p"]);
        try {
            if (empty($pk_pedidos)) {
                $sql = "
             INSERT INTO pedidos (pedido,forma_de_pagamento,endereco_de_entrega,numero_do_pedido,data_ini,data_fim)
             VALUES(:pedido,:forma_p,:endereco,:numero_p,CURDATE(),:data_fim)
             ";
             $numero_p = rand(0,2000000);
                $stmt = $coon->prepare($sql);
                $stmt->bindParam(':pedido',$pedido);
                $stmt->bindParam(':forma_p',$forma_p);
                $stmt->bindParam(':endereco',$endereco);
                $stmt->bindParam(':numero_p',$numero_p);
                $stmt->bindParam(':data_fim',$data_fim);
            } else {
                $sql = "
                UPDATE pedidos SET pedido =:pedido, forma_de_pagamento =:forma_p, endereco_de_entrega =:endereco,numero_do_pedido =:numero_p
                WHERE pk_pedidos = :pk_pedidos
                ";
                $stmt = $coon->prepare($sql);
                $stmt->bindParam(':pk_pedidos',$pk_pedidos);
                $stmt->bindParam(':pedido',$pedido);
                $stmt->bindParam(':forma_p',$forma_p);
                $stmt->bindParam(':endereco',$endereco);
                $stmt->bindParam(':numero_p',$numero_p);
            }

            //executa inset ou update acima
            $stmt->execute();
            $_SESSION["tipo"] = 'success';
            $_SESSION["title"] = 'Oba!';
            $_SESSION["msg"] = 'Registro salvo com sucesso!';
            header("location: ./");
            exit;
        } catch (PDOException $ex) {
            echo $ex;
            exit;
            $_SESSION["tipo"] = 'error';
            $_SESSION["title"] = 'Ops!';
            $_SESSION["msg"] =  $ex->getMessage();
            header("location: ./");
            exit;
        }
    }
}

// if ($this->existeEmail($usuarios_email) == false) {
//     $sql = "INSERT INTO usuarios (usuarios_nome, usuarios_email, usuarios_senha, usuarios_permissoes, usuarios_imagem) VALUES (?, ?, ?, ?, ?)";
//     $sql = Conexao::getInstance()->prepare($sql);
//     $sql -> bindValue(1, $usuarios_nome);
//     $sql -> bindValue(2, $usuarios_email);
//     $sql -> bindValue(3, $usuarios_senha);
//     $sql -> bindValue(4, $usuarios_permissoes);
//     $sql -> bindValue(5, $usuarios_imagem);                                  
//     //$sql -> execute();
//             if($sql->execute()){
//                     $sql = "INSERT INTO colaboradores (colaboradores_usuarios_id, colaboradores_status) VALUES (LAST_INSERT_ID(), 1)";
//                     $sql = Conexao::getInstance()->prepare($sql);
//                     $sql -> execute();                                                                  
//             };
//                           return true;

// }else{
// return false;
// }           