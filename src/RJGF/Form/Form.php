<?php
namespace RJGF\Form;
use RJGF\Form\Interfaces\FormGen;

class Form implements FormGen
{
    private $action;
    private $method;
    private $enctype;
    private $fields;
    private $validator;
    private $css;

    /* Opções para criação do formulário:
     * action -> null (default)
     * method -> ( p=POST | g=GET ) (default = p)
     * enctype -> ( m = multipart/form-data | a = application/x-www-form-urlencoded ) (default = m)
     * css -> form (default)
     * */

    public function __construct(Validator $validator, Fields $fields, $cssClass = null, $method = null, $enctype = null, $action = null){
        $this->action = self::setFile($action);
        $this->enctype = self::setEnctype($enctype);
        $this->method = self::setMethod($method);
        $this->css = self::setClass($cssClass);
        $this->fields = $fields;
        $this->validator = $validator;
    }

    public function openForm(){
        echo '<form action="'.$this->action.'" enctype="'.$this->enctype.'" method="'.$this->method.'"'.$this->css.'>';
        return $this;
    }

    public function closeForm(){
        echo "</form>";
    }

    public function populate($dados){
        if(is_array($dados)) {
            foreach ($dados as $key => $dado) {
                    $this->fields->createField(
                        $dado['name'],
                        $dado['placeholder'],
                        $dado['label'],
                        $dado['type'],
                        $dado['cssClass'],
                        $dado['required'],
                        $dado['value'],
                        $dado['rows'],
                        $dado['cols'],
                        $dado['fieldset'],
                        $dado['legend']
                    );
                    $this->validator->validate($dado['type'], $dado['name'], $dado['value']);
            }
        }else{
            $this->validator->setMessage('O parâmetro "$dados" precisa ser um array.');
        }
    }

    public function render()
    {
        $messages = $this->validator->getMessage();
        if(count($messages)>0){
            echo '<div class="btn btn-warning" style="width:100%;margin-bottom:10px;">';
            foreach($messages as $message){
               echo $message.'<br>';
            }
            echo "</div>";
        }
        $html = $this->fields->getHtml();
        for($i=0;$i<count($html);$i++){
            echo $html[$i];
        }
        $this->fields->clearHtml();
        return $this;
    }

    private function setMethod($m){
        if($m == 'p')
            return "POST";
        else if($m == 'g')
            return "GET";
        else
            return "POST";
    }

    private function setFile($urlFile){
        if($urlFile!=null)
            if(is_file($urlFile))
                return $urlFile;
    }

    private function setEnctype($e){
        if($e==null||$e=='m')
            return 'multipart/form-data';
        else if($e=='a')
            return 'application/x-www-form-urlencoded';
        else
            return 'multipart/form-data';
    }


    private function setClass($css){
        if($css==null)
            return ' class="form"';
        else
            return ' class="'.$css.'"';
    }
}

