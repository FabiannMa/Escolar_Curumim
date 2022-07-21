<?php
// Conexão com o banco de dados
require_once("../conexao.php");

?>
<style type="text/css">
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
</style>
<div class="popup">
    <div class="popHeader">
        <h1 id="tituloConteudo">

        </h1>
        <div class="close" onclick="closePopup()">&times;</div>
    </div>
    <div class="popBody">
        <div class="keywords">
            <span class="keyword">
                <p>Geometria</p>
            </span>
        </div>
        <div class="popText">
            <p id="textoConteudo">Ao clicar em "Sim", o conteúdo será excluído permanentemente.</p>
        </div>
    </div>
    <div class="popFooter">
        <button class="btn btn-primary" id="btn-ok">Iniciar Avaliação</button>
    </div>
</div>