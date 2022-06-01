<?php

// Inicia Sessão
session_start();

// Verifica se o usuário está logado
if(!isset($_SESSION['id_usuario'])){
    header("Location: ../");
    // Destroi a sessão por segurança
    session_destroy();
}

// Verifica se o usuário é aluno 
if($_SESSION['nivel_usuario'] != 'aluno'){
    header("Location: ../");
    // Destroi a sessão por segurança
    session_destroy();
}

?>
