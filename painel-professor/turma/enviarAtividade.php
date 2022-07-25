<style>
    /* Exibir novamente UL e LI */
    ul {
        list-style-type: circle;


    }

    ol {
        list-style-type: decimal;
        color: #121212;
    }

    .quest {
        background-color: #f5f5f5;
        font-weight: 600;
        font-size: 1.2rem;
        padding: 1rem;
        width: 90%;
        border-radius: 5px;

    }

    .correta {
        background-color: #d0f0d5;
    }

    /* Aumentar o tamanho da checkbox */
    .form-check-input {
        width: 1.5rem;
        height: 1.5rem;
        position: absolute;
        right: 10px;
        top: 10px;
    }

    /* Personalizando a checkbox */
    .form-check-input:checked~.form-check-label {
        color: #121212;
    }

    /* Label */
    .form-check-label {
        color: #121212;
        font-weight: 600;
        font-size: 1.2rem;
        padding: 1rem;
        width: 90%;

    }

    .par {
        background-color: #e9e9f5;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .form-main {
        margin-bottom: 10%;
    }

    .hide {
        display: none;
    }

    .counter {
        font-size: 1.2rem;
        font-weight: 600;
        color: #121212;
    }

    .counter span {
        font-size: 1.2rem;
        font-weight: 600;
        /* Primary color */
        color: #010101;
    }
</style>

