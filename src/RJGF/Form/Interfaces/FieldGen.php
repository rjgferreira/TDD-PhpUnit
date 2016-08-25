<?php
namespace RJGF\Form\Interfaces;

interface FieldGen
{
    public function createField($name=null, $placeholder=null, $label=null, $type=null, $css=null, $required=null, $value=null, $cols=null, $rows=null, $fieldset=null);
    public function render();
}