<?php


// Verifica se o Aluno está em uma turma
function verifyClassroom($pdo, $id_aluno) {
    // Recupera dados de turma do banco de dados
    $sql = "SELECT * FROM turma_usuario WHERE usu_id_fk = $id_aluno";

    // Executa a query
    $query = $pdo->query($sql);

    // Verifica se o Aluno está em uma turma
    if($query->rowCount() > 0){
        return true;
    } else {
        return false;
    }
}
?>
