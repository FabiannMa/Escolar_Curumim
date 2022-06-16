<?php

require_once('../../../conexao.php');

// Recupera id do topico
$id = $_GET['id'];
$tur_id = $_GET['tur_id'];
// Deleta topico
$sql = "DELETE FROM topicos WHERE top_id_pk = $id";
$result = $pdo->query($sql);

$sqlh = "SELECT tur_hash_code FROM turmas WHERE tur_id_pk = $tur_id";
    $resulth = $pdo->query($sqlh);
    $turmah = $resulth->fetch();
    $hash_code = $turmah['tur_hash_code'];

// Redireciona para a página de topicos
echo '<script> window.location.href = "../index.php?id_turma='.$hash_code.'"; </script>';
