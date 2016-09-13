<?php
namespace RJGF;

use RJGF\Form\Request;
use RJGF\Form\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    /*
     * Testando métodos e parâmetros de entrada na classe Validator:
     *
     * Validate($type, $name, $value);
     * getMessages();
     * setMessages();
     * clearMessages();
     *
     * Teste Parâmetros:
     *
     *  Existe valor default apenas para o primeiro parâmetro (quando vasio retorna um input tipo text).
     *  Esperadas duas mensagens de erro de validação.
     *  Os outros dois parâmetros não podem ser vasios.
     */
    public function testEmptyAllParams(){
        $vldt = new Validator(new Request());
        $vldt->validate('','','');
        $msn = $vldt->getMessage();
        $this->assertEquals(2, count($msn));

        /* Testando o Método clearMessages()
         *  - Elimina todas as mensagens do container.
         * Nenhuma mensagem será retornada. Esperado zero.
         */
        $vldt->clearMessages();
        $msn = $vldt->getMessage();
        $this->assertEquals(0, count($msn));
    }
    // Esperada uma mensagem de erro de validação: $value é obrigatório.
    public function testEmptyValue(){
        $vldt = new Validator(new Request());
        $vldt->validate('t','nome','');
        $msn = $vldt->getMessage();
        $this->assertEquals(1, count($msn));
    }
    // Esperada uma mensagem de erro de validação: Código de elemento inválido.
    public function testWrongParam(){
        $vldt = new Validator(new Request());
        $vldt->validate('w','nome','Sérgio');
        $msn = $vldt->getMessage();
        $this->assertEquals(1, count($msn));
    }

}