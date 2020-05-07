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
                <?= form_open_multipart("/p6/save", array("class" => "ui form")); ?>
                <?= form_input( array("name" => "id", "type" => "hidden", "value" => isset($id) ? $id : "") ); ?>
                <table class="ui celled table">
                    <tr>
                        <td>Name</td>
                        <td>
                            <div class="field">
                                <?=form_input( array("name"=>"name", "class"=>"ui input large", "style"=>"width:550px", "value" => isset($contacts) ? $contacts[0]->name : "" ) )?>
                            </div>
                        </td>
                        </tr>
                        <tr>
                       <td>Address</td>
                       <td>
                            <div class="field">
                                <?=form_input( array("name"=>"address", "class"=>"ui input large", "style"=>"width:550px", "value" => isset($contacts) ? $contacts[0]->address  : "") )?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>
                            <div class="field">
                                <?=form_input( array("name"=>"phone", "class"=>"ui input large", "style"=>"width:550px", "value" => isset($contacts) ? $contacts[0]->phone : "") )?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Picture Profile</td>
                        <td>
                            <?php if (isset($contacts) && isset($contacts[0]->picture)) { ?>
                                <img src="/assets/<?=$contacts[0]->picture?>" alt="<?=$contacts[0]->name?>">
                            <?php } ?>
                            <div class="field"> 
                                <input type="file" name="userfile" size="20" />
                            </div>
                        </td>
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
