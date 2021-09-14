<?php
    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: index.php");
        exit;
    }
?>

<img src="_imagens/img05.jpg" width="400px" height="400px">
<h1>SEJA BEM VINDO</h1>
<h2>seja bem vindo</h2>

<style>
    body{
        background-color: green;
    }
    h1{
        color: white;
        background-color: black;
    }

    h2 {
        text-align: center;
        font-size: 100pt;
        font-family: monospace;
        border: solid black 5px;

    }
</style>