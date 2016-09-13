<?php
namespace RJGF\Form;
class Validator
{
    private $request;
    private $message;

    public function __construct(Request $request){
        $this->request = $request;
        $this->message = array();
    }

    public function validate($type, $name, $value){
        switch ($type) {
            case '':
            case 't':
                if($name == '' || empty($name))
                    self::setMessage("Input precisa ser nomeado.");
                if ($value == '' || empty($value))
                    self::setMessage("O campo \"$name\" &eacute; requerido.");
                if ($name == 'descricao')
                    if (strlen($value) > 200)
                        self::setMessage("O campo \"$name\" suporta somente 200 caracteres.");
                if ($name == 'valor')
                    if (!is_int($value))
                        self::setMessage("O campo \"Pre&ccedil;o\" deve ser num&eacute;rico.");
                break;
            case 'sl':
                if($value==0){
                    self::setMessage("Selecione uma categoria para o produto.");
                }
                break;
            default:
                self::setMessage("O c&oacute;digo do elemento n&atilde;o &eacute; reconhecido.");
                break;
        }
    }

    public function setMessage($msn){
        $this->message[] = $msn;
    }

    public function getMessage(){
        return $this->message;
    }

    public function clearMessages(){
        $this->message = array();
    }
}