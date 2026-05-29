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
        $pk_empenhos = trim($_POST["pk_empenhos"]);
        $nome = trim($_POST["nome"]);
        $setor = trim($_POST["setor"]);
        $preco = trim($_POST["preco"]);
        $cnpj = trim($_POST["cnpj"]);
        $data_de_envio = trim($_POST["data_de_envio"]);
        $nota_fiscal_num = trim($_POST["nota_fisca_num"]);
        $financeiro_num = trim($_POST["financeiro_num"]);
        $ordem_bancaria = trim($_POST["ordem_bancaria"]);
        $valor_de_entrega = trim($_POST["valor_de_entrega"]);
        $notificacoes_atraso = trim($_POST["notificacoes_atraso"]);
        $qtd = trim($_POST["qtd"]);
        $ordem_bancaria_num = trim($_POST["ordem_bancaria_num"]);
        $financeiro = trim($_POST["financeiro"]);
        $nota_fiscal = trim($_POST["nota_fiscal"]);
        $requisicao_num = trim($_POST["requisicao_num"]);
        $envio_emp = trim($_POST["envio_emp"]);
        $codigo_empenho = trim($_POST["codigo_empenho"]);
        $conclusao_emp = trim($_POST["conclusao_emp"]);
        try {
            if (empty($pk_empenhos)) {
                $sql = "
             INSERT INTO empenhos (nome,setor,cnpj,data_de_envio,nota_fiscal_num,financeiro_num)
             VALUES(:nome,:setor,:cnpj,:data_de_envio,nota_fiscal_num,:financeiro_num)
             ";
                $stmt = $coon->prepare($sql);
                $stmt->bindParam(':nome',$nome);
                $stmt->bindParam(':forma_p',$setor);
                $stmt->bindParam(':cnpj',$cnpj);
                $stmt->bindParam(':data_de_envio',$data_de_envio);
                $stmt->bindParam(':nota_fiscal_num',$nota_fiscal_num);
                $stmt->bindParam(':financeiro_num',$financeiro_num);
                $stmt->bindParam(':financeiro_num',$financeiro_num);
                $stmt->bindParam(':financeiro_num',$financeiro_num);
                $stmt->bindParam(':financeiro_num',$financeiro_num);
            } else {
                $sql = "
                UPDATE empenhos SET nome =:nome, setor =:setor, cnpj =:cnpj,data_de_envio =:data_de_envio,nota_fiscal_num =:nota_fiscal_num,financeiro_num=:financeiro_num,
                WHERE pk_empenhos = :pk_empenhos
                ";
                $stmt = $coon->prepare($sql);
                $stmt->bindParam(':pk_empenhos',$pk_empenhos);
                $stmt->bindParam(':nome',$nome);
                $stmt->bindParam(':setor',$setor);
                $stmt->bindParam(':cnpj',$cnpj);
                $stmt->bindParam(':data_de_envio',$data_de_envio);
                $stmt->bindParam(':nota_fiscal_num',$nota_fiscal_num);
                $stmt->bindParam(':financeiro_num',$financeiro_num);
                $stmt->bindParam(':data_de_envio',$data_de_envio);
                $stmt->bindParam(':data_de_envio',$data_de_envio);
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