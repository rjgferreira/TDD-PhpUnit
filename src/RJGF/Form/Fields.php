<?php
namespace RJGF\Form;
use RJGF\Form\Interfaces\FieldGen;

class Fields implements FieldGen
{
    private $html;

    public function __construct(){
        $this->html = array();
    }

    /**
    * @return mixed
    */
    public function getHtml()
    {
        return $this->html;
    }

    /**
    * @param mixed $html
    */
    private function setHtml($html)
    {
        $this->html[] = $html;
    }

    /* Os campos do formulário terão as seguintes configurações
    * type -> ( t = text | e = email | ta = textarea | p = password | s = submit | c = checkbox ) (default = text)
    * cssClass -> form-control (default)
    * fieldset -> o = open | c = close
    * required -> s
    * */
    public function createField($name=null,  $placeholder=null, $label=null, $type=null, $cssClass=null, $required=null, $value=null, $rows=null, $cols=null, $fieldset=null, $legend=null)
    {
        if($fieldset=='o'){
            self::setHtml('<fieldset>');
            if($legend!=null){
                self::setHtml('<legend>'.$legend.'</legend>');
            }
        }
        switch ($type) {
            case null:
            case "t":
                self::setHtml('<div class="form-group"><input name="'.$name.'" type="text" '.($value!=null?' value="'.$value.'"':'').($placeholder!=null?' placeholder="'.$placeholder.'"':'').self::setClass($cssClass).self::setRequired($required).'></div>');
                break;
            case "e":
                self::setHtml('<div class="form-group"><input name="'.$name.'" type="email" '.($value!=null?' value="'.$value.'"':'').($placeholder!=null?' placeholder="'.$placeholder.'"':'').self::setClass($cssClass).self::setRequired($required).'></div>');
                break;
            case "ta":
                self::setHtml('<div class="form-group"><textarea name="'.$name.'" rows="'.$rows.'" cols="'.$cols.'"'.($placeholder!=null?' placeholder="'.$placeholder.'"':'').self::setClass($cssClass).self::setRequired($required).'>'.($value!=null?$value:'').'</textarea></div>');
                break;
            case "p":
                self::setHtml('<div class="form-group"><input name="'.$name.'" type="password" '.($value!=null?' value="'.$value.'"':'').($placeholder!=null?' placeholder="'.$placeholder.'"':'').(self::setClass($cssClass)).self::setRequired($required).'></div>');
                break;
            case "c":
                self::setHtml('<div class="form-group"><input name="'.$name.'" type="checkbox" value="'.$value.'"> '.$label.'</div>');
                break;
            case "sb":
                self::setHtml('<div class="form-group"><input name="'.$name.'" type="submit" '.($value!=null?'value="'.$value.'"':'value="ENVIAR"').self::setClass($cssClass).self::setRequired($required).'></div>');
                break;
            case "sl":
                self::setHtml('<div class="form-group"><select id="'.$name.'" name="'.$name.'" '.self::setClass($cssClass).self::setRequired($required).'>');
                if(is_array($value)){
                    self::setHtml('<option value="0" selected="selected">-------------------------------- Selecionar '.$name.' --------------------------------</option>');
                    foreach($value as $v){
                        self::setHtml('<option value="'.$v['id'].'">'.$v['titulo']."</option>");
                    }
                }
                self::setHtml('</select></div>');
                break;
            default:
                self::setHtml('<div class="form-group"><input name="'.$name.'" type="text" '.($value!=null?' value="'.$value.'"':'').($placeholder!=null?' placeholder="'.$placeholder.'"':'').self::setClass($cssClass).self::setRequired($required).'></div>');
                break;
        }
        if($fieldset=='c') {
            self::setHtml('</fieldset>');
        }
        return $this;
    }

    private function setRequired($v){
        if($v!=null)
            if($v=='s')
                return ' required';
    }


    private function setClass($css){
        if($css==null)
            return ' class="form-control"';
        else
            return ' class="'.$css.'"';
    }

    public function render()
    {
        for($i=0;$i<count($this->html);$i++){
            echo $this->html[$i];
        }
        unset($this->html);
    }

    public function clearHtml(){
        unset($this->html);
    }
}