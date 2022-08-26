<?php

require_once '../conexao.php';

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$nome = $nome . ' ' . $sobrenome;
$senha = md5($senha);

$cpf = $_POST['cpf'];

// Salva a imagem no servidor
if (isset($_FILES['fotosend'])) {
    $extensao = strtolower(substr($_FILES['fotosend']['name'], -4));
    $novo_nome = md5(time()) . $extensao;
    $diretorio = "../img/profilepics/";
    move_uploaded_file($_FILES['fotosend']['tmp_name'], $diretorio . $novo_nome);
}

// Cadastra no banco de dados
try{
    $sql = "INSERT INTO usuarios (nome, email, senha, cpf, foto, nivel) VALUES ('$nome', '$email', '$senha', '$cpf', '$novo_nome', 'professor')";
    $result = $pdo->query($sql);
}catch(PDOException $e){
    $erro = $e->getMessage();
    echo "Erro: " . $e->getMessage();
}


if ($result){
    header('Location: ../index.php');
}else{
    header('Location: ../?erro=1&msg='.$erro);
}





?>