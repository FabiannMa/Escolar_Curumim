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
        <h3 class="mt-6">Enviar Conteúdo</h3>

        <form action="util/sendConteudo.php" method="POST" class="card" style="width:35vw">
            <div class="d-flex">
                <div class="form-group card-body">
                    <label for="exampleFormControlTextarea1">Título</label>
                    <input type="text" class="form-control" id="exampleFormControlTextarea1" name="title" rows="1" required>
                </div>
                <div class="form-group card-body flex flex-col w-1/3">
                    <label for="exampleFormControlTextarea1">Tópico</label>
                    <select class="form-control" name="top" required>

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
            </div>

            <div class="form-group card-body">
                <label for="exampleFormControlTextarea2">Conteúdo</label>
                <textarea class="form-control" id="exampleFormControlTextarea2" name="content" required></textarea>
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