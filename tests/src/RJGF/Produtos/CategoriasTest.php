<?php
namespace RJGF;

use RJGF\Produtos\Categorias;

class CategoriasTest extends \PHPUnit_Framework_TestCase
{
    private $categorias;

    // setUp é executado antes de cada teste; funciona como um __construct para cada teste a ser executado
    public function setUp(){
        $this->categorias = new \RJGF\Produtos\Categorias(new \PDO('sqlite:src/RJGF/Produtos/categorias.sqlite3'));
    }
    // tearDown é executado depois de cada teste
    public function tearDown(){
        unset($this->categorias);
    }
    public function testVerificaTipoCorretoClasseCategorias()
    {
        // Verifica se a Classe Categorias implementa a interface CategoriasGen
        $this->assertInstanceOf('RJGF\Produtos\Interfaces\CategoriasGen', $this->categorias);
    }

    public function testGetCategorias(){
        $categorias = $this->categorias->getCategorias();
        // Esperado array com cinco itens
        $this->assertEquals(5, count($categorias));
    }
}