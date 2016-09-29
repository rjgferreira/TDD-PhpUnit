<?php
namespace RJGF;

use RJGF\Form\Fields;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

class FieldsTest extends \PHPUnit_Framework_TestCase
{
    /*
     * Testando métodos e parâmetros de entrada na classe Fields:
     *
     * createField($name,  $placeholder, $label, $type, $cssClas, $required, $value, $rows, $cols, $fieldset, $legend);
     *
     * Parâmetros:
     * Valor default apenas para o parâmetro $type (quando vasio retorna um input tipo text - t).
     * Os outros parâmetros tem valor NULL como default.
     *
     * getHtml();
     * setHtml($html) *indireto
     * setClass() *indireto
     *
     */

    private $fields;

    // setUp é executado antes de cada teste; funciona como um __construct para cada teste a ser executado
    public function setUp(){
        $this->fields = new \RJGF\Form\Fields();
    }

    // tearDown é executado depois de cada teste
    public function tearDown(){
        unset($this->fields);
    }

    public function testVerificaTipoCorretoClasseField()
    {
        // Verifica se a Classe Field implementa a interface FieldGen
        $this->assertInstanceOf('RJGF\Form\Interfaces\FieldGen', $this->fields);
    }

    public function testFieldParams(){
        $this->fields->createField('nome','Nome');
        $html = implode('',$this->fields->getHtml());
        // Testa valor padrão para o parâmetro Type (esperada 1 ocorrência)
        $this->assertEquals(1, substr_count($html, 'type="text"'));
        // Testa valor do parâmetro Placeholder (esperada 1 ocorrência)
        $this->assertEquals(1, substr_count($html, 'placeholder="Nome"'));
        // Testa valor do parâmetro Name (esperada 1 ocorrência)
        $this->assertEquals(1, substr_count($html, 'name="nome"'));
        // Testa valor padrão do parâmetro cssClass (esperada 1 ocorrência)
        $this->assertEquals(1, substr_count($html, 'class="form-control"'));
    }
}