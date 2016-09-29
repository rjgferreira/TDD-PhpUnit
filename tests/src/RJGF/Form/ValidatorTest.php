<?php
namespace RJGF;

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
    private $request,
            $validator;

    // setUp � executado antes de cada teste; funciona como um __construct para cada teste a ser executado
    public function setUp(){
        $this->request = new \RJGF\Form\Request();
        $this->validator = new \RJGF\Form\Validator($this->request);
    }
    // tearDown � executado depois de cada teste
    public function tearDown(){
        unset($this->validator);
    }

    public function testEmptyAllParams(){
        $this->validator->validate('','','');
        $msn = $this->validator->getMessage();
        $this->assertEquals(2, count($msn));

        /* Testando o M�todo clearMessages()
         *  - Elimina todas as mensagens do container.
         * Nenhuma mensagem ser� retornada. Esperado zero.
         */
        $this->validator->clearMessages();
        $msn = $this->validator->getMessage();
        $this->assertEquals(0, count($msn));
    }
    // Esperada uma mensagem de erro de valida��o: $value � obrigat�rio.
    public function testEmptyValue(){
        $this->validator->validate('t','nome','');
        $msn = $this->validator->getMessage();
        $this->assertEquals(1, count($msn));
    }
    // Esperada uma mensagem de erro de valida��o: C�digo de elemento inv�lido.
    public function testWrongParam(){
        $this->validator->validate('w','nome','S�rgio');
        $msn = $this->validator->getMessage();
        $this->assertEquals(1, count($msn));
    }

}