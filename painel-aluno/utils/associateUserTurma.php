<?php
require_once '../../conexao.php';

// inicia seção
session_start();
// Recebe hash code da turma e associa ao usuário
$hash_code = $_POST['codigo_turma'];
$id_usuario = $_SESSION['id_usuario'];

// busca turma pelo hash code
$sql = "SELECT * FROM turmas WHERE tur_hash_code = '" . $hash_code. "';";
$query = $pdo->query($sql);
$turma = $query->fetch(PDO::FETCH_ASSOC);

// verifica se a turma existe
if ($turma) {

    $turma_id = $turma['tur_id_pk'];

    // Insere na tabela turma_usuario
    $sql = "INSERT INTO turma_usuario (tur_id_fk, usu_id_fk) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $turma_id);
    $stmt->bindValue(2, $id_usuario);
    $stmt->execute();

    // Redireciona para lista de turmas
    header('Location: ../');
}
else{
    echo "Turma não encontrada";
}
