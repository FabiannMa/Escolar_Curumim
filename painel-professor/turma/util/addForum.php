<?php

require_once("../../../conexao.php");


$message = $_POST['message'];
$tur_id_fk = $_POST['tur_id_fk'];
$profile_pic = $_POST['profile_pic'];
$nome = $_POST['nome'];
$id_turma = $_POST['id_turma'];

$sql = "INSERT INTO forum_message (profile_pic, name, message, tur_id_fk) VALUES ('$profile_pic', '$nome', '$message', '$tur_id_fk')";
$pdo->query($sql);

echo '<script> window.location.href = "../?id_turma='.$id_turma.'"; </script>';

