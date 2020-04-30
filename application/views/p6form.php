<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>P6 - <?=$title?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
</head>
<body>
    <div class="ui top menu">
        <div class="ui container">
            <a class="item" href="/p6">Home</a>
            <a class="active item" href="/p6/form">Form</a>
            <a class="item" href="/p7/logout">Logout</a>
        </div>
    </div>
    <div class="pusher">
        <div class="ui two column grid">
            <div class="two wide column"></div>
            <div class="eight wide column">
                <?=form_open("/p6/save")?>
                <table class="ui celled table">
                    <tr>
                        <td>Name</td>
                        <td><?=form_input( array("name"=>"name", "class"=>"ui input large", "style"=>"width:550px") )?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?=form_input( array("name"=>"address", "class"=>"ui input large", "style"=>"width:550px") )?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><?=form_input( array("name"=>"phone", "class"=>"ui input large", "style"=>"width:550px") )?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <?=form_submit('submit', 'Save', array("class"=>"ui primary button"))?>
                            <?=form_reset('reset', 'Reset', array("class"=>"ui button"))?>
                        </td>
                    </tr>
                </table>
                <?=form_close()?>
            </div>
        </div>
    </div>
</body>
</html>
