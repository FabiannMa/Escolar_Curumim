<?php



// verifyClassroom($pdo, $id_aluno)
function verifyClassroom($pdo, $id_usuario) {
    $query = "SELECT * FROM turmas WHERE tur_id_professor =" . $id_usuario;
    $result = $pdo->query($query);
    $turmas = $result->fetchAll();
    if (count($turmas) > 0) {
        return true;
    } else {
        return false;
    }
}

function getClassrooms($pdo, $id_prof) {
    // Busca relação turma_topicos
    $sql = "SELECT * FROM turmas WHERE tur_id_professor =" . $id_prof;
    $query = $pdo->query($sql);

    // retorna a quantidade de topicos da turma
    return $query->fetchAll(PDO::FETCH_ASSOC);
}