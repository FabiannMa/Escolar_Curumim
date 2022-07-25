<?php
require_once("../../../conexao.php");
// Recupera dados da Requisição POST
$content = $_POST['content'];
$altA = $_POST['altA'];
$altB = $_POST['altB'];
$altC = $_POST['altC'];
$altD = $_POST['altD'];
$correta = $_POST['correta'];
$peso = $_POST['peso'];
$keywords = $_POST['keywords'];

//Valida se os campos estão vazios
if($content == "" || $altA == "" || $altB == "" || $altC == "" || $altD == "" || $correta == "" || $peso == "" || $keywords == ""){
    echo "<script> window.location.href = '../'; </script>";
}
// Cadastrar questão
$sql = "INSERT INTO questoes (que_texto, que_alternativa_a, que_alternativa_b, que_alternativa_c, que_alternativa_d, que_resposta, que_peso, que_keyword_id_fk) VALUES ('$content', '$altA', '$altB', '$altC', '$altD', '$correta', '$peso', '$keywords')";
$result = $pdo->query($sql);

echo "<script> window.location.href = '../'; </script>";

?>