<?php
// Conexão com o banco de dados
require_once("../conexao.php");



// Recupera id do conteúdo método GET url
$id = $_GET['id'];

// Recupera informações do conteúdo
$sql = "SELECT * FROM postagens WHERE pos_id_pk = $id";
$query = $pdo->query($sql);
$dados = $query->fetch(PDO::FETCH_ASSOC);

echo "<div class='container'>";
echo "<div class='row'>";
echo "<div class='col-md-12'>";
echo "<h1>".$dados['pos_titulo']."</h1>";
echo "<p>".$dados['pos_texto']."</p>";
echo "</div>";
echo "</div>";
echo "</div>";





?>
