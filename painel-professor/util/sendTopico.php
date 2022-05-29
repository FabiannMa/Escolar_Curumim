<?php
require_once("../../conexao.php");
// Recupera dados da Requisição POST
$topico = $_POST['topico'];

// Verifica se os campos estão vazios
if($topico == ""){
    echo '<script> window.location.href = "../"; </script>';
}

// Envia dados para o banco
$sql = "INSERT INTO topicos (top_name, top_status, top_imagem) VALUES ('$topico', 1, 'default.png')";
$pdo->query($sql);

// Redireciona para a página de listagem
echo '<script> window.location.href = "../"; </script>';

?>