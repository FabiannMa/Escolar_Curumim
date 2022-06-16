<?php

session_start();

class Turma {
    public $id;
    public $nome;
    public $status;
    public $imagem;
    public $hash_code;
    public $data_cadastro;
    public $id_professor;

    public function __construct($nome, $status, $imagem, $hash_code) {
        $this->nome = $nome;
        $this->status = $status;
        $this->imagem = $imagem;
        $this->hash_code = $hash_code;
        $this->id_professor = $_SESSION['id_usuario'];

    }
    public function generateHashCode($id) {
        // The hash code hash 6 digits
        $hash_code = substr(md5($id), 0, 6);
        return $hash_code;
    }

    public function getId() {
        // Get the id of the classroom
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function getHashCode() {
        return $this->hash_code;
    }

    public function getDataCadastro() {
        return $this->data_cadastro;
    }
}

?>