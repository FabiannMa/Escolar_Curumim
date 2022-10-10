<?php
session_start();
require_once '../../../../conexao.php';


$id_aluno = $_SESSION['id_usuario'];

$sql = "SELECT * FROM usuarios WHERE id = $id_aluno";
$aluno = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
$id_turma = $_GET['id_turma'];


$questoes = array();
$respostas_form = array();
foreach ($_POST as $key => $value) {
    $id_questao = explode("alternativa", $key)[1];
    $questoes[] = $id_questao;
    $respostas_form[] = $value;
}

$total_questoes = count($questoes);
$acertos = 0;
$erros = 0;
$basico = 0;
$intermediario = 0;
$avancado = 0;
$questoes_corretas = array();
$questoes_erradas = array();
$pontos_por_topico = array();
// Verifica se a resposta está correta
for( $i = 0; $i < $total_questoes; $i++ ) {
    $id_questao = $questoes[$i];
    $resposta_form = $respostas_form[$i];

    $sql = "SELECT que_resposta, que_peso, que_keyword_id_fk FROM questoes WHERE que_id_pk = $id_questao";
    $result = $pdo->query($sql);
    $questao = $result->fetch(PDO::FETCH_ASSOC);

    $resposta_correta = $questao['que_resposta'];

    if( $resposta_form == $resposta_correta ) {
        $acertos++;
        $topico = strval($questao['que_keyword_id_fk']) . "topico";
        if ($questao['que_peso'] == "Básico") {
            if (isset($pontos_por_topico[$topico])) {
                $pontos_por_topico[$topico] += 1.8;
            } else {
                $pontos_por_topico[$topico] = 1.8;
            }
            $basico++;
        } else if ($questao['que_peso'] == "Intermediário") {
            if (isset($pontos_por_topico[$topico])) {
                $pontos_por_topico[$topico] += 2.5;
            } else {
                $pontos_por_topico[$topico] = 2.5;
            }
            $intermediario++;
        } else if ($questao['que_peso'] == "Avançado") {
            if (isset($pontos_por_topico[$topico])) {
                $pontos_por_topico[$topico] += 4.5;
            } else {
                $pontos_por_topico[$topico] = 4.5;
            }
            $avancado++;
        }
        $questoes_corretas[] = $id_questao;

    } else {
        $erros++;
        $questoes_erradas[] = $id_questao;
    }
}

// Calcula a porcentagem de acertos
$porcentagem_acertos = ($acertos / $total_questoes) * 100;

// Calcula pontos por nível
$pontos_basico = $basico * 1.8;
$pontos_intermediario = $intermediario * 2.5;
$pontos_avancado = $avancado * 4.5;

// Calcula a pontuação total
$pontuacao_total = $pontos_basico + $pontos_intermediario + $pontos_avancado;

// Insere o resultado no banco de dados
$sql = "INSERT INTO log_personalizado(usu_id_fk, log, log_status) VALUES ($id_aluno, 'Completou o nivelamento', 'Nivelamento');"
. "INSERT INTO log_personalizado(usu_id_fk, log, log_status) VALUES ($id_aluno, 'Obteve a pontuação inicial de: $pontuacao_total', 'Nivelamento');"
. "INSERT INTO log_personalizado(usu_id_fk, log, log_status) VALUES ($id_aluno, 'Obteve a porcentagem de acertos de: $porcentagem_acertos', 'Nivelamento');"
. "INSERT INTO log_personalizado(usu_id_fk, log, log_status) VALUES ($id_aluno, 'Obteve a pontuação por nível de: Básico: $pontos_basico, Intermediário: $pontos_intermediario, Avançado: $pontos_avancado', 'Nivelamento')"
. "UPDATE turma_usuario SET first_access = 0 WHERE tur_id_fk = $id_turma AND usu_id_fk = $id_aluno";



$pdo->query($sql);

foreach ($pontos_por_topico as $key => $value) {
    $topico_id = explode("topico", $key)[0];
    $sql = "SELECT * FROM palavras_chave WHERE pal_id_pk = $topico_id";
    $topico = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $sql = "INSERT INTO log_personalizado(usu_id_fk, log, log_status) VALUES ($id_aluno, 'Obteve a pontuação por tópico de: $topico[pal_texto]: $value', 'Nivelamento')";
    $pdo->query($sql);
    $sql = "INSERT INTO desempenho_por_topico (id_usuario, id_topico, pontuacao) VALUES ($id_aluno, $topico_id, $value)";
    $pdo->query($sql);

}

// Redireciona para a página de resultados
$url = $_SERVER['HTTP_REFERER'];
$params = explode("?", $url)[1];
$params = explode("_turma", $params);
$params = $params[0] . $params[1];;   


header("Location: ../../?$params");

?>