<?php
class InitDatabase
{
    // Cria banco de dados
    public static function createDatabase($pdo, $dbname)
    {
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        $pdo->query($sql);
    }

    // Cria a tabela de usuarios
    public function createTableUsuarios($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS usuarios (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(30) NOT NULL,
            email VARCHAR(50) NOT NULL,
            senha VARCHAR(50) NOT NULL,
            cpf VARCHAR(11) NOT NULL,
            nivel VARCHAR(30) NOT NULL,
            foto VARCHAR(80),
            pontuacao DOUBLE(10,2) DEFAULT 0,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);
    }

    // Cria a tabela de tópicos
    public function createTableTopicos($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS topicos (
            top_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            top_name VARCHAR(30) NOT NULL,
            top_status int NOT NULL,
            top_imagem VARCHAR(50) NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
        $pdo->query($sql);
    }

    public function createDesempenhoPorTopico ($pdo) {
        $sql = "CREATE TABLE IF NOT EXISTS desempenho_por_topico (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            id_usuario INT(6) NOT NULL,
            id_topico INT(6) NOT NULL,
            pontuacao INT(6) NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
        $pdo->query($sql);
    }

    // Cria tabela de turmas 
    public function createTableTurmas($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS turmas (
            tur_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            tur_name VARCHAR(30) NOT NULL,
            tur_status int NOT NULL,
            tur_imagem VARCHAR(50) NOT NULL,
            tur_hash_code VARCHAR(6) NOT NULL,
            tur_id_professor INT(6) NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);
    }

    // Cria relação turma e tópico
    public function createTableTurmaTopicos($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS turma_topicos (
            tur_top_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            tur_id_fk INT(6) UNSIGNED NOT NULL,
            top_id_fk INT(6) UNSIGNED NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);
    }

    // Cria tabela de postagens
    public function createTablePostagens($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS postagens (
            pos_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            pos_titulo VARCHAR(30) NOT NULL,
            pos_texto LONGTEXT,
            pos_status int NOT NULL,
            pos_imagem VARCHAR(50) NOT NULL,
            pos_data TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            top_id_fk INT(6),
            pos_requisito_fk INT(6) 

        )";
        $pdo->query($sql);
    }

    // Criar tabela de Turma e Usuário
    public function createTableTurmaUsuario($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS turma_usuario (
            tur_usu_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            tur_id_fk INT(6),
            usu_id_fk INT(6),
            first_access int DEFAULT 1,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);
    }

    // Criar tabela de Postagem e Usuário
    public function createTablePostagemUsuario($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS postagem_usuario (
            pos_usu_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            pos_id_fk INT(6) UNSIGNED NOT NULL,
            usu_id_fk INT(6) UNSIGNED NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            pos_usu_status INT(1) NOT NULL,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);
    }

    // Cria tabela de provas
    public function createTableProvas($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS provas (
            pro_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            pro_name VARCHAR(30) NOT NULL,
            pro_status int NOT NULL,
            pro_imagem VARCHAR(50) NOT NULL,
            pro_data TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            pro_id_professor INT(6) NOT NULL,
            pro_id_turma INT(6) NOT NULL
        )";
        $pdo->query($sql);
    }

    // Cria tabela de prova e postagem
    public function createTableProvaPostagem($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS prova_postagem (
            pro_pos_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            pro_id_fk INT(6) UNSIGNED NOT NULL,
            pos_id_fk INT(6) UNSIGNED NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);
    }

    // Cria tabela de prova e usuário
    public function createTableProvaUsuario($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS prova_usuario (
            pro_usu_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            pro_id_fk INT(6) UNSIGNED NOT NULL,
            usu_id_fk INT(6) UNSIGNED NOT NULL,
            pro_usu_status INT(1) NOT NULL,
            pro_usu_nota DECIMAL(3,1),
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);
    }

    // Cria tabela de Questões
    public function createTableQuestoes($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS questoes (
            que_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            que_texto LONGTEXT,
            que_alternativa_a TEXT,
            que_alternativa_b TEXT,
            que_alternativa_c TEXT,
            que_alternativa_d TEXT,
            que_resposta VARCHAR(1) NOT NULL,
            que_peso VARCHAR(15) NOT NULL,
            que_keyword_id_fk INT(6) NOT NULL
        )";
        $pdo->query($sql);
    }

    // Cria tabela de prova e questão
    public function createTableProvaQuestao($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS prova_questao (
            pro_que_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            pro_id_fk INT(6) UNSIGNED NOT NULL,
            que_id_fk INT(6) UNSIGNED NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);
    }

    // Cria tabela de palavras chave
    public function createTablePalavrasChave($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS palavras_chave (
            pal_id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            pal_texto VARCHAR(30) NOT NULL
        )";
        $pdo->query($sql);
    }

    // Chat - Criar tabela de mensagens
    public function createTableMensagens($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS mensagens (
            id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            id_usu_fk INT(6) UNSIGNED NOT NULL,
            id_usu_destinatario INT(6) UNSIGNED NOT NULL,
            mensagem TEXT NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);
    }

    public function createLogDeAcesso ($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS log_de_acesso (
            id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            id_usu_fk INT(6) UNSIGNED NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);
    }

    public function createLogPersonalizado ($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS log_personalizado (
            id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            usu_id_fk INT(6) UNSIGNED NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            log TEXT NOT NULL,
            log_status TEXT
        )";
        $pdo->query($sql);
    }

    public function createForumMessage ($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS forum_message (
            id_pk INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            profile_pic VARCHAR(50) NOT NULL,
            name VARCHAR(50) NOT NULL,
            tur_id_fk INT(6) UNSIGNED NOT NULL,
            message TEXT NOT NULL,
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->query($sql);
    }
    

    public function dropAllTables($pdo)
    {
        // Dropa todas as tabelas
        $sql = "
                DROP TABLE IF EXISTS provas;
                DROP TABLE IF EXISTS prova_postagem;
                DROP TABLE IF EXISTS prova_usuario;
                DROP TABLE IF EXISTS prova_questao;
                DROP TABLE IF EXISTS palavras_chave;
                DROP TABLE IF EXISTS questao_palavra_chave;
                DROP TABLE IF EXISTS mensagens;
                DROP TABLE IF EXISTS log_de_acesso;
                DROP TABLE IF EXISTS log_personalizado;
                DROP TABLE IF EXISTS usuarios;
                DROP TABLE IF EXISTS turmas;
                DROP TABLE IF EXISTS turma_usuario;
                DROP TABLE IF EXISTS turma_professor;
                DROP TABLE IF EXISTS turma_postagem;
                DROP TABLE IF EXISTS postagens;
                DROP TABLE IF EXISTS topicos;
                DROP TABLE IF EXISTS turma_topicos;
                DROP TABLE IF EXISTS postagem_usuario;
                DROP TABLE IF EXISTS forum_message;
                ";
                
        $pdo->query($sql);
    }

    // Contrutor
    public function __construct($pdoClass)
    {
        $this->createDatabase($pdoClass, 'curumim');
        $this->createTableTopicos($pdoClass);
        $this->createTableUsuarios($pdoClass);
        $this->createTableTurmas($pdoClass);
        $this->createTableTurmaTopicos($pdoClass);
        $this->createTablePostagens($pdoClass);
        $this->createTableTurmaUsuario($pdoClass);
        $this->createTablePostagemUsuario($pdoClass);
        $this->createTableProvas($pdoClass);
        $this->createTableProvaPostagem($pdoClass);
        $this->createTableProvaUsuario($pdoClass);
        $this->createTableQuestoes($pdoClass);
        $this->createTableProvaQuestao($pdoClass);
        $this->createTablePalavrasChave($pdoClass);
        $this->createTableMensagens($pdoClass);
        $this->createLogDeAcesso($pdoClass);
        $this->createLogPersonalizado($pdoClass);
        $this->createDesempenhoPorTopico($pdoClass);
        $this->createForumMessage($pdoClass);

        // drop
        // $this->dropAllTables($pdoClass);
    }
}
