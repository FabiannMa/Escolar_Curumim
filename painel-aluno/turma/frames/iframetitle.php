<style>
    h1 {

        margin-left: 60px;
        font-size: 2em;
        font-weight: bold;
        display: flex;
        align-items: center;
        font: 700 2em 'Inter', sans-serif;
        justify-content: space-between;
        color: #6d6d6d;
    }
</style>



<h1 class="tituloConteudo">
    <?php
    require_once("../../../conexao.php");
    $id = $_GET['id'];

    $sql = "SELECT * FROM postagens WHERE pos_id_pk = $id";
    $result = $pdo->query($sql);
    $row = $result->fetch();

    echo $row['pos_titulo'];



    ?>
</h1>