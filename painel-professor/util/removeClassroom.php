<?php 

// Recupera a conexão
require_once('../../conexao.php');

// Recupera id da classe
$id = $_GET['id'];

// Deleta classe
$sql = "DELETE FROM turmas WHERE tur_id_pk = $id";
$result = $pdo->query($sql);

// Redireciona para a página de classes
header('Location: ../');

