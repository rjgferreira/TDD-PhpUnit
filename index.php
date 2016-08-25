<?php
define('CLASS_DIR','src/');
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register();
$fields = new \RJGF\Form\Fields();
$request = new \RJGF\Form\Request();
$validator = new \RJGF\Form\Validator($request);
$categorias = new \RJGF\Produtos\Categorias(new PDO('sqlite:src/RJGF/Produtos/categorias.sqlite3'));
$dados = array(
    0=>array(
        'name'=>'nome',
        'placeholder'=>'Nome',
        'label'=>'',
        'type'=>'t',
        'cssClass'=>'',
        'required'=>'s',
        'value'=>(isset($_POST['nome'])?$_POST['nome']:''),
        'rows'=>'',
        'cols'=>'',
        'fieldset'=>'o',
        'legend'=>'Produto'),
    1=>array(
        'name'=>'valor',
        'placeholder'=>"Pre&ccedil;o",
        'label'=>'',
        'type'=>'t',
        'cssClass'=>'',
        'required'=>'s',
        'value'=>(isset($_POST['valor'])?(int)$_POST['valor']:'Hum mil, quinhentos e cinquenta reais'),
        'rows'=>'',
        'cols'=>'',
        'fieldset'=>'',
        'legend'=>''),
    2=>array(
        'name'=>'descricao',
        'placeholder'=>"Descri&ccedil;&atilde;o",
        'label'=>'',
        'type'=>'t',
        'cssClass'=>'',
        'required'=>'s',
        'value'=>(isset($_POST['descricao'])?$_POST['descricao']:'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'),
        'rows'=>'',
        'cols'=>'',
        'fieldset'=>'',
        'legend'=>''),
    3=>array(
        'name'=>'categoria',
        'placeholder'=>'',
        'label'=>'',
        'type'=>'sl',
        'cssClass'=>'',
        'required'=>'s',
        'value'=>$categorias->getCategorias(),
        'rows'=>'',
        'cols'=>'',
        'fieldset'=>'',
        'legend'=>''),
    4=>array(
        'name'=>'',
        'placeholder'=>'',
        'label'=>'',
        'type'=>'sb',
        'cssClass'=>'btn btn-primary pull-right',
        'required'=>'',
        'value'=>'Cadastrar',
        'rows'=>'',
        'cols'=>'',
        'fieldset'=>'c',
        'legend'=>'')
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Design Pattern - FormGen</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{font-family: "Open Sans"; }
        legend{font-size:16px;}
    </style>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="row">
    <div class="container">
        <br>
        <div class="col-lg-offset-3 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Cadastro</h4></div>
                <div class="panel-body">
                    <?php
                    $form = new \RJGF\Form\Form($validator, $fields, 'form','p','m');
                    $form->openForm();
                    $form->populate($dados);
                    //$fields->createField('nome','Nome','','t');
                    $form->render();
                    $form->closeForm();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
