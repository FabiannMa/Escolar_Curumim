<?php
session_start();
require_once '../../../../conexao.php';

$idProva = $_POST['idProva'];
$idAluno = $_SESSION['id_usuario'];
$Questoes = $_POST['respostas'];
$total = $_POST['totalDeQuestoes'];

$QuestoesArray = explode(";", $Questoes);

// Visualizar as questões
foreach ($QuestoesArray as $key => $value) {
    // Remove se o valor for vazio
    if (empty($value)) {
        unset($QuestoesArray[$key]);
    }
}


$pontosPorQuestao = 10 / $total;
$pontos = 0;

foreach ($QuestoesArray as $questao) {
    // Verificar se a questão foi respondida
    $id = explode(",", $questao);
    $idQuestao = $id[1];
    $respostaArray = $id[0];

    $sql = "SELECT * FROM questoes WHERE que_id_pk = $idQuestao";
    $resposta = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $resposta = $resposta[0]['que_resposta'];

    // Recupera palavra-chave da questão 
    $sql = "SELECT pal_texto FROM palavras_chave WHERE pal_id_pk in (SELECT que_keyword_id_fk FROM questoes WHERE que_id_pk = $idQuestao)";

    $palavraChave = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $palavraChave = $palavraChave[0]['pal_texto'];
    echo '<script> alert("' . $palavraChave . '") </script>';

    if ($resposta == $respostaArray) {
        $pontos += $pontosPorQuestao;

        $sql = "INSERT INTO log_personalizado(usu_id_fk, log, log_status) VALUES ($idAluno, 
        'Acertou a questão sobre $palavraChave', 'Provas')";
        $pdo->query($sql);
    } else {
        $sql = "INSERT INTO log_personalizado(usu_id_fk, log, log_status) VALUES ($idAluno, 
        'Errou questão sobre $palavraChave', 'Provas')";
        $pdo->query($sql);
    }
}
// Muda status da postagem para finalizada
$sql = "SELECT * FROM prova_postagem WHERE pro_id_fk = $idProva";
$res = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$postagem = $res[0]['pos_id_fk'];
$nomePostagem = $res[0]['pos_titulo'];


if ($pontos >= 6) {
    $status = 1;
    $sql = "INSERT INTO log_personalizado(usu_id_fk, log, log_status) VALUES ($idAluno, 'Foi aprovado na prova de " . $nomePostagem . " com nota: $pontos', 'Provas')";
    $pdo->query($sql);
} else {
    $status = 0;
    $sql = "INSERT INTO log_personalizado(usu_id_fk, log, log_status) VALUES ($idAluno, 'Fez uma tentativa e não foi aprovado na prova de " . $nomePostagem . " com nota: $pontos', 'Provas')";
    $pdo->query($sql);
}

// Cadastra a nota no banco de dados
$sql = "INSERT INTO prova_usuario (pro_id_fk, usu_id_fk, pro_usu_status, pro_usu_nota ) VALUES ($idAluno, $idProva, $status, $pontos)";
$pdo->query($sql);


if ($status == 1) {
    $statusUso = 2;
} else {
    $statusUso = 1;
}
// Muda status da postagem para finalizada
$sql = "UPDATE postagem_usuario SET pos_usu_status = $statusUso WHERE pos_id_fk = $postagem";
$pdo->query($sql);

if ($status == 1) {
    // Libera o próximo conteúdo
    $sql = "SELECT * FROM postagens WHERE pos_requisito_fk = $postagem";
    $proximoConteudo = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    foreach ($proximoConteudo as $key => $value) {
        $id = $value['pos_id_pk'];
        $sql = "UPDATE postagem_usuario SET pos_usu_status = 1 WHERE pos_id_fk = $id";
        $pdo->query($sql);
    }
}


// Verificar se o aluno respondeu todas as questões
if ($total == count($QuestoesArray)) {
    // Log de ação
    $sql = "INSERT INTO log_personalizado(usu_id_fk, log, log_status) VALUES ($idAluno, 'Respondeu por completo a prova de " . $nomePostagem . "', 'Provas')";
    $pdo->query($sql);
} else {
    echo "Não respondeu todas as questões<br>";
    $sql = "INSERT INTO log_personalizado(usu_id_fk, log, log_status) VALUES ($idAluno, 'Não respondeu completamente a prova de " . $nomePostagem . "', 'Provas')";
    $pdo->query($sql);
}

echo "<script language='javascript'> window.location='../../../../painel-aluno' </script>";
