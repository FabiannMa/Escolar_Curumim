<?php

// importa classe turma 
require_once '../../Classes/turma.php';
require_once '../../conexao.php';
// Instancia a classe
$turma = new Turma($_GET['nome'], $_GET['status'], "default", "temp");

// Verifica se o nome da turma já existe
$sql = "SELECT * FROM turmas WHERE tur_name = '$turma->nome'";
$result = $pdo->query($sql);
$turmaExiste = $result->fetchAll();

// Se o nome da turma já existe adiciona o numero do ano ao nome da turma
if (count($turmaExiste) > 0) {
    $turma->nome = $turma->nome . " " . date("Y");
    // Verifica se o nome da turma já existe
    $result = $pdo->query($sql);
    $turmaExiste = $result->fetchAll();

    // Se o nome da turma já existe adiciona o numero do mês ao nome da turma
    if (count($turmaExiste) > 0) {
        $turma->nome = $turma->nome . " " . date("m");
        // Verifica se o nome da turma já existe
        $result = $pdo->query($sql);
        $turmaExiste = $result->fetchAll();

        // Se o nome da turma já existe adiciona o numero do dia ao nome da turma
        if (count($turmaExiste) > 0) {
            $turma->nome = $turma->nome . " " . date("d");

            // Verifica se o nome da turma já existe
            $result = $pdo->query($sql);
            $turmaExiste = $result->fetchAll();

            // Se o nome da turma já existe adiciona o numero do horário ao nome da turma
            if (count($turmaExiste) > 0) {
                $turma->nome = $turma->nome . " " . date("H");
                // Verifica se o nome da turma já existe
                $result = $pdo->query($sql);
                $turmaExiste = $result->fetchAll();

                // Se o nome da turma já existe adiciona o numero do minuto ao nome da turma
                if (count($turmaExiste) > 0) {
                    $turma->nome = $turma->nome . " " . date("i");
                    // Verifica se o nome da turma já existe
                    $result = $pdo->query($sql);
                    $turmaExiste = $result->fetchAll();

                    // Se o nome da turma já existe adiciona o numero do segundo ao nome da turma
                    if (count($turmaExiste) > 0) {
                        $turma->nome = $turma->nome . " " . date("s");
                    }
                }
            }
        }
    }
}


// Salva no banco de dados
$sql = "INSERT INTO turmas (tur_name, tur_status, tur_imagem, tur_hash_code) VALUES ('$turma->nome', '$turma->status', '$turma->imagem', '$turma->hash_code')";
$pdo->query($sql);

// Recupera o ID da turma cadastrada
$sql = "SELECT * FROM turmas WHERE tur_name = '$turma->nome'";
$query = $pdo->query($sql);
$row = $query->fetch(PDO::FETCH_ASSOC);
$id_turma = $row['tur_id_pk'];

$hash = $turma->generateHashCode($id_turma);


// Atualiza o hash code da turma
$sql = "UPDATE turmas SET tur_hash_code = '$hash' WHERE tur_id_pk = $id_turma";
$pdo->query($sql);  

// Redireciona para a página de listagem
echo "<script> window.location.href = '../'; </script>";
