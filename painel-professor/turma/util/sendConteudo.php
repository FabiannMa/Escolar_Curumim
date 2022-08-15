<?php
require_once("../../../conexao.php");
@session_start();
// Recupera dados da Requisição POST
$topico = $_POST['top'];
$conteudo = $_POST['content'];
$title = $_POST['title'];

$preRequisito = $_POST['pre'];


$status = "1";
// Verifica se os campos estão vazios
if ($topico == "" || $conteudo == "") {
    echo "<script> window.location.href = '../'; </script>";
}

if ($preRequisito == "" || $preRequisito == "0") {
    $sql = "INSERT INTO postagens (pos_titulo, pos_texto, top_id_fk, pos_status, pos_imagem) VALUES ('$title', '$conteudo', '$topico', '$status', 'default.png')";
    $status = "1";
} else {
    $sql = "INSERT INTO postagens (pos_titulo, pos_texto, top_id_fk, pos_status, pos_imagem, pos_requisito_fk) VALUES ('$title', '$conteudo', '$topico', '$status', 'default.png', '$preRequisito')";
}
$pdo->query($sql);
$idDaPostagem = $pdo->lastInsertId();

// Recupera todos os usuários da turma
$sql = "SELECT * FROM turma_usuario WHERE tur_id_fk = $topico";
$query = $pdo->query($sql);
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
    $sql = "INSERT INTO postagem_usuario (pos_id_fk, usu_id_fk, pos_usu_status) VALUES ($idDaPostagem, $usuario[usu_id_fk], '$status')";
    $pdo->query($sql);
}


// Cadastra a prova do conteudo
$pro_name = $_POST['title'];
$pro_status = "1";
$pro_id_professor = $_SESSION['id_usuario'];
$pro_id_turma = $_GET['id_turma'];

$sql = "SELECT tur_id_pk FROM turmas WHERE tur_hash_code = '$pro_id_turma'";
$query = $pdo->query($sql);
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$tur_id = $res[0]['tur_id_pk'];


$sql = "INSERT INTO provas (pro_name, pro_status, pro_id_professor, pro_id_turma, pro_imagem) VALUES ('$pro_name', '$pro_status', '$pro_id_professor', '$tur_id', 'default.png')";
$pdo->query($sql);

// Relaciona a prova com o conteudo
$sql = 'SELECT * FROM provas WHERE pro_name = "' . $pro_name . '"';
$res = $pdo->query($sql)->fetch();
$prova_id = $res['pro_id_pk'];

$sql = 'SELECT pos_id_pk FROM postagens WHERE pos_titulo = "' . $title . '"';
$conteudoId = $pdo->query($sql)->fetch();
$conteudoId = $conteudoId['pos_id_pk'];

$sql = "INSERT INTO prova_postagem (pro_id_fk, pos_id_fk) VALUES ('$prova_id', '$conteudoId')";
$pdo->query($sql);

// Relaciona questões com a prova
$questoesSelecionadas = $_POST['questoes'];
foreach ($questoesSelecionadas as $questao) {
    $sql = "INSERT INTO prova_questao (pro_id_fk, que_id_fk) VALUES ('$prova_id', '$questao')";
    $pdo->query($sql);
}


// Seta postagem_usuario como 1 para o usuário logado


// Redireciona para a página de listagem
echo "<script> window.location.href = '../'; </script>";
