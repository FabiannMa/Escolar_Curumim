<style>
    /* Exibir novamente UL e LI */
    ul {
        list-style-type: circle;


    }

    ol {
        list-style-type: decimal;
        color: #121212;
    }
</style>

<div class="flex justify-around">
    <div>
        <h3 class="mt-6">ADICIONAR QUESTÃO</h3>

        <form action="util/sendQuest.php" method="POST" class="card" style="width:35vw">

            <div class="form-group card-body">
                <label for="exampleFormControlTextarea2">Descreva o enunciado da questão:</label>
                <textarea class="form-control" id="exampleFormControlTextarea2" name="content" required></textarea>
            </div>
            <div class="flex">
                <div class="form-group card-body">
                    <label for="exampleFormControlTextarea2">Alternativa A:</label>
                    <textarea class="form-control" name="altA" required></textarea>
                </div>
                <div class="form-group card-body">
                    <label for="exampleFormControlTextarea2">Alternativa B:</label>
                    <textarea class="form-control" name="altB" required></textarea>
                </div>
            </div>
            <div class="flex">
                <div class="form-group card-body">
                    <label for="exampleFormControlTextarea2">Alternativa C:</label>
                    <textarea class="form-control" name="altC" required></textarea>
                </div>
                <div class="form-group card-body">
                    <label for="exampleFormControlTextarea2">Alternativa D:</label>
                    <textarea class="form-control" name="altD" required></textarea>
                </div>
            </div>
            <div class="flex">

                <div class="form-group card-body">
                    <label for="exampleFormControlTextarea2"> Alternativa Correta:</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="correta" required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
                <div class="form-group card-body">
                    <label for="exampleFormControlTextarea2">Peso:</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="peso" required>
                        <option value="Básico">Básico</option>
                        <option value="Intermediário">Intermediário</option>
                        <option value="Avançado">Avançado</option>
                    </select>
                </div>

                <div class="form-group card-body">
                    <label for="exampleFormControlTextarea2">Palavras chave:</label>
                    <select class="form-control" id="exampleFormControlSelect2" name="keywords">

                        <?php
                        require_once("../../conexao.php");
                        $sql = "SELECT * FROM palavras_chave";
                        $result = $pdo->query($sql);
                        while ($row = $result->fetch()) {
                            echo "<option value='" . $row['pal_id_pk'] . "'>" . $row['pal_texto'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

            </div>



            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../../Packages/Trumbowyg/dist/trumbowyg.min.js"></script>

    <script src="../../Packages/trumbowyg/dist/plugins/upload/trumbowyg.upload.min.js"></script>

    <script>
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