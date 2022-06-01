<?php
class InitDatabase {
    // Cria banco de dados
    public static function createDatabase($pdo, $dbname) {
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        $pdo->query($sql);
    }

    // Cria a tabela de usuarios
    public function createTableUsuarios($pdo) {
        $sql = "CREATE TABLE IF NOT EXISTS usuarios (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(30) NOT NULL,
            email VARCHAR(50) NOT NULL,
            senha VARCHAR(50) NOT NULL,
            cpf VARCHAR(11) NOT NULL,
            nivel VARCHAR(30) NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);        
    }
    
    // Cria a tabela de tópicos
    public function createTableTopicos($pdo) {
        $sql = "CREATE TABLE IF NOT EXISTS topicos (
            top_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            top_name VARCHAR(30) NOT NULL,
            top_status int NOT NULL,
            top_imagem VARCHAR(50) NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);        
    }

    // Cria tabela de turmas 
    public function createTableTurmas($pdo) {
        $sql = "CREATE TABLE IF NOT EXISTS turmas (
            tur_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            tur_name VARCHAR(30) NOT NULL,
            tur_status int NOT NULL,
            tur_imagem VARCHAR(50) NOT NULL,
            tur_hash_code VARCHAR(6) NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);        
    }

    // Cria relação turma e tópico
    public function createTableTurmaTopicos($pdo) {
        $sql = "CREATE TABLE IF NOT EXISTS turma_topicos (
            tur_top_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            tur_id_fk INT(6) UNSIGNED NOT NULL,
            top_id_fk INT(6) UNSIGNED NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);        
    }

    // Cria tabela de postagens
    public function createTablePostagens($pdo) {
        $sql = "CREATE TABLE IF NOT EXISTS postagens (
            pos_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            pos_titulo VARCHAR(30) NOT NULL,
            pos_texto TEXT,
            pos_status int NOT NULL,
            pos_imagem VARCHAR(50) NOT NULL,
            pos_data TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            top_id_fk INT(6)
        )";
        $pdo->query($sql);        
    }

    // Criar tabela de Turma e Usuário
    public function createTableTurmaUsuario($pdo) {
        $sql = "CREATE TABLE IF NOT EXISTS turma_usuario (
            tur_usu_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            tur_id_fk INT(6) UNSIGNED NOT NULL,
            usu_id_fk INT(6) UNSIGNED NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);        
    }

    



    // Contrutor
    public function __construct($pdoClass) {
        // Executa todas as funções
        $this->createDatabase($pdoClass, 'curumim');
        //escreve no console 
        echo "<script language='javascript'> console.log('Banco de dados criado com sucesso!') </script>";
        $this->createTableTopicos($pdoClass);
        echo "<script language='javascript'> console.log('Tabela de tópicos criada com sucesso!') </script>";
        $this->createTableUsuarios($pdoClass);
        echo "<script language='javascript'> console.log('Tabela de usuários criada com sucesso!') </script>";
        $this->createTableTurmas($pdoClass);
        echo "<script language='javascript'> console.log('Tabela de turmas criada com sucesso!') </script>";
        $this->createTableTurmaTopicos($pdoClass);
        echo "<script language='javascript'> console.log('Tabela de turma_topicos criada com sucesso!') </script>";
        $this->createTablePostagens($pdoClass);
        echo "<script language='javascript'> console.log('Tabela de postagens criada com sucesso!') </script>";
        $this->createTableTurmaUsuario($pdoClass);
        echo "<script language='javascript'> console.log('Tabela de turma_usuario criada com sucesso!') </script>";

    }
}