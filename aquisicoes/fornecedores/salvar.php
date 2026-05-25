<?php

include("../verificar-autenticidade.php");
include("../conexao-pdo.php");
//verifica se está vindo informações via post
if ($_POST) {
    //verifica campos obrigatórios
    if (empty($_POST["nome"])) {
        $_SESSION["tipo"] = 'warning';
        $_SESSION["title"] = 'Ops!';
        $_SESSION["msg"] = 'Por favor, preencha os campos obrigatórios.';
        header("location: ./");
        exit;
    } else {
        $pk_fornecedores = trim($_POST["pk_fornecedores"]);
        $nome = trim($_POST["nome"]);
        $telefone = trim($_POST["telefone"]);
        $email = trim($_POST["email"]);
        $cnpj = trim($_POST["cnpj"]);
        $tipo_de_fornecimento = trim($_POST["tipo_de_fornecimento"]);
        try {
            if (empty($pk_fornecedores)) {
                $sql = "
             INSERT INTO fornecedores (nome, telefone, email, cnpj, tipo_de_fornecimento)
             VALUES(:nome, :telefone, :email, :cnpj, :tipo_de_fornecimento)
             ";
                $stmt = $coon->prepare($sql);
                $stmt->bindParam(':nome',$nome);
                $stmt->bindParam(':telefone',$telefone);
                $stmt->bindParam(':email',$email);
                $stmt->bindParam(':cnpj',$cnpj);
                $stmt->bindParam(':tipo_de_fornecimento',$tipo_de_fornecimento);
            } else {
                $sql = "
                UPDATE fornecedores SET nome =:nome, telefone =:telefone, email =:email, cnpj =:cnpj, tipo_de_fornecimento =:tipo_de_fornecimento
                WHERE pk_fornecedores = :pk_fornecedores
                ";
                $stmt = $coon->prepare($sql);
                $stmt->bindParam(':pk_fornecedores',$pk_fornecedores);
                $stmt->bindParam(':nome',$nome);
                $stmt->bindParam(':telefone',$telefone);
                $stmt->bindParam(':email',$email);
                $stmt->bindParam(':cnpj',$cnpj);
                $stmt->bindParam(':tipo_de_fornecimento',$tipo_de_fornecimento);
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