<?php

// Inclui o arquivo de conexão
include_once '../../../conexao.php';

$idConteudo = $_POST['id'];

$sql = "SELECT pro_id_fk FROM prova_postagem WHERE pos_id_fk = $idConteudo";
$result = $pdo->query($sql);
$row = $result->fetch();
$idProva = $row['pro_id_fk'];

// Recupera as questões da prova

$sql = "SELECT * FROM questoes WHERE que_id_pk IN (SELECT que_id_fk FROM prova_questao WHERE pro_id_fk = $idProva)";
$result = $pdo->query($sql);
$questoes = $result->fetchAll();

// Recupera informações da prova
$sql = "SELECT * FROM provas WHERE pro_id_pk = $idProva";
$result = $pdo->query($sql);
$prova = $result->fetch();
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Fabiann Barbosa">

    <title>Curumim Trigonometria</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">

    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="shortcut icon" href="../img/ico.ico" type="image/x-icon">
    <link rel="icon" href="../../img/ico.ico" type="image/x-icon">

    <!-- tailwind css-->

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    <style>
        .selected {
            background-color: rgb(79 70 229) !important;
        }

        .question {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .question {
            color: white;
        }

        .question img {
            width: 30%;
            margin-top: 2%;
        }

        /* Alinha imagens no centro */
        .question img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .hideQuestion {
            display: none;
        }
    </style>
</head>

<body>

    <header class="flex items-center justify-between flex-wrap bg-gray-800 p-6">
        <div class="flex items-center text-white mr-6 justify-between">
            <span class="font-semibold text-xl tracking-tight">Curumim </span>
        </div>
        <div class="flex items-center text-white mr-6 justify-between">
            <span class="font-semibold text-xl tracking-tight">Avaliação <?php echo $prova['pro_name']; ?> </span>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <?php
        $index = 0;
        foreach ($questoes as $questao) {

        ?>
            <div class="question <?php echo 'index' . $index; ?>">
                <div class="flex flex-wrap justify-between">
                    <div class="p-4 rounded-lg border shadow-md sm:p-6 bg-gray-800 border-gray-700 " style="width: 70vw; height:80vh;">
                        <h5 class="mb-3 text-base font-semibold  lg:text-xl text-white">
                            <?php echo $questao['que_texto']; ?>
                        </h5>

                        <ul class="my-4 space-y-3 " >
                            <div class="flex">
                                <li style="width:48%; margin: 1%" onclick="select(<?php echo $index; ?>, 'A', <?php echo $questao['que_id_pk'];?>);">
                                    <a href="#" class="flex items-center p-3 text-base font-bold bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow bg-gray-600 hover:bg-gray-500 text-white" id="alternativaA<?php echo $index;?>">
                                        <span class="flex-1 ml-3 whitespace-nowrap"><?php echo $questao['que_alternativa_a']?></span>
                                    </a>
                                </li>
                                <li style="width:48%; margin: 1%" onclick="select(<?php echo $index; ?>, 'B', <?php echo $questao['que_id_pk'];?>);">
                                    <a href="#" class="flex items-center p-3 text-base font-bold  rounded-lg hover:bg-gray-100 group hover:shadow bg-gray-600 hover:bg-gray-500 text-white" id="alternativaB<?php echo $index;?>">
                                        <span class="flex-1 ml-3 whitespace-nowrap"><?php echo $questao['que_alternativa_b']?></span>
                                    </a>
                                </li>
                            </div>
                            <div class="flex">

                                <li style="width:48%; margin: 1%" onclick="select(<?php echo $index; ?>, 'C', <?php echo $questao['que_id_pk'];?>);">
                                    <a href="#" class="flex items-center p-3 text-base font-bold  rounded-lg hover:bg-gray-100 group hover:shadow bg-gray-600 hover:bg-gray-500 text-white" id="alternativaC<?php echo $index;?>">

                                        <span class="flex-1 ml-3 whitespace-nowrap"><?php echo $questao['que_alternativa_c']?></span>
                                    </a>
                                </li>
                                <li style="width:48%; margin: 1%" onclick="select(<?php echo $index; ?>, 'D', <?php echo $questao['que_id_pk'];?>);">
                                    <a href="#" class="flex items-center p-3 text-base font-bold  rounded-lg hover:bg-gray-100 group hover:shadow bg-gray-600 hover:bg-gray-500 text-white" id="alternativaD<?php echo $index;?>">

                                        <span class="flex-1 ml-3 whitespace-nowrap"><?php echo $questao['que_alternativa_d']?></span>
                                    </a>
                                </li>
                            </div>
                            <div class="flex justify-between">
                                <?php
                                if ($index == 0) {
                                    echo '<div></div>';
                                }
                                ?>
                                <button  onclick="previousQuestion()" class="bg-neutral-600 hover:bg-blue-700 text-white font-bold py-2 px-4 m-2 rounded-md" <?php
                                                                                                                                if ($index == 0) {
                                                                                                                                    echo 'style="display: none"';
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                                >
                                    <a class="text-white">Voltar</a>
                                </button>
                                <button onclick="nextQuestion()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-2 rounded-md" <?php
                                                                                                                            if ($index == count($questoes) - 1) {
                                                                                                                                echo 'style="display: none"';
                                                                                                                            }
                                                                                                                            ?>>

                                    <a class="text-white" >Avançar</a>
                                </button>
                                <button onclick="finalizar(<?php echo $idProva;?>)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-2 rounded-md" style="display: none; 
                                                                                                                                <?php
                                                                                                                                if ($index == count($questoes) - 1) {
                                                                                                                                    echo ' display: block !important;';
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                                "> 

                                    <a class="text-white" >Finalizar</a>
                                </button>

                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        <?php

            $index++;
        } ?>

    </main>

    <footer class="flex items-center justify-between flex-wrap bg-gray-800 p-6" style="position:fixed; bottom:0px; width:100%; heigth:100px">
        <!-- Progress bar -->
        <div class="w-full  rounded-full h-2.5 bg-gray-700">
            <div class="bg-blue-600 h-2.5 rounded-full" id="progress"></div>
        </div>
    </footer>

</body>
<script type="text/javascript">
    
    var index = 0;
    var total = 0;
    function showQuestion() {
        var question = document.getElementsByClassName('question');
        var progress = document.getElementById('progress');
        total = question.length;
        progress.style.width = (index * 100) / (question.length-1) + '%';

        for (var i = 0; i < question.length; i++) {
            if (i == index) {
                question[i].style.display = 'block';
            } else {
                question[i].style.display = 'none';
            }
        }
    }
    function porcentagem() {
        var porcentage = (index * 100) / question.length;
        return porcentage;
    }

    function nextQuestion() {
        index++;
        showQuestion();
    }

    function previousQuestion() {
        index--;
        showQuestion();
    }
    showQuestion();
    
    function finalizar(idProva) {
        // Cria formulário para enviar dados
        var form = document.createElement('form');
        var urlAtual = window.location.href; 
        // Remover # da urlAtual
        urlAtual = urlAtual.replace("#", "");
        form.action = urlAtual + "finalizar/validaRespostas.php";
        form.method = 'POST';
        form.style.display = 'none';
        // Cria campo para enviar dados
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'respostas';
        idProvaValue = idProva; 
        
        // Gera string de respostas
        var gabarito = '';
        for (var i = 0; i < respostas.length; i++) {
            gabarito += respostas[i].alternativa + ',' + respostas[i].idQuestao + ';';
        }
        
        input.value = gabarito;
        form.appendChild(input);

        // Cria campo para enviar dados
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'idProva';
        input.value = idProvaValue;
        form.appendChild(input);
        
        // Cria campo para enviar dados
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'totalDeQuestoes';
        input.value = total;
        form.appendChild(input);
        
        // Adiciona formulário ao corpo do documento
        document.body.appendChild(form);
        // Envia dados
        form.submit();


    }

    // cria classe de resposta
    
    var respostas = [];
    function select(quest, alternativa, idQuestao) {
        var resposta = {
            questao: quest,
            alternativa: alternativa,
            idQuestao: idQuestao
        };
        
        // Muda cor da alternativa selecionada
        if (alternativa == 'A') {
            document.getElementById('alternativaA'+quest).style.backgroundColor = 'rgb(79 70 229)';
            document.getElementById('alternativaB'+quest).style.backgroundColor = 'rgb(75 85 99)';
            document.getElementById('alternativaC'+quest).style.backgroundColor = 'rgb(75 85 99)';
            document.getElementById('alternativaD'+quest).style.backgroundColor = 'rgb(75 85 99)';
        } else if (alternativa == 'B') {
            document.getElementById('alternativaA'+quest).style.backgroundColor = 'rgb(75 85 99)';
            document.getElementById('alternativaB'+quest).style.backgroundColor = 'rgb(79 70 229)';
            document.getElementById('alternativaC'+quest).style.backgroundColor = 'rgb(75 85 99)';
            document.getElementById('alternativaD'+quest).style.backgroundColor = 'rgb(75 85 99)';
        } else if (alternativa == 'C') {
            document.getElementById('alternativaA'+quest).style.backgroundColor = 'rgb(75 85 99)';
            document.getElementById('alternativaB'+quest).style.backgroundColor = 'rgb(75 85 99)';
            document.getElementById('alternativaC'+quest).style.backgroundColor = 'rgb(79 70 229)';
            document.getElementById('alternativaD'+quest).style.backgroundColor = 'rgb(75 85 99)';
        } else if (alternativa == 'D') {
            document.getElementById('alternativaA'+quest).style.backgroundColor = 'rgb(75 85 99)';
            document.getElementById('alternativaB'+quest).style.backgroundColor = 'rgb(75 85 99)';
            document.getElementById('alternativaC'+quest).style.backgroundColor = 'rgb(75 85 99)';
            document.getElementById('alternativaD'+quest).style.backgroundColor = 'rgb(79 70 229)';
        } 
        
        // Percorre o array de respostas e verifica se a questão já foi respondida
        for (var i = 0; i < respostas.length; i++) {
            if (respostas[i].questao == quest) {
                respostas[i].alternativa = alternativa;
                // alertRespostas();
                return;
            }
        }
        respostas.push(resposta);
        // alertRespostas();
    }
    function alertRespostas () {
        for (var i = 0; i < respostas.length; i++) {
            alert(respostas[i].questao + ' - ' + respostas[i].alternativa + ' - ' + respostas[i].idQuestao);
        }
    }

</script>

</html>