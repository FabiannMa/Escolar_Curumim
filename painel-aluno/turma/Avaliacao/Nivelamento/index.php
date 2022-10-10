<?php
session_start();
require_once '../../../../conexao.php';


// Gera prova com base no nível do aluno


// Recupera questões do banco de dados

$sql = "SELECT * FROM questoes";
$questoes = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);


$questoes_selecionadas = array();
// Printa questões

$lista_de_key_words = array();
$id_turma = $_GET['id_turma'];
if (!isset($id_turma)){
    Header("Location: ../../../index.php");

}

// adiciona as palavras chave em um array
foreach ($questoes as $questao) {

    // Verifica se a palavra chave já existe no array
    if (!in_array($questao['que_keyword_id_fk'], $lista_de_key_words)) {
        $lista_de_key_words[] = $questao['que_keyword_id_fk'];
    }
}

// Seleciona as questões de cada palavra chave
foreach ($lista_de_key_words as $key_word) {
    // Seleciona 3 questões de cada palavra chave
    for ($i = 0; $i < 3; $i++) {
        $questao = $questoes[array_rand($questoes)];
        $questoes_selecionadas[] = $questao;

        // Remove a questão selecionada do array de questões
        unset($questoes[array_search($questao, $questoes)]);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação de Nivelamento</title>

    <!-- Import tailwind online -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.4/tailwind.min.css" integrity="sha512-6Q3Q2qZlZK4hfnzj/oCFgnW3yZg5jWqPW0Ee6SZw6VqZphIGtO9lD5Iep5Hk7zVXaVUWyA8/9FHYnDh2cgBX1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->


    <link rel="shortcut icon" href="../img/ico.ico" type="image/x-icon">
    <link rel="icon" href="../img/ico.ico" type="image/x-icon">

    <style>
        * {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            background-color: #1E90FF;
            color: white;
            padding: 1.6rem;
            text-align: center;
            height: 15vh;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .header h4 {
            font-size: 1.8rem;
        }

        .questao {
            display: flex;
            flex-direction: column;
            border: #1E90FF 2px solid;
            width: 70vw;
            margin: 2rem auto;
            padding: 1rem;
            border-radius: 10px;
        }

        .questao img {
            height: 30%;
            object-fit: contain;
            margin: 0 auto;
        }
        .questao span{
            height: 30% !important;
            object-fit: contain;
            margin: 0 auto;
        }

        .alternativas {
            display: flex;
            flex-direction: column;
            margin: 1rem 0;
        }
        .alternativa {
            display: flex;
            align-items: flex-end;
            margin: 0.5rem 0;
            cursor: pointer;
            padding: 0.5rem;
            transition: all 0.4s  ease-in-out !important;

        }
        form{
            margin-bottom: 10vw;
        }
        .alternativa:hover{
            background-color: #1E90FF;
            color: white;
            transition: all 0.4s  ease-in-out !important;
        }
        .alternativa p{ 
            margin-left: 0.5rem;
        }
        .alternativa input{
            margin-right: 0.5rem;
            width: 1.1rem;
            height: 1.1rem;
            
        }

    </style>
</head>

<body>
    <div class="header">
        <h4 class="text-center text-2xl font-bold">Avaliação de Nivelamento</h4>
    </div>
    <form action="resultado.php?id_turma=<?php echo $id_turma;?>" method="POST">

        <?php
        // // Printa questões
        $index = 1;
        foreach ($questoes_selecionadas as $questao) {

        ?>

            <div class="questao">
                <h4 class="text-center text-xl font-bold">Questão <?php echo $index; ?></h4>
                <p> <?php echo $questao['que_texto']; ?> </p>
                <div class="alternativas">
                    <div class="alternativa">
                        <p>
                            A.  
                        <input type="radio" name="alternativa<?php echo $questao["que_id_pk"]; ?>" id="alternativa<?php echo $index; ?>a" value="A">
                        <p   ><?php echo $questao['que_alternativa_a']; ?></p>
                        </p>
                    </div>
                    <div class="alternativa">
                        <p>
                            B.
                        <input type="radio" name="alternativa<?php echo $questao["que_id_pk"]; ?>" id="alternativa<?php echo $index; ?>b" value="B">
                        <p ><?php echo $questao['que_alternativa_b']; ?></p>
                        </p>
                    </div>
                    <div class="alternativa">
                        <p>
                            C.
                        <input type="radio" name="alternativa<?php echo $questao["que_id_pk"]; ?>" id="alternativa<?php echo $index; ?>c" value="C">
                        <p><?php echo $questao['que_alternativa_c']; ?></p>
                        </p>
                    </div>
                    <div class="alternativa">
                        <p>
                            D.
                        <input type="radio" name="alternativa<?php echo $questao["que_id_pk"]; ?>" id="alternativa<?php echo $index; ?>d" value="D">
                        <p  ><?php echo $questao['que_alternativa_d']; ?></p>
                        </p>
                    </div>
                        <input type="radio" name="alternativa<?php echo $questao["que_id_pk"]; ?>" id="alternativa<?php echo $index; ?>default" value="none" checked hidden>
                </div>
            </div>


        <?php
            $index++;
        }

        ?>

        <div class="flex justify-center">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Finalizar Avaliação</button>
        </div>
    </form>

</body>

</html>