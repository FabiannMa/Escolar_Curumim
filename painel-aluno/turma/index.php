<head>


<link rel="stylesheet" href="../../Packages/Trumbowyg/dist/ui/trumbowyg.min.css">

</head>

<?php
require_once("../../conexao.php");

// Verificar se o usuário está logado antes de mostrar o conteúdo
require_once("../utils/verifyAuth.php");

//RECUPERAR DADOS DO USUÁRIO
$query = $pdo->query("SELECT * FROM usuarios where id = '$_SESSION[id_usuario]'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_usu = @$res[0]['nome'];
$cpf_usu = @$res[0]['cpf'];
$email_usu = @$res[0]['email'];
$idUsuario = @$res[0]['id'];
$photo = @$res[0]['foto'];

// Recupera dados da turma 
$query = $pdo->query("SELECT * FROM turmas where tur_id_pk = '$_GET[id]'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_turma = @$res[0]['tur_name'];
$id_professor = @$res[0]['tur_id_professor'];
$turma = $_GET['id'];

$mensagensEnviadas = [];
$mensagensRecebidas = [];

$sql = "SELECT * FROM mensagens WHERE id_usu_fk = '$idUsuario'";
$res = $pdo->query($sql);
$mensagensEnviadas = $res->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM mensagens WHERE id_usu_destinatario = '$idUsuario'";
$res = $pdo->query($sql);
$mensagensRecebidas = $res->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT first_access FROM turma_usuario WHERE tur_id_fk = '$_GET[id]' AND usu_id_fk = '$idUsuario'";
$res = $pdo->query($sql);
$firstAcess = $res->fetchAll(PDO::FETCH_ASSOC);
$firstAcess = $firstAcess[0]['first_access'];

echo "<script>
         var firstAcess = $firstAcess;
      </script>";



function atualizaMensagens()
{
    global $pdo;
    global $idUsuario;
    global $mensagensRecebidas;
    global $mensagensEnviadas;

    $sql = "SELECT * FROM mensagens WHERE id_usu_destinatario = '$idUsuario'";
    $res = $pdo->query($sql);
    $mensagensRecebidas = $res->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM mensagens WHERE id_usu_fk = '$idUsuario'";
    $res = $pdo->query($sql);
    $mensagensEnviadas = $res->fetchAll(PDO::FETCH_ASSOC);

    replotaMensagens();
}
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

    <style>
        .messageModal {
            position: fixed;
            top: 0;
            left: 0;
            padding-bottom: 20px;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: flex-end;
            display: none;
        }

        .messageModal .card {
            width: 100%;
            max-width: 500px;
            height: 85%;
            background-color: #fff;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0px;
        }

        .messageModal .card .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .messageModal .card .card-body {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: flex-start;
            width: 100%;
            padding: 0px;
        }

        .messageModal .card .card-body .send {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin: 0;
            padding: 0;
            color: #f0f0f0;
        }

        .messageModal .card .card-body .messageArea {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            overflow-y: scroll;
            height: calc(100% - 50px);
        }

        .messageModal .card .card-body .send input {
            width: 100%;
            border-radius: 5px;
            padding: 10px;
            margin: 20px;
            margin-right: 0;
            font-size: 1.2rem;
            color: #002aaa;
            height: 50px;
            border-color: #007fff;
        }

        .messageModal .card .card-body .send button {

            border-radius: 5px;
            padding: 10px;
            margin: 20px;
            margin-left: 0;
            font-size: 1.2rem;
            color: #fff;
            height: 50px;
            background-color: #007fff;
        }


        .messageModal .card .card-body .send input::placeholder {
            color: #007fff;
        }

        .messageArea {
            display: flex;
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-y: scroll;
            height: calc(100% - 50px);
        }

        .leftMessage {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            margin: 0;
            background: #f0f0ff;
            box-shadow: 0px 0px 10px #ccc;
            width: 60%;
            margin-left: 10px;
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .rightMessage {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            margin: 0;
            background: #007fff;
            box-shadow: 0px 0px 10px #ccc;
            width: 60%;
            margin-right: 10px;
            margin-top: 10px;
            margin-left: calc(40% - 10px);
            padding: 10px;
            border-radius: 5px;
            color: #fff;
        }

        .rightMessage .messageHeaderRight * {
            color: #fff !important;
        }

        .messageHeader img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;

        }

        .messageHeader {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        :root {
            --line-border-fill: #3498db;
            --line-border-empty: #e0e0e0;
        }

        .container {
            text-align: center;
        }

        .progress-container {
            display: flex;
        }

        .circle {
            background-color: #fff;
            color: #999;
            border-radius: 50%;
            height: 100px;
            width: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #e0e0e0;
            transition: 0.4s ease;
            margin: 0px 0px 0px 0px;
            font: 700 1rem/1 'Inter', sans-serif;

        }

        .circle.active {
            border-color: var(--line-border-fill);
            background-color: rgba(200, 220, 255, 0.2);
        }

        .conteudobox {
            margin: 10px;
        }

        .popContent {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 0;
            left: 0;
            z-index: 999;
            padding: 20px;
        }

        .popup {
            width: 70%;
            height: 85%;
            background-color: rgba(255, 255, 255);
            z-index: 9999;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            box-sizing: border-box;
        }

        .popHeader {
            font-size: 2em;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .close {
            cursor: pointer;
            font-size: 1.5em;
            align-self: flex-start;
            text-shadow: 0px 0px 1px rgba(0, 0, 0, 0.5);

        }

        .popHeader h1 {
            margin-bottom: 10px;
            margin-top: 40px;
            margin-left: 60px;
        }

        .popBody {
            display: flex;
            flex-direction: column;
            height: 85%;
        }

        .popBody .keywords {
            display: flex;
            margin-left: 60px;
        }

        .popBody .keywords .keyword {
            margin-right: 10px;
            margin-bottom: 10px;
            font-size: .8em;
            background-color: #3498db;
            color: white;
            padding: 5px;
            border-radius: 5px;
            ;
        }

        .popBody .popText {
            margin-left: 60px;
            margin-top: 10px;
            font-size: 1.2em;
            /*Scroll*/
            overflow-y: scroll;
            height: 100%;
            width: 94%;
            padding: 10px;

        }

        .popFooter {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        #popConteudo {
            display: none;
            transition: all 0.5s ease;
            transform: scale(0);
        }

        .completed {
            /* Green color */
            background-color: rgb(0, 150, 65, .2);
            border-color: #4CAF50;
            color: #4CAF50;
            font-size: 16pt;

        }

        .img-profile {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
            margin-bottom: 20px;

            object-fit: cover;
        }
    </style>
</head>

<body id="page-top">
    <div class="popContent" id="popConteudo">
        <div class="popup">
            <div class="popHeader">

                <iframe src="frames/iframetitle.php" frameborder="0" style="width: 100%;  height:80px" id="iframeTitle"></iframe>

                <div class="close" onclick="closePopup()">&times;</div>
            </div>
            <div class="popBody">
                <div class="keywords">
                    <iframe src="frames/iframeKey.php" frameborder="0" style=" height:50px" id="iframeKeys"></iframe>
                </div>
                <div class="popText">
                    <iframe src="frames/iframeConteudo.php" frameborder="0" style="width: 100%; height:100%;" id="iframeContent"></iframe>
                </div>
            </div>
            <div class="popFooter">
                <button class="btn btn-primary" id="btn-ok" onclick="iniciarProva()">Iniciar Avaliação</button>
            </div>
        </div>
    </div>

    </div>
    </div>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- #region Menu da Página -->
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
                <div class="sidebar-brand-text mx-3">ALUNO</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <div class="sidebar-heading" onclick="switchPage(1)">
                Conteúdos
            </div>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" onclick="switchPage(1)">
                    <h6><i class="fas fa-fw fa-tachometer-alt"></i>
                        Conteúdos</h6>
                </a>
            </li>



            <div class="sidebar-heading" onclick="switchPage(3)">
                Avaliações
            </div>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" onclick="switchPage(3)">
                    <h6><i class="fas fa-fw fa-tachometer-alt"></i>
                        Avaliações</h6>
                </a>
            </li>

            <div class="sidebar-heading" onclick="switchPage(2)">
                Fórum
            </div>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" onclick="switchPage(2)">
                    <h6><i class="fas fa-fw fa-tachometer-alt"></i>
                        Fórum</h6>
                </a>
            </li>

            <div class="sidebar-heading" onclick="switchPage(4)">
                Desempenho
            </div>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" onclick="switchPage(4)">
                    <h6><i class="fas fa-fw fa-tachometer-alt"></i>
                        Desempenho</h6>
                </a>
            </li>




        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <img class="mt-2" src="../../img/logo1.png" width="160">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nome_usu ?></span>
                                <img class="img-profile rounded-circle" src="../../img/profilepics/<?php echo $photo ?>">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="" data-toggle="modal" data-target="#ModalPerfil">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i>
                                    Editar Perfil
                                </a>

                                <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="../../logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                    Sair
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- #endregion  -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- Card do professor -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <?php echo "Informações do professor" ?>
                            </h6>
                        </div>
                        <div class="card-body">
                            <?php
                            $sql = "SELECT * FROM usuarios WHERE id ='$id_professor'";
                            $result = $pdo->query($sql);
                            $row = $result->fetch();

                            $nome_professor = $row['nome'];
                            $email_professor = $row['email'];
                            $foto_professor = $row['foto'];
                            ?>
                            <div class="row">
                                <div class="col-md-2">
                                    <img class="img-profile rounded-circle" src="../../img/profilepics/<?php echo $foto_professor ?>">

                                </div>
                                <div class="col-md-8 ">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <?php echo $nome_professor ?>
                                    </h6>
                                    <p>
                                        <?php echo $email_professor ?>
                                    </p>
                                </div>
                                <div class="col-md-2" onclick="onOffChat()">
                                    <a class="btn btn-primary btn-icon-split ">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                        <span class="text text-white">
                                            Enviar mensagem
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>










                    <!-- /.container-fluid -->
                    <!-- Card da pagina -->


                    <div>

                        <!-- Titulo da pagina -->
                        <div class="card" id="conteudosContainer">
                            <!-- Card Header -->
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary text-2xl">
                                    Conteúdos
                                </h6>
                            </div>

                            <?php
                            // Recupera os topicos da turma	
                            $sql = "SELECT * FROM topicos WHERE top_id_pk IN (SELECT top_id_fk FROM turma_topicos WHERE tur_id_fk = $_GET[id])";
                            $query = $pdo->query($sql);
                            $topicos = $query->fetchAll();

                            foreach ($topicos as $topico) {
                                // Recupera os conteudos do topico
                                $sql = "SELECT * FROM postagens WHERE top_id_fk = $topico[top_id_pk]";
                                $query = $pdo->query($sql);
                                $conteudos = $query->fetchAll();
                                $index = 0;
                                // Mostra os conteudos
                                echo '<div class="card shadow mb-4">';
                                echo '<div class="card-header py-3">';
                                echo '<h6 class="m-0 font-weight-bold text-primary">';
                                echo $topico['top_name'];
                                echo '</h6>';
                                echo '</div>';
                                echo '<div class="card-body">';
                                echo '<div class="progress-container">';
                                foreach ($conteudos as $conteudo) {
                            ?>
                                    <?php
                                    // recupera a relação do conteudo com o usuario
                                    $sql2 = "SELECT * FROM postagem_usuario WHERE usu_id_fk = $_SESSION[id_usuario] AND pos_id_fk = $conteudo[pos_id_pk]";
                                    $query2 = $pdo->query($sql2);
                                    $relacao = $query2->fetchAll();
                                    $StatusConteudo = $relacao[0]['pos_usu_status'];

                                    ?>
                                    <?php if ($StatusConteudo == 1 || $StatusConteudo == 2) { ?>
                                        <a onclick="openPopup(<?php echo $conteudo['pos_id_pk']; ?>)">
                                        <?php } ?>
                                        <div class="flex conteudobox" style="justify-content: center; align-items: center; flex-direction: column;">
                                            <div class="circle <?php
                                                                if ($StatusConteudo == 1) {
                                                                    echo 'active';
                                                                }
                                                                if ($StatusConteudo == 2) {
                                                                    echo 'completed';
                                                                } ?>">

                                                <?php if ($StatusConteudo == 1) echo 'Iniciar' ?>
                                                <?php if ($StatusConteudo == 0) echo '<i class="fas fa-lock"></i>' ?>
                                                <?php if ($StatusConteudo == 2) echo '<i class="fas fa-check"></i>' ?>
                                            </div>
                                            <?php echo $conteudo['pos_titulo']; ?>

                                        </div>
                                        <?php
                                        if ($StatusConteudo == 1 || $StatusConteudo == 2) {
                                        ?>
                                        </a>
                            <?php
                                        }
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }


                            ?>

                        </div>


                        <!-- Provas -->
                        <!-- Titulo da pagina -->
                        <div class="card" id="provasContainer">
                            <!-- Card Header -->
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary text-2xl">
                                    Provas
                                </h6>
                            </div>

                            <?php
                            // Recupera provas do aluno
                            $sql = "SELECT * FROM provas WHERE pro_id_pk IN (SELECT pro_id_fk FROM prova_usuario WHERE usu_id_fk = $_SESSION[id_usuario])";
                            $query = $pdo->query($sql);
                            $provas = $query->fetchAll();

                            foreach ($provas as $prova) {
                                $idProva = $prova['pro_id_pk'];
                                $sql = "SELECT * FROM prova_usuario WHERE pro_id_fk = $idProva AND usu_id_fk = $_SESSION[id_usuario]";
                                $query = $pdo->query($sql);
                                $provaUsuario = $query->fetchAll();

                            ?>

                                <div class="card shadow mb-4">
                                    <!-- Card Header -->
                                    <div class="card-header py-3 flex justify-between">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <?php echo $prova['pro_name']; ?>
                                        </h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="progress-container">
                                            <div class="flex conteudobox" style=" width:100%; justify-content: center; align-items: center; flex-direction: column;">
                                                <?php

                                                foreach ($provaUsuario as $result) {

                                                ?>

                                                    <div class="m-0 font-weight-bold text-primary flex " style=" width:90%; justify-content:space-around;">
                                                        <div>
                                                            Data de realização:
                                                            <?php
                                                            $data = new DateTime($result['data_cadastro']);
                                                            echo $data->format('d/m/Y');
                                                            $hora = new DateTime($result['data_cadastro']);
                                                            echo ' - ' . $hora->format('H:i');
                                                            ?>
                                                        </div>
                                                        <div class="pd-12 text-lg font-bold
                                                        <?php

                                                        if ($result['pro_usu_nota'] >= 6) {
                                                            echo 'text-green-600';
                                                        } else {
                                                            echo 'text-rose-500';
                                                        }
                                                        ?>
                                                        ">

                                                            <?php echo $result['pro_usu_nota'] ?> - <?php

                                                                                                    if ($result['pro_usu_nota'] >= 6) {
                                                                                                        echo 'Aprovado';
                                                                                                    } else {
                                                                                                        echo 'Reprovado';
                                                                                                    }
                                                                                                    ?>

                                                        </div>
                                                    </div>


                                                <?php
                                                }
                                                ?>



                                            </div>
                                        </div>
                                    </div>

                                <?php
                            }
                                ?>
                                </div>
                        </div>

                        <!-- Forum -->
                        <!-- Titulo da pagina -->
                        <div class="card" id="forumContainer">
                            <!-- Card Header -->
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary text-2xl">
                                    Fórum
                                </h6>
                            </div>

                            <div class="panel-body">
                                <div class="col-md-12 flex justify-center">
                                    <div class="card col-md-6">

                                        <form action="../utils/addForum.php" method="POST">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Adicionar Postagem</label>

                                                    <!-- Trumb text area -->
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="message"></textarea>
                                                </div>
                                                <input type="hidden" name="tur_id_fk" value="<?php echo $turma; ?>">
                                                <input type="hidden" name="profile_pic" value="<?php echo $photo ?>">
                                                <input type="hidden" name="nome" value="<?php echo $nome_usu ?>">
                                                <button type="submit" class="btn btn-primary text-primary">Postar</button>
                                            </div>

                                            <div class="card-body">

                                                <!-- Mostra postagens ordenadas por data -->
                                                <?php

                                                $sql = "SELECT * FROM forum_message WHERE tur_id_fk = '$turma' ORDER BY data_cadastro DESC";
                                                $query = $pdo->query($sql);
                                                $dados = $query->fetchAll();

                                                foreach ($dados as $key => $value) {
                                                    $message = $value['message'];
                                                    $profile_pic = $value['profile_pic'];
                                                    $nome = $value['name'];
                                                    $data_cadastro = $value['data_cadastro'];

                                                    // formata a data
                                                    $data_cadastro = date('d/m/Y H:i:s', strtotime($data_cadastro));

                                                    $data = explode(" ", $data_cadastro);
                                                    $data = $data[0];
                                                    $hora = explode(" ", $data_cadastro);
                                                    $hora = $hora[1];

                                                    // compara com a data atual
                                                    $data_atual = date('d/m/Y');
                                                    $hora_atual = date('H:i:s');

                                                    if ($data == $data_atual) {
                                                        $data = "Hoje";
                                                    } elseif ($data == date('d/m/Y', strtotime('-1 days'))) {
                                                        $data = "Ontem";
                                                    }



                                                ?>
                                                    <div class="card" style="margin:10px;">
                                                        <div class="card-body flex flex-row justify-between">
                                                            <div class="flex flex-row justify-center">
                                                                <img src="../../img/profilepics/<?php echo $profile_pic; ?>" alt="" class="rounded-circle" style="
                                                    margin-right: 10px;
                                                    object-fit: cover;
                                                    width: 50px;
                                                    height: 50px;
                                                    ">
                                                                <div class="flex flex-column justify-center ml-3">
                                                                    <h5 class="card-title"><?php echo $nome; ?></h5>
                                                                    <p class="card-text"><?php echo $data; ?> às <?php echo $hora; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- divider -->
                                                        <hr class="mb-4">
                                                        <div class="card-body">
                                                            <p class="card-text"><?php echo $message; ?></p>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>


                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desempenho -->
                <!-- Titulo da pagina -->
                <div class="card" id="desempenhoContainer">
                    <!-- Card Header -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-2xl">
                            Desempenho
                        </h6>


                    </div>
                    <!-- Desempenho individual  -->
                    <div class="card shadow mb-4">
                        <!-- Card Header -->
                        <div class="card-header py-3 flex justify-center">
                            <div class="profile wd-100">
                                <div class="profile__info">
                                    <div class="profile__info__item">
                                        <div class="profile__info__item__title">
                                            <!-- foto de perfil -->
                                            <img src="../../img/profilepics/<?php echo $photo ?>" alt="Avatar" class="img-profile rounded-circle">
                                        </div>
                                        <div class="profile__info__item__text">
                                            <?php echo $_SESSION['nome_usuario']; ?>
                                        </div>
                                        <!-- Medals -->
                                        <div class="profile__info__item__title">
                                            <!-- Icon star -->

                                            <?php
                                            $sql = "SELECT sum(pontuacao) as total FROM desempenho_por_topico WHERE id_usuario = $_SESSION[id_usuario]";
                                            $query = $pdo->query($sql);
                                            $total = $query->fetchAll();
                                            foreach ($total as $result) {
                                                $total = $result['total'];
                                            }

                                            $medals = intdiv($total, 4);


                                            for ($i = 0; $i < 5; $i++) {
                                                if ($i < $medals) {
                                                    echo '<i class="fas fa-star text-yellow-400"></i>';
                                                } else {
                                                    echo '<i class="far fa-star text-yellow-400"></i>';
                                                }
                                            }

                                            ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="progress-container">
                                <table class="table table-borderless" style="
                                        width: 100%;
                                        margin: 0 auto;
                                        justify-content: center;
                                        align-items: center;
                                        display: flex;">
                                    <?php
                                    $sql = "SELECT * FROM desempenho_por_topico WHERE id_usuario = $_SESSION[id_usuario]";
                                    $query = $pdo->query($sql);
                                    $desempenho = $query->fetchAll();

                                    foreach ($desempenho as $desempenho) {
                                        $idTopico = $desempenho['id_topico'];
                                        $sql = "SELECT * FROM palavras_chave WHERE pal_id_pk = $idTopico";
                                        $query = $pdo->query($sql);
                                        $topico = $query->fetchAll();

                                        foreach ($topico as $topico) {
                                            $nomeTopico = $topico['pal_texto'];
                                        }

                                    ?>

                                        <!-- profile and points -->

                                        <tr>
                                            <td class="text-right" style=" width:50%;">
                                                <!-- Icon medal -->
                                                <i class="fas fa-medal text-yellow-400"></i>

                                                <?php echo $nomeTopico ?>

                                            </td>
                                            <td class="text-left">

                                                <i class="fas fa-star"></i>

                                                <?php
                                                echo $desempenho['pontuacao'] / 4;
                                                ?>

                                            </td>
                                        </tr>

                                    <?php
                                    }
                                    ?>
                                </table>

                            </div>

                        </div>

                    </div>
                </div>


                <!-- End of Page Wrapper -->



                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

                <!-- Modal Firs acess-->
                <div id="modalFirstAcess" class="black-background" style="position:absolute;
                                                         width:100vw;
                                                         height:100vh;
                                                         top:0;
                                                         left:0;
                                                         background-color:rgba(0,0,0,0.5);
                                                         z-index:9999;
                                                         padding: 30vh;">


                    <div class="modal-dialog">
                        <div class="modal-content rounded">
                            <div class="modal-header">
                                <h2 class="modal-title" id="modalFirstAcessLabel">Bem vindo à turma!</h2>
                            </div>
                            <div class="modal-body">Para começar, você deve realizar uma pequena avaliação de nivelamento.</div>
                            <div class="modal-footer">
                                <a class="btn btn-primary" href="Avaliacao/Nivelamento?id_turma=<?php echo $_GET['id']; ?>">Iniciar avaliação</a>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Core plugin JavaScript-->
                <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="../js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="../vendor/chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="../js/demo/chart-area-demo.js"></script>
                <script src="../js/demo/chart-pie-demo.js"></script>

                <!-- Page level plugins -->
                <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
                <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="../js/demo/datatables-demo.js"></script>
                <div class="modal">
                    <!-- Place at bottom of page -->
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>



    <div class="messageModal" id="chat">

        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary text-2xl">
                    Mensagem
                </h6>
                <a href="#" class="close" onclick="onOffChat()">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>

            <div class="card-body">

                <div class="messageArea">
                    <?php
                    atualizaMensagens();
                    function ordenarMensagens($listaMensagens)
                    {
                        $tamanho = count($listaMensagens);
                        for ($i = 0; $i < $tamanho; $i++) {
                            for ($j = 0; $j < $tamanho - 1; $j++) {
                                if ($listaMensagens[$j]['data_cadastro'] > $listaMensagens[$j + 1]['data_cadastro']) {
                                    $aux = $listaMensagens[$j];
                                    $listaMensagens[$j] = $listaMensagens[$j + 1];
                                    $listaMensagens[$j + 1] = $aux;
                                }
                            }
                        }
                        return $listaMensagens;
                    }
                    function replotaMensagens()
                    {
                        global $mensagensEnviadas;
                        global $mensagensRecebidas;
                        global $photo;
                        global $foto_professor;
                        global $nome_professor;
                        global $nome_usu;

                        $listaMensagens = array_merge($mensagensEnviadas, $mensagensRecebidas);

                        // Ordena as mensagens por data
                        $listaordenada = ordenarMensagens($listaMensagens);

                        // Imprime as mensagens
                        foreach ($listaordenada as $mensagem) {
                            if ($mensagem['id_usu_fk'] != $_SESSION['id_usuario']) {
                    ?>
                                <div class="leftMessage">
                                    <div class="message">
                                        <div class="messageHeader">
                                            <div class="messageHeaderLeft">
                                                <img src="../../img/profilepics/<?php echo $foto_professor ?>" alt="">
                                            </div>
                                            <div class="messageHeaderRight">
                                                <h6 class="m-0 font-weight-bold text-primary ">
                                                    <?php echo $nome_professor ?>
                                                </h6>
                                                <small class="text-muted">
                                                    <?php echo $mensagem['data_cadastro'] ?>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="messageBody">
                                            <p>
                                                <?php echo $mensagem['mensagem'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            } else {
                            ?>

                                <div class="rightMessage">
                                    <div class="message">
                                        <div class="messageHeader">
                                            <div class="messageHeaderLeft">
                                                <img src="../../img/profilepics/<?php echo $photo ?>" alt="">
                                            </div>
                                            <div class="messageHeaderRight">
                                                <h6 class="m-0 font-weight-bold text-primary ">
                                                    <?php echo  $nome_usu ?>
                                                </h6>
                                                <small class="text-muted">
                                                    <?php

                                                    echo $mensagem['data_cadastro'] ?>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="messageBody">
                                            <p>
                                                <?php echo $mensagem['mensagem'] ?>
                                            </p>
                                        </div>
                                    </div>

                                </div>

                    <?php
                            }
                        }
                    }
                    ?>
                </div>

                <div class="col send">
                    <input type="text" class="form-control" id="mensagem" name="mensagem" placeholder="Mensagem" max="255">
                    <button type="button" class="btn btn-primary" onclick="enviarMensagem()">Enviar</button>
                </div>
            </div>
        </div>

        <div style="display:none">
            <!-- hide values -->
            <input type="text" name="id_professor" id="id_professor" value="<?php echo $id_professor ?>">
            <input type="text" name="id_aluno" id="id_aluno" value="<?php echo $idUsuario;  ?>">
        </div>


</body>


<style>
    df-messenger {
        --df-messenger-bot-message: #C0C0C0;
        --df-messenger-button-titlebar-color: #007fff;
        --df-messenger-chat-background-color: #f0f0f0;
        --df-messenger-font-color: blue;
        --df-messenger-send-icon: #509ed8;
        --df-messenger-user-message: #C0C0C0;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js" integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(document).ready(function() {
        createCookies("idPost", "", "10");
    });

    var idPost = 0;

    function closeFirstAcess() {
        var popup = document.getElementById("modalFirstAcess");
        popup.style.display = "none";
    }

    if (firstAcess != 1) {
        closeFirstAcess();

    }

    function openPopup(url) {
        var pop = document.getElementById("popConteudo");
        pop.style.display = "flex";
        pop.style.transform = "scale(1)";
        idPost = url;
        // Change the url of the iframe to the desired page
        var iframeTitle = document.getElementById("iframeTitle");
        iframeTitle.src = "frames/iframetitle.php?id=" + url;
        var iframeConteudo = document.getElementById("iframeContent");
        iframeConteudo.src = "frames/iframeConteudo.php?id=" + url;
        var iframeKeys = document.getElementById("iframeKeys");
        iframeKeys.src = "frames/iframeKey.php?id=" + url;
    }

    function closePopup() {
        var pop = document.getElementById("popConteudo");
        pop.style.transform = "scale(0)";
        pop.style.display = "none";
    }

    function iniciarProva() {
        // Post method redirect
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "Avaliacao/");
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "id");
        hiddenField.setAttribute("value", idPost);
        form.appendChild(hiddenField);
        document.body.appendChild(form);
        form.submit();
    }

    // Paginação
    var paginaconteudo = document.getElementById("conteudosContainer");
    // paginaconteudo.style.display = "none";

    var paginaProvas = document.getElementById("provasContainer");
    paginaProvas.style.display = "none";
    var paginaForum = document.getElementById("forumContainer");
    paginaForum.style.display = "none";
    var paginaDesempenho = document.getElementById("desempenhoContainer");
    paginaDesempenho.style.display = "none";


    function switchPage(page) {
        if (page == "1") {
            paginaconteudo.style.display = "block";
            paginaProvas.style.display = "none";
            paginaForum.style.display = "none";
            paginaDesempenho.style.display = "none";
        } else if (page == "3") {
            paginaconteudo.style.display = "none";
            paginaProvas.style.display = "block";
            paginaForum.style.display = "none";
            paginaDesempenho.style.display = "none";
        } else if (page == "2") {
            paginaconteudo.style.display = "none";
            paginaProvas.style.display = "none";
            paginaForum.style.display = "block";
            paginaDesempenho.style.display = "none";
        } else if (page == "4") {
            paginaconteudo.style.display = "none";
            paginaProvas.style.display = "none";
            paginaForum.style.display = "none";
            paginaDesempenho.style.display = "block";
        }
    }

    // Chat 
    function onOffChat() {
        var chat = document.getElementById("chat");
        if (chat.style.display == "none") {
            chat.style.display = "flex";
        } else {
            chat.style.display = "none";
        }
    }

    function enviarMensagem() {

        var mensagem = document.getElementsByName("mensagem")[0].value;
        var id_professor = document.getElementsByName("id_professor")[0].value;
        var id_aluno = document.getElementsByName("id_aluno")[0].value;
        // Enviar mensagem  
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        // set target 
        form.setAttribute("target", "_blank");
        // cria campos
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "mensagem");
        hiddenField.setAttribute("value", mensagem);
        form.appendChild(hiddenField);
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "idDestinatario");
        hiddenField.setAttribute("value", id_professor);
        form.appendChild(hiddenField);
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "idRemetente");
        hiddenField.setAttribute("value", id_aluno);
        form.appendChild(hiddenField);

        // Set action
        form.setAttribute("action", "sendMessage.php");
        document.body.appendChild(form);
        form.submit();

        // Chama a função para atualizar a página
        atualizarChat();
    }
    // Atualiza a página
    function atualizarChat() {
        window.location.reload();
    }
</script>

<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>

<df-messenger intent="WELCOME" chat-title="Curumim Assistente" chat-icon="https://imgur.com/tx1neHH.png" agent-id="99180b3c-bb9f-48e7-9282-f6a81556ae57" language-code="pt-br"></df-messenger>

<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>


<script src="../../Packages/Trumbowyg/dist/trumbowyg.min.js"></script>

<script src="../../Packages/trumbowyg/dist/plugins/upload/trumbowyg.upload.min.js"></script>


<script>
    // Trumbowyg
    $('#exampleFormControlTextarea1').trumbowyg({
        btns: [
            ['viewHTML'],
            ['undo', 'redo'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'], // Only supported in Blink browsers
            ['unorderedList', 'orderedList'],
            ['upload', 'insertImage', 'link'],
            ['superscript', 'subscript'],
            ['formatting', 'strong', 'em', ],

        ],
        lang: 'pt_br',
        plugins: {
            // Add imagur parameters to upload plugin for demo purposes
            upload: {
                serverPath: 'util/imgUpload.php',
                fileFieldName: 'image',
                headers: {
                    'Authorization': 'Client-ID xxxxxxxxxxxx'
                },
                urlPropertyName: 'file'
            }
        }

    });
</script>
</div>

</html>