<?php 

include_once('./src/conexao.php');
include_once('./src/Model/Produto.php');
include_once('./src/Repositorio/ProdutoRepositorio.php');

if(isset($_POST['id'])){

    $produtoRepositorio = new ProdutoRepositorio($pdo);

    $produtoExcluido = $produtoRepositorio->excluirProduto($_POST['id']);

    if($produtoExcluido){
        header('Location: ./admin.php');
        exit();
    }
}