<?php
namespace RJGF;

class FormTest extends \PHPUnit_Framework_TestCase
{
    private $form,
            $fields,
            $request,
            $validator;

    // setUp é executado antes de cada teste; funciona como um __construct para cada teste a ser executado
    public function setUp(){
        $this->fields = new \RJGF\Form\Fields();
        $this->request = new \RJGF\Form\Request();
        $this->validator = new \RJGF\Form\Validator($this->request);
        $this->form = new \RJGF\Form\Form($this->validator,$this->fields);
    }
    // tearDown é executado depois de cada teste
    public function tearDown(){
        unset($this->form);
    }

    public function testVerificaTipoCorretoClasseForm()
    {
        // Verifica se a Classe Form implementa a interface FormGen
        $this->assertInstanceOf('RJGF\Form\Interfaces\FormGen', $this->form);
    }

    public function testPopulateForm(){
        $dados = array(
            0=>array(
                'name'=>'nome',
                'placeholder'=>'Nome',
                'label'=>'',
                'type'=>'t',
                'cssClass'=>'',
                'required'=>'s',
                'value'=>'',
                'rows'=>'',
                'cols'=>'',
                'fieldset'=>'',
                'legend'=>'')
        );
        $this->form->populate($dados);
        $html = $this->fields->getHtml();
        // Testa o método Populate (esperado um item)
        $this->assertEquals(1, count($html));
    }

    public function testOpenForm(){
        $this->expectOutputString('<form action="" enctype="multipart/form-data" method="POST" class="form">');
        $this->form->openForm();
    }

    public function testCloseForm(){
        $this->expectOutputString('</form>');
        $this->form->closeForm();
    }
}