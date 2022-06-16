<?php

// Receber dados da Imagem 
$file = $_FILES['image'];

// Informando diretorio de upload
$dir = '../../../img/conteudos/';

// Receber nome do arquivo
$filename = $file['name'];

// Receber extensão do arquivo
$extensao = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

// Gerar nome do arquivo
$novoNome = uniqid() . '.' . $extensao;

// Receber dados do arquivo
$arquivo = $file['tmp_name'];

// Renomear arquivo
$arquivoRenomeado = $dir . $novoNome;

// Move arquivo para o diretorio
move_uploaded_file($arquivo, $arquivoRenomeado);


$return['success'] = true;
$return['file'] = "http://localhost/curumin/Escolar_curumim/img/conteudos/" . $novoNome;

echo json_encode($return);

?>