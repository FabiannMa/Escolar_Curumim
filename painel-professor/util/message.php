<?php

// conexao
require_once '../../conexao.php';

$messageText = $_POST['message'];

// verifica se a menagem esta vazia
if (empty($messageText)) {
    echo '<script>window.close()</script>';
    exit;
}

$idRemetente = $_POST['idProfessor'];
$idDestinatario = $_POST['idUsuario'];

print_r($_POST);


try{
$sql = "INSERT INTO mensagens (id_usu_fk, id_usu_destinatario, mensagem) VALUES (
        '$idRemetente',    
        '$idDestinatario',
        '$messageText'
    )";
$res = $pdo->query($sql);
echo '<script>window.close()</script>';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}