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

// Verificar se o aluno respondeu todas as questões
if ($total == count($QuestoesArray)) {
    echo "Respondeu todas as questões<br>";
} else {
    echo "Não respondeu todas as questões<br>";

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

    if ($resposta == $respostaArray) {
        $pontos += $pontosPorQuestao;
        echo "Acertou - ". $idQuestao . " - " . $respostaArray . "<br>";
    }
    else {
        echo "Errou -  ". $idQuestao . " - " . $respostaArray ." - " ."Resposta esperada: ". $resposta . "<br>";
    }
}

echo "Nota: " . $pontos. "/10";
