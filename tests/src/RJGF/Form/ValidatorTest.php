<?php
namespace RJGF;

use RJGF\Form\Request;
use RJGF\Form\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    /*
     * Testando m�todos e par�metros de entrada na classe Validator:
     *
     * Validate($type, $name, $value);
     * getMessages();
     * setMessages();
     * clearMessages();
     *
     * Teste Par�metros:
     *
     *  Existe valor default apenas para o primeiro par�metro (quando vasio retorna um input tipo text).
     *  Esperadas duas mensagens de erro de valida��o.
     *  Os outros dois par�metros n�o podem ser vasios.
     */
    public function testEmptyAllParams(){
        $vldt = new Validator(new Request());
        $vldt->validate('','','');
        $msn = $vldt->getMessage();
        $this->assertEquals(2, count($msn));

        /* Testando o M�todo clearMessages()
         *  - Elimina todas as mensagens do container.
         * Nenhuma mensagem ser� retornada. Esperado zero.
         */
        $vldt->clearMessages();
        $msn = $vldt->getMessage();
        $this->assertEquals(0, count($msn));
    }
    // Esperada uma mensagem de erro de valida��o: $value � obrigat�rio.
    public function testEmptyValue(){
        $vldt = new Validator(new Request());
        $vldt->validate('t','nome','');
        $msn = $vldt->getMessage();
        $this->assertEquals(1, count($msn));
    }
    // Esperada uma mensagem de erro de valida��o: C�digo de elemento inv�lido.
    public function testWrongParam(){
        $vldt = new Validator(new Request());
        $vldt->validate('w','nome','S�rgio');
        $msn = $vldt->getMessage();
        $this->assertEquals(1, count($msn));
    }

}