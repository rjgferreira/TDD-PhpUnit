<?php
namespace RJGF\Form\Interfaces;
use RJGF\Form\Validator;
use RJGF\Form\Fields;
interface FormGen{
    public function __construct(Validator $validator, Fields $fields, $css=null, $method=null, $enctype=null, $action=null);
    public function render();
}