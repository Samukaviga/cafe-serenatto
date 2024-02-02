<?php



class Produto {
    private ?int $id;
    private string $tipo;
    private string $nome;
    private string $descricao;
    private string $imagem;
    private float $preco;

    public function __construct(?int $id, string $tipo, string $nome, string $descricao, float $preco, string $imagem = "logo-serenatto.png")
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->preco = $preco;
    }


    public function getId() : int
    {
        return $this->id;
    }

    public function getNome() : string
    {
        return $this->nome;
    }

    public function getTipo() : string
    {
        return $this->tipo;
    }

    public function getDescricao() : string
    {
        return $this->descricao;
    }

    public function getImagem() : string
    {
        return $this->imagem;
    }

    public function setImagem(string $imagem)
    {
        $this->imagem = $imagem;
    }

    public function getImagemFormatada() : string {

        return "img/" . $this->imagem;
    }

    

    public function getPreco() : string
    {
        return $this->preco;
    }

    public function getPrecoFormatado() 
    {
        return "R$ ". number_format($this->preco, 2);
    }


}