<div class="flex justify-around">
    <div>
        <h3 class="mt-6">Enviar Conteúdo</h3>

        <form action="util/sendConteudo.php?id_turma=<?php echo $_GET['id_turma']?>" method="POST" class="card form-main" style="width:35vw" id="form">
            <div id="form1">
                <div class="d-flex">
                    <div class="form-group card-body">
                        <label for="exampleFormControlTextarea1">Título</label>
                        <input type="text" class="form-control" id="title" name="title" rows="1" required>
                    </div>
                    <div class="form-group card-body flex flex-col w-1/3">
                        <label for="exampleFormControlTextarea1">Tópico</label>
                        <select class="form-control" name="top" id="topico" required>

                            <?php
                            $turma = $_GET['id_turma'];
                            // Recupera a PK da turma
                            $sql = "SELECT tur_id_pk FROM turmas WHERE tur_hash_code = '$turma'";
                            $result = $pdo->query($sql);
                            $turma = $result->fetch();
                            $id_turma_pk = $turma['tur_id_pk'];

                            $sql = "SELECT * FROM topicos WHERE top_id_pk IN (SELECT top_id_fk FROM turma_topicos WHERE tur_id_fk = $id_turma_pk)";
                            $result = $pdo->query($sql);
                            $topicos = $result->fetchAll();
                            foreach ($topicos as $topico) {
                                echo "<option value='" . $topico['top_id_pk'] . "'>" . $topico['top_name'] . "</option>";
                            }



                            ?>
                        </select>
                    </div>
                    <div class="form-group card-body">
                        <label for="">Pré-Requisito</label>
                        <select class="form-control" id="pre" name="pre">
                            <option value="0">Nenhum</option>
                            <?php
                            $sql = "SELECT * FROM postagens WHERE top_id_fk IN (SELECT top_id_fk FROM turma_topicos WHERE tur_id_fk = $id_turma_pk)";
                            $result = $pdo->query($sql);
                            $postagens = $result->fetchAll();
                            foreach ($postagens as $postagem) {
                                echo "<option value='" . $postagem['pos_id_pk'] . "'>" . $postagem['pos_titulo'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group card-body">
                    <label for="exampleFormControlTextarea2">Conteúdo</label>
                    <textarea class="form-control" id="exampleFormControlTextarea2" name="content" required></textarea>
                </div>
            </div>
            <div id="form2">

                <div class="d-flex flex-col">
                    <div class="form-group card-body">
                        <h4>Avaliação</h4>
                        <?php
                        // Recupera todas as palavras chave 
                        $sql = "SELECT * FROM palavras_chave";
                        $result = $pdo->query($sql);
                        $palavras_chave = $result->fetchAll();
                        ?>
                        <div class="d-flex flex" style="flex-wrap: wrap; align-items: center;">
                            <p style="margin-right: 10px;">
                                Selecione as palavras chave:
                            </p>

                            <?php
                            $key = 0;
                            foreach ($palavras_chave as $palavra) {
                                if ($key != 0) {

                                    echo "<div class='form-check form-check-inline d-flex '>
                                            <label> <input type='radio' name='palavras[]' value='" . $palavra['pal_id_pk'] . "' onChange='updateList()'> " . $palavra['pal_texto'] . " </label>
                                        </div>";
                                }else{
                                    echo "<div class='form-check form-check-inline d-flex '>
                                            <label> <input type='radio' name='palavras[]' checked value='" . $palavra['pal_id_pk'] . "' onChange='updateList()'> " . $palavra['pal_texto'] . " </label>
                                        </div>";
                                }
                                $key++;
                            }
                            ?>

                        </div>
                        <div class="d-flex flex" style="flex-wrap: wrap; align-items: center;">
                            <p style="margin-right: 10px;" class="counter">
                                Quantidade de questões selecionadas: <span id="qtd">0</span>
                            </p>
                        </div>



                    </div>
                    <div class="form-group card-body">
                        <?php
                        // Recupera todas as palavras chave 
                        $sql = "SELECT * FROM questoes";
                        $result = $pdo->query($sql);
                        $questoes = $result->fetchAll();
                        $index = 0;
                        ?>
                        <label for="">Questões Relacionadas</label>
                        <?php
                        foreach ($questoes as $questao) {
                            $index++;
                        ?>
                            <div class="form-check card <?php
                                                        // Checa se o index é par
                                                        if ($index % 2 == 0) {
                                                            echo "par ";
                                                        }
                                                        echo "hide hide" . $questao['que_keyword_id_fk'];
                                                        ?>">


                                <input class="form-check-input check" type="checkbox" onchange="recount()" value="<?php echo $questao['que_id_pk']; ?>" id="<?php echo $questao['que_id_pk']; ?>" name="questoes[]">
                                <label class="form-check-label card-body" for="<?php echo $questao['que_id_pk']; ?>"><?php echo $questao['que_texto']; ?></label>

                                <p class="quest <?php if ($questao['que_resposta'] == "A") {
                                                    echo "correta";
                                                } ?>"> Alternativa A: <?php echo $questao['que_alternativa_a']; ?></p>
                                <p class="quest <?php if ($questao['que_resposta'] == "B") {
                                                    echo "correta";
                                                } ?>"> Alternativa B: <?php echo $questao['que_alternativa_b']; ?></p>
                                <p class="quest <?php if ($questao['que_resposta'] == "C") {
                                                    echo "correta";
                                                } ?>"> Alternativa C: <?php echo $questao['que_alternativa_c']; ?></p>
                                <p class="quest <?php if ($questao['que_resposta'] == "D") {
                                                    echo "correta";
                                                } ?>"> Alternativa D: <?php echo $questao['que_alternativa_d']; ?></p>

                            </div>
                        <?php
                        }
                        ?>
                    </div>


                </div>
                <button type="button" class="btn btn-secundary" style="width: 100%;" onclick="back()">Voltar</button>

            </div>


            <button class="btn btn-primary" type="button" onclick="next()" id="btnnext">Próximo</button>

        </form>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../../Packages/Trumbowyg/dist/trumbowyg.min.js"></script>

    <script src="../../Packages/trumbowyg/dist/plugins/upload/trumbowyg.upload.min.js"></script>

    <script>
        // initialize form2
        $('#form2').hide();

        function next() {
            var form1 = document.getElementById("form1");
            var form2 = document.getElementById("form2");
            var btn = document.getElementById("btnnext");
            form1.style.display = "none";
            form2.style.display = "block";
            btn.innerHTML = "Enviar";
            btn.onclick = function() {
                validate();
            };
        }

        function back() {
            var form1 = document.getElementById("form1");
            var form2 = document.getElementById("form2");
            var btn = document.getElementById("btnnext");
            form1.style.display = "block";
            form2.style.display = "none";
            btn.innerHTML = "Próximo";
            btn.onclick = function() {
                next();
            };
        }

        function recount() {
            // Conta quantas questões foram selecionadas
            var qtd = 0;
            var checks = document.getElementsByClassName("check");
            for (var i = 0; i < checks.length; i++) {
                if (checks[i].checked) {
                    qtd++;
                }
            }
            document.getElementById("qtd").innerHTML = qtd;
        }

        var checkedNowRadio = 0;
        var lastCheckedRadio = 0;

        function updateList() {
            var radioboxs = document.getElementsByName("palavras[]");
            
            for (var i = 0; i < radioboxs.length; i++) {
                if (radioboxs[i].checked) {
                    checkedNowRadio = radioboxs[i].value;
                }
            }
            
            hideNotChecked(lastCheckedRadio);
            showChecked(checkedNowRadio);
            lastCheckedRadio = checkedNowRadio;
        }

        function hideNotChecked(hideObj) {
            var element = document.getElementsByClassName("hide" + hideObj);
            for (var i = 0; i < element.length; i++) {
                element[i].style.display = "none";
            }
        }

        function showChecked(hideObj) {
            var element = document.getElementsByClassName("hide" + hideObj);
            for (var i = 0; i < element.length; i++) {
                element[i].style.display = "block";
            }
        }
        updateList();

        function validate() {
            var form = document.getElementById('form');
            var title = document.getElementById("title").value;
            var topico = document.getElementById("topico").value;
            var pre = document.getElementById("pre").value;
            var content = document.getElementById("exampleFormControlTextarea2").value;
            var qtd = document.getElementById("qtd").innerHTML;
            var questoes = document.getElementsByName("questoes[]");


            if (title == "") {
                alert("Preencha o título");
                return false;
            } else if (topico == "") {
                alert("Preencha o tópico");
                return false;
            } else if (pre == "") {
                alert("Preencha o preenchimento");
                return false;
            } else if (content == "") {
                alert("Preencha o conteúdo");
                return false;
            } else if (qtd == "0") {
                alert("Selecione pelo menos uma questão");
                return false;
            } else {
                form.submit();
            }



        }

        $('#exampleFormControlTextarea2').trumbowyg({
            btns: [
                ['viewHTML'],
                ['undo', 'redo'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'], // Only supported in Blink browsers
                ['unorderedList', 'orderedList'],
                ['upload', 'insertImage', 'link'],
                ['superscript', 'subscript'],
                ['formatting', 'strong', 'em', 'del'],
                ['horizontalRule'],
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
            },

            autogrow: true
        });
    </script>

</div>