<?php
require_once("../../../conexao.php");
// Recupera dados da Requisição POST
$topico = $_POST['top'];
$conteudo = $_POST['content'];
$title = $_POST['title'];
$preRequisito = $_POST['pre'];
$status = "2";
// Verifica se os campos estão vazios
if($topico == "" || $conteudo == ""){
    echo "<script> window.location.href = '../'; </script>";
}

if ($preRequisito == "0") {
    $preRequisito = null;
    $status = "1";
}


$sql = "INSERT INTO postagens (pos_titulo, pos_texto, top_id_fk, pos_status, pos_imagem, pos_requisito_fk) VALUES ('$title', '$conteudo', '$topico', '$status', 'default.png', '$preRequisito')";
$pdo->query($sql);

// Redireciona para a página de listagem
echo "<script> window.location.href = '../'; </script>";




?>