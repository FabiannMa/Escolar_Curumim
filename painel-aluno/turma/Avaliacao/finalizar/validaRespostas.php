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

if ($pontos >=6){
    $status = 1;
}else{
    $status = 0;
}

// Cadastra a nota no banco de dados
$sql = "INSERT INTO prova_usuario (pro_id_fk, usu_id_fk, pro_usu_status, pro_usu_nota ) VALUES ($idAluno, $idProva, $status, $pontos)";
$pdo->query($sql);

// Muda status da postagem para finalizada
$sql = "SELECT * FROM prova_postagem WHERE pro_id_fk = $idProva";
$postagem = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$postagem = $postagem[0]['pos_id_fk'];

if ($status == 1) {
    $statusUso = 2;
}else{
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

 echo "<script language='javascript'> window.location='../../../../painel-aluno' </script>";
?>
