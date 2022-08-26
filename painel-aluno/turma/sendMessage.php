<?php

require_once '../../conexao.php';

// printa tudo que foi enviado pelo formulario
print_r($_POST);
$id = $_POST['idRemetente'];
$idDestinatario = $_POST['idDestinatario'];
$mensagem = $_POST['mensagem'];


$sql = "INSERT INTO mensagens (id_usu_fk, id_usu_destinatario, mensagem) VALUES (
    '$id',
    '$idDestinatario',
    '$mensagem'
)";
$res = $pdo->query($sql);




// Fecha a pagina
echo '<script>window.close();</script>';
?>