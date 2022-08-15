<?php
require_once '../../conexao.php';

// inicia seção
session_start();
// Recebe hash code da turma e associa ao usuário
$hash_code = $_POST['codigo_turma'];
$id_usuario = $_SESSION['id_usuario'];

// busca turma pelo hash code
$sql = "SELECT * FROM turmas WHERE tur_hash_code = '" . $hash_code . "';";
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

    // Log de ação
    $sql = "INSERT INTO log_personalizado(usu_id_fk, log, log_status) VALUES 
        ($id_usuario, 'Juntou-se à turma.', 'Turmas')";
    $pdo->query($sql);
    




    // Insere na tabela usuario_postagem todas as postagens da turma
    $sql = "SELECT * FROM turma_topicos WHERE tur_id_fk = $turma_id";
    $query = $pdo->query($sql);
    $topicos = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($topicos as $topico) {
        $sql = "SELECT * FROM postagens WHERE top_id_fk = $topico[top_id_fk]";
        $query = $pdo->query($sql);
        $postagens = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($postagens as $postagem) {
            $status = 0;
            if ($postagem['pos_requisito_fk'] == null){
                $status = 1;
            }
            $sql2 = "INSERT INTO postagem_usuario (pos_id_fk, usu_id_fk, pos_usu_status) 
                                VALUES ($postagem[pos_id_pk], $id_usuario, $status)";
            $query2 = $pdo->query($sql2);
        }
    }


    // Redireciona para lista de turmas
    header('Location: ../');
}
