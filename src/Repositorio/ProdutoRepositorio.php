<?php 



class ProdutoRepositorio {
    
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function objetoFormatado($dados)
    {   
        return new Produto($dados['id'], $dados['tipo'], $dados['nome'], $dados['descricao'], $dados['preco'], $dados['imagem'] );
    }

    public function produtosCafe()
    {
        $sql = "SELECT * FROM produtos WHERE tipo = 'cafe' ORDER BY preco";
        $stmt = $this->pdo->query($sql);
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dados = array_map( function($produto) {

               return $this->objetoFormatado($produto);

        }, $produtos);
    
        return $dados;
    }
    
    
    public function produtosAlmoco()
    {
        $sql = "SELECT * FROM produtos WHERE tipo = 'almoco' ORDER BY preco";
        $stmt = $this->pdo->query($sql);
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $dados = array_map(function($produto) {

            return $this->objetoFormatado($produto);

        }, $produtos);
        
        return $dados;
    } 

    public function todosProdutos()
    {
        $sql = "SELECT * FROM produtos ORDER BY preco";
        $stmt = $this->pdo->query($sql);
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $dados = array_map(function($produto) {

            return $this->objetoFormatado($produto);

        }, $produtos);
        
        return $dados;
    }

    public function excluirProduto(int $id) : bool
    {
        $sql = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function cadastrarProduto(Produto $produto) : bool
    {

        $tipo = $produto->getTipo();
        $nome = $produto->getNome();
        $descricao = $produto->getDescricao();
        $preco = $produto->getPreco();
        $imagem = $produto->getImagem();

        $sql = "INSERT INTO produtos (tipo, nome, descricao, preco, imagem ) VALUES (:tipo, :nome, :descricao, :preco, :imagem)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_INT);
        $stmt->bindParam(':imagem', $imagem, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function buscandoProduto(int $id)
    {
        $sql = "SELECT * FROM produtos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $this->objetoFormatado($dados);
    }

    public function editandoProduto(Produto $produto){
        
        $tipo = $produto->getTipo();
        $nome = $produto->getNome();
        $descricao = $produto->getDescricao();
        $preco = $produto->getPreco();
        $id = $produto->getId();

        $imagem = $produto->getImagem();
        
        if ($imagem == null || empty($imagem)){
            $sql = "UPDATE produtos SET tipo = :tipo, nome = :nome, descricao = :descricao, preco = :preco WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':preco', $preco, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } else {
            $sql = "UPDATE produtos SET tipo = :tipo, nome = :nome, descricao = :descricao, preco = :preco, imagem = :imagem WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':imagem', $imagem, PDO::PARAM_STR);
            $stmt->bindParam(':preco', $preco, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        }

    }



}