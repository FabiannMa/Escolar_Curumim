<?php
require_once("../../../conexao.php");
// Recupera dados da Requisição POST
$topico = $_POST['topico'];
$turma = $_POST['turmas'];


// Verifica se os campos estão vazios
if ($topico == "" || $turma == "") {
    // Redireciona para anterior
    echo '<script> window.location.href = "../"; </script>';
} else {
    // Coleta hashcode da turma
    $sqlh = "SELECT tur_hash_code FROM turmas WHERE tur_id_pk = $turma";
    $resulth = $pdo->query($sqlh);
    $turmah = $resulth->fetch();
    $hash_code = $turmah['tur_hash_code'];

    // Envia dados para o banco
    $sql = "INSERT INTO topicos (top_name, top_status, top_imagem) VALUES ('$topico', 1, 'default.png')";
    $pdo->query($sql);

    // Associa o tópico a turma
    $sql = "INSERT INTO turma_topicos (tur_id_fk, top_id_fk) VALUES ('$turma', (SELECT top_id_pk FROM topicos WHERE top_name = '$topico'))";
    $pdo->query($sql);


    // Redireciona para a página de listagem
    echo '<script> window.location.href = "../index.php?id_turma='.$hash_code.'"; </script>';
}
