<?php

// Realiza a conexão com o banco de dados
require_once("../../../conexao.php");

// Recupera dados da Requisição POST
$topico = $_POST['topico'];
$turmas = $_POST['id_turma'];

// Verifica se os campos estão vazios
if($topico == "" || $turmas == ""){
    echo '<script> window.location.href = "../"; </script>';
}else{
    // Associa o tópico a turma
    $sql = "INSERT INTO turma_topicos (tur_id_fk, top_id_fk) VALUES ($turmas,  $topico)";
    echo $sql;
    $pdo->query($sql);

    $sqlh = "SELECT tur_hash_code FROM turmas WHERE tur_id_pk = $turmas";
    $resulth = $pdo->query($sqlh);
    $turmah = $resulth->fetch();
    $hash_code = $turmah['tur_hash_code'];
    // Redireciona para a página de listagem
    echo '<script> window.location.href = "../index.php?id_turma='.$hash_code.'"; </script>';
}

