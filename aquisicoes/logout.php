<?php

include('verificar-autenticidade.php');
//destruir qualquer sessaõ existente
session_start();
session_destroy();

header("location: ". caminhoURL2 ."login.php")



?>