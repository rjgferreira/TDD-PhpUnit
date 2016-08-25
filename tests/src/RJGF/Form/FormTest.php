<?php
namespace RJGF;

use RJGF\Form\Fields;
use RJGF\Form\Request;
use RJGF\Form\Validator;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

class FormTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificaTipoCorretoClasseForm()
    {
        // Verifica se a Classe Form implementa a interface FormGen
        $this->assertInstanceOf('RJGF\Form\Interfaces\FormGen', new \RJGF\Form\Form(new Validator(new Request()),new Fields()));
    }

    public function testPopulateForm(){
        $fields = new Fields();
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
        $form = new \RJGF\Form\Form(new Validator(new Request()), $fields);
        $form->populate($dados);
        $html = $fields->getHtml();
        // Testa o método Populate (esperado um item)
        $this->assertEquals(1, count($html));
    }
}