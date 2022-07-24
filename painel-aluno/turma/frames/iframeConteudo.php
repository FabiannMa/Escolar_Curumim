<p>
    <?php
    require_once("../../../conexao.php");
    $id = $_GET['id'];

    $sql = "SELECT * FROM postagens WHERE pos_id_pk = $id";
    $result = $pdo->query($sql);
    $row = $result->fetch();
    
    echo $row['pos_texto'];

  

    ?>

</p>

<style>


</style>