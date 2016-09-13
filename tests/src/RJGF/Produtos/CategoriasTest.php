<?php
namespace RJGF;

use RJGF\Form\Request;
use RJGF\Produtos\Categorias;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

class CategoriasTest extends \PHPUnit_Framework_TestCase
{

    public function testVerificaTipoCorretoClasseCategorias()
    {
        // Verifica se a Classe Categorias implementa a interface CategoriasGen
        $this->assertInstanceOf('RJGF\Produtos\Interfaces\CategoriasGen', new \RJGF\Produtos\Categorias(new \PDO('sqlite:src/RJGF/Produtos/categorias.sqlite3')));
    }

    public function testGetCategorias(){
        $cat = new Categorias(new \PDO('sqlite:src/RJGF/Produtos/categorias.sqlite3'));
        $categorias = $cat->getCategorias();
        // Esperado array com cinco itens
        $this->assertEquals(5, count($categorias));
    }
}