<?php
namespace RJGF;

use RJGF\Form\Fields;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

class FieldsTest extends \PHPUnit_Framework_TestCase
{
    /*
     * Testando m�todos e par�metros de entrada na classe Fields:
     *
     * createField($name,  $placeholder, $label, $type, $cssClas, $required, $value, $rows, $cols, $fieldset, $legend);
     *
     * Par�metros:
     * Valor default apenas para o par�metro $type (quando vasio retorna um input tipo text - t).
     * Os outros par�metros tem valor NULL como default.
     *
     * getHtml();
     * setHtml($html) *indireto
     * setClass() *indireto
     *
     */

    public function testVerificaTipoCorretoClasseField()
    {
        // Verifica se a Classe Field implementa a interface FieldGen
        $this->assertInstanceOf('RJGF\Form\Interfaces\FieldGen', new \RJGF\Form\Fields);
    }

    public function testFieldParams(){
        $flds = new Fields();
        $flds->createField('nome','Nome');
        $html = implode('',$flds->getHtml());
        // Testa valor padr�o para o par�metro Type (esperada 1 ocorr�ncia)
        $this->assertEquals(1, substr_count($html, 'type="text"'));
        // Testa valor do par�metro Placeholder (esperada 1 ocorr�ncia)
        $this->assertEquals(1, substr_count($html, 'placeholder="Nome"'));
        // Testa valor do par�metro Name (esperada 1 ocorr�ncia)
        $this->assertEquals(1, substr_count($html, 'name="nome"'));
        // Testa valor padr�o do par�metro cssClass (esperada 1 ocorr�ncia)
        $this->assertEquals(1, substr_count($html, 'class="form-control"'));
    }
}