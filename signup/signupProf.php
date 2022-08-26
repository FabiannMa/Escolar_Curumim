<?php
require_once("../conexao.php");


?>
<!DOCTYPE html>
<html>

<head>
    <title>Sistema CURUMIM</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <meta charset='UTF-8'>
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
    <link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
    <link rel="canonical" href="https://codepen.io/frytyler/pen/EGdtg" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js'></script>

    <link rel="shortcut icon" href="img/icone.ico" type="image/x-icon">
    <link rel="icon" href="img/icone.ico" type="image/x-icon">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">



    <style type="text/css">
        .bg-gradient-primary {
            background-image: linear-gradient(180deg, #5a5c69 10%, #292938 100%);
            background-size: cover;
        }

        .txt-primary {
            color: #4e73df;
        }
    </style>

</head>

<body>



    <div class="flex justify-between">
        <div class="flex flex-col min-h-screen bg-gradient-primary justify-center items-center w-2/4">
            <img src="../img/logo1.png" width="300">
        </div>
        <aside class="flex justify-center bg-slate-50 w-2/4">
            <form method="post" id="form" enctype="multipart/form-data" action="cadastrarProf.php" class="flex flex-col justify-center w-2/3">
                <h1 class="w-full text-center text-3xl mb-6 font-medium text-primary">
                    Registrar-se
                </h1>
                <!-- Foto de perfil -->
                <div class="flex justify-center">
                    <label for="foto" class="flex justify-center items-center">
                        <img src="../img/sem-foto.jpg" width="100" style="
                        border-radius: 50%;
                        border: 2px solid #fff;
                        object-fit: cover;
                        height:100px;
                        width:100px" id="fotoLabel">
                        <input type="file" name="fotosend" required id="foto" class="hidden" accept=" .jpg, .png, .jpeg">
                    </label>
                </div>

                <div class="flex flex-col w-full ">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nome">
                        Nome
                    </label>
                    <div class="flex flex-row justify-beetwen">
                        <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="nome" placeholder="Nome" required>
                        <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="lastname" type="text" name="sobrenome" placeholder="Sobrenome" required>

                    </div>
                </div>
                <div class="flex flex-col w-full mb-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        E-mail
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" placeholder="E-mail" required>
                </div>
                <div class="flex flex-col w-full ">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Senha
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="senha" placeholder="**********" required>
                </div>
                <div class="flex flex-col w-full ">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Confirmar Senha
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="passwordconfirm" type="password" name="senha2" placeholder="**********" required>
                </div>
                <div class="flex flex-col w-full ">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cpf">
                        CPF
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="cpf" type="number" name="cpf" placeholder="CPF" required>
                </div>

                <div class="flex flex-col w-full mb-4">
                    <button class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline" type="button" onclick="verifyIfAllHasValue()">
                        Entrar
                    </button>
                </div>
                <!-- Alerta para senhas diferentes -->
                <span class="text-red-500 text-sm font-bold" id="alertaForm" >
                    
                </span>

                <div class="flex justify-end m-6">

                    <div>
                        <!-- TODO: Criar Página de Registro -->
                        <small>
                            <a href="../" class="text-indigo-500 underline">
                                <i class="fas fa-user-plus"></i>
                                Já possuo uma conta
                            </a>
                        </small>
                    </div>
                </div>

            </form>
        </aside>
    </div>
    </script>
</body>

<script type="text/javascript">
    document.getElementById('foto').onchange = function() {
        var reader = new FileReader();

        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById('fotoLabel').src = e.target.result;
            
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };

    function verifyIfAllHasValue() {
        var campoNome = document.getElementsByName('nome')[0].value;
        var campoSobrenome = document.getElementsByName('sobrenome')[0].value;
        var campoEmail = document.getElementsByName('email')[0].value;
        var campoSenha = document.getElementsByName('senha')[0].value;
        var campoSenha2 = document.getElementsByName('senha2')[0].value;
        var campoCPF = document.getElementsByName('cpf')[0].value;
        var campoFoto = document.getElementsByName('fotosend')[0].value;
    
        if (campoNome == "" || campoSobrenome == "" || campoEmail == "" || campoSenha == "" || campoSenha2 == "" || campoCPF == "" || campoFoto == "") {
            document.getElementById('alertaForm').innerHTML = "Preencha todos os campos";
        } else {
            verifyIfPasswordsMatch();
        }

    }

    function verifyIfPasswordsMatch() {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('passwordconfirm').value;

        if (password != confirmPassword) {
            document.getElementById('alertaForm').innerHTML = "As senhas não coincidem";
        } else {
            var cpf = document.getElementById('cpf').value;
            if (validateCPF(cpf)) {
                document.getElementById('form').submit();
                
            } else {
                document.getElementById('alertaForm').innerHTML = "CPF inválido";
            }
        }
    }

    function validateCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g, '');
        if (cpf == '') return false;
        // Elimina CPFs invalidos conhecidos
        if (cpf.length != 11 ||
            cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999")
            return false;
        // Valida 1o digito
        add = 0;
        for (i = 0; i < 9; i++)
            add += parseInt(cpf.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(9)))
            return false;
        // Valida 2o digito 
        add = 0;
        for (i = 0; i < 10; i++)
            add += parseInt(cpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(10)))
            return false;
        return true;
    }
</script>

</html>