<p>
    <?php
    require_once("../../../conexao.php");
    $sql = "SELECT * FROM postagens WHERE pos_id_pk = 1";
    $result = $pdo->query($sql);
    $row = $result->fetch();
    
    echo $row['pos_texto'];

  

    ?>

</p>

<style>


</style>