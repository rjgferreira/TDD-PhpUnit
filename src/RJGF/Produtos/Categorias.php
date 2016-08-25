<?php
namespace RJGF\Produtos;
use RJGF\Produtos\interfaces\CategoriasGen;

class Categorias implements CategoriasGen
{
    private $conexao;

    function __construct(\PDO $conexao){
        $this->conexao = $conexao;
        $this->conexao->setAttribute(\PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION);
    }

    public function getCategorias(){
        $sttm = $this->conexao->prepare('SELECT * FROM categorias');
        $sttm->execute();
        return $sttm->fetchAll();
    }
}