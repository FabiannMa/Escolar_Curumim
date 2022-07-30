<!-- #region Conection -->
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
?>

<!-- #endregion -->

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
        .completed{
            /* Green color */
            background-color: rgb(0, 150, 65, .2); 
            border-color: #4CAF50;
            color : #4CAF50;
            font-size: 16pt;
            
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

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
                <div class="sidebar-brand-text mx-3">ALUNO</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Turmas
            </div>


            <?php

            // Mostra turmas do usuário na barra de menu

            if (true) {
                echo '<li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse', $topicoFormatado, '" aria-expanded="true" aria-controls="collapse', $topicoFormatado, '">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>  </span>
                    </a>
                    ';
            }
            echo '</li>';
            ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                TESTE SEUS CONHECIMENTOS
            </div>



            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?pag=<?php echo $menu6 ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span><b>QUIZ CURUMIM</b></span></a>
            </li>

            <!-- Nav Item - Tables -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

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
                                <img class="img-profile rounded-circle" src="../../img/sem-foto.jpg">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#ModalPerfil">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i>
                                    Editar Perfil
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../../logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Card da pagina -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <?php echo "Turmas 2002" ?>
                            </h6>
                        </div>
                        <div class="card-body">
                            <!-- Menu de Opções em cards -->
                            <div class="row">
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        <!-- TODO: Adicionar Nome da turma aqui -->
                                                        <?php echo "Turma 2002" ?>
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo "Conteúdos" ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        <?php echo "Turma 2002" ?>
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo "Fórum" ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        <?php echo "Turma 2002" ?>
                                                    </div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                <?php echo "Provas" ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        <?php echo "Turma 2002" ?>
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo "Desempenho" ?>

                                                        <!-- Desempenho em porcentagem -->
                                                        <div class="progress progress-sm mr-2">
                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 1%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>
                    <!-- /.container-fluid -->

                    <div>
                        <!-- Titulo da pagina -->
                        <div class="card">
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
                                                if ($StatusConteudo == 1){ echo 'active';} 
                                                if ($StatusConteudo == 2){ echo 'completed';} ?>">
                  
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
                        <div class="card">
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

                                <!-- End of Page Wrapper -->



                                <!-- Scroll to Top Button-->
                                <a class="scroll-to-top rounded" href="#page-top">
                                    <i class="fas fa-angle-up"></i>
                                </a>




                                <!--  Modal Perfil-->
                                <div class="modal fade" id="ModalPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>



                                            <form id="form-perfil" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Nome</label>
                                                                <input value="<?php echo $nome ?>" type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>CPF</label>
                                                                <input value="<?php echo $cpf ?>" type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input value="<?php echo $email ?>" type="email" class="form-control" id="email" name="email" placeholder="Email">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Senha</label>
                                                                <input value="" type="password" class="form-control" id="text" name="senha" placeholder="Senha">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="col-md-12 form-group">
                                                                <label>Foto</label>
                                                                <input value="<?php echo $img ?>" type="file" class="form-control-file" id="imagem" name="imagem" onchange="carregarImg();">

                                                            </div>
                                                            <div class="col-md-12 mb-2">
                                                                <img src="../img/profiles/<?php echo $img ?>" alt="Carregue sua Imagem" id="target" width="100%">
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <small>
                                                        <div id="mensagem" class="mr-4">

                                                        </div>
                                                    </small>



                                                </div>
                                                <div class="modal-footer">



                                                    <input value="<?php echo $idUsuario ?>" type="hidden" name="txtid" id="txtid">
                                                    <input value="<?php echo $cpf ?>" type="hidden" name="antigo" id="antigo">

                                                    <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" name="btn-salvar-perfil" id="btn-salvar-perfil" class="btn btn-primary">Salvar</button>
                                                </div>
                                            </form>


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
</script>

<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>

<df-messenger intent="WELCOME" chat-title="Curumim Assistente" chat-icon="https://imgur.com/tx1neHH.png" agent-id="99180b3c-bb9f-48e7-9282-f6a81556ae57" language-code="pt-br"></df-messenger>
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>

</html>



</div>