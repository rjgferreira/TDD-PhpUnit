<?php
namespace RJGF;

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
    private $request,
            $validator;

    // setUp é executado antes de cada teste; funciona como um __construct para cada teste a ser executado
    public function setUp(){
        $this->request = new \RJGF\Form\Request();
        $this->validator = new \RJGF\Form\Validator($this->request);
    }
    // tearDown é executado depois de cada teste
    public function tearDown(){
        unset($this->validator);
    }

    public function testEmptyAllParams(){
        $this->validator->validate('','','');
        $msn = $this->validator->getMessage();
        $this->assertEquals(2, count($msn));

        /* Testando o Método clearMessages()
         *  - Elimina todas as mensagens do container.
         * Nenhuma mensagem será retornada. Esperado zero.
         */
        $this->validator->clearMessages();
        $msn = $this->validator->getMessage();
        $this->assertEquals(0, count($msn));
    }
    // Esperada uma mensagem de erro de validação: $value é obrigatório.
    public function testEmptyValue(){
        $this->validator->validate('t','nome','');
        $msn = $this->validator->getMessage();
        $this->assertEquals(1, count($msn));
    }
    // Esperada uma mensagem de erro de validação: Código de elemento inválido.
    public function testWrongParam(){
        $this->validator->validate('w','nome','Sérgio');
        $msn = $this->validator->getMessage();
        $this->assertEquals(1, count($msn));
    }

}