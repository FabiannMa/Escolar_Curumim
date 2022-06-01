<?php
require_once("../../conexao.php");
// Recupera dados da Requisição POST
$topico = $_POST['top'];
$conteudo = $_POST['content'];
$title = $_POST['title'];

// Verifica se os campos estão vazios
if($topico == "" || $conteudo == ""){
    echo "<script> window.location.href = '../'; </script>";
}

// Envia dados da postagem para o banco
$sql = "INSERT INTO postagens (pos_titulo, pos_texto, top_id_fk, pos_status, pos_imagem) VALUES ('$title', '$conteudo', '$topico', 1, 'default.png')";
$pdo->query($sql);

// Redireciona para a página de listagem
echo "<script> window.location.href = '../'; </script>";




?>