<?php
defined('BASEPATH') OR exit(    'No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>P5 - <?=$title?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/p5">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/p5/form">Form</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/p5/form_b">Form Boostrap</a>
                </li>
            </ul>
        </div>
    </nav>
    <main role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-0">
                <?=form_open("/p5/save")?>
                <table class="table table-bordered">
                    <tr>
                        <td>Name</td>
                        <td><?=form_input( array("name"=>"name", "class"=>"form-control") )?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?=form_textarea( array("name"=>"address", "class"=>"form-control") )?></td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td><?=form_input( array("name"=>"phone", "class"=>"form-control") )?></td>
                    </tr>
                    <tr>
                        <td>Makanan Favorit</td>
                        <td>
                            <?=form_checkbox( array("name"=>"es_krim", "class"=>"ui input large") )?>&nbsp; Es Krim<br>
                            <?=form_checkbox( array("name"=>"bubble_tea", "class"=>"ui input large") )?>&nbsp; Bubble Tea<br>
                            <?=form_checkbox( array("name"=>"martabak", "class"=>"ui input large") )?>&nbsp; Martabak
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?=form_submit('submit', 'Save', array("class"=>"btn btn-primary"))?></td>
                    </tr>
                </table>
                <?=form_close()?>
            </div>
        </div>
    </div>
</body>
</html>
