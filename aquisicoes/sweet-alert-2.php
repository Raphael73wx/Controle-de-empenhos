<?php

@session_start();

// ISSET = VERIFICA SE AS VARIÁVEIS FORAM CRIADAS 
if (isset($_SESSION["tipo"]) && isset($_SESSION["title"]) && isset($_SESSION["msg"])) {
    echo "
    <script>
    $(function(){
       var Toast = Swal.mixin({
            toast: false,
            position:'center',
            showConfirmButton: false,
            timer: 10000
       });
       Toast.fire({
        icon: '".$_SESSION["tipo"]."',
        title: '".$_SESSION["title"]."',
        text: '".$_SESSION["msg"]."'
       });
    
    
    });
    </script>
    ";
   //APOS EXIBIR A MENSAGEM, LIMPA AS VARIAVEIS DE SESSÃO
   unset($_SESSION["tipo"]);
   unset($_SESSION["title"]);
   unset($_SESSION["msg"]);




}
?>