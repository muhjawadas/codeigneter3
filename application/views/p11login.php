<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Pertemuan 11 - Login</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css"/>
    </head>
    <body>
        <div class="ui top menu">
            <div class="ui container">
                <a class="item" href="/p11">Home</a>
            </div>
        </div>
        <div class="pusher">
            <div class="ui two column grid">
                <div class="four wide column"></div>
                <div class="eight wide column">
                    <?= form_open("/p11/login", array("class" => "ui form")) ?>
                    <table class="ui celled table">
                        <tr>
                            <td>Username</td>
                            <td>
                                <div class="field">
                                    <?= form_input( array("name" => "username", "class" => "ui input large", "value" => "admin") ) ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>
                                <div class="field">
                                    <?= form_input( array("name" => "password", "type" => "password", "class" => "ui input large", "value" => "123") ) ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <?= form_submit('submit', 'Save', array("class" => "ui primary button")) ?>
                                <?= form_submit('reset', 'Reset', array("class" => "ui button")) ?>
                            </td>
                        </tr>
                    </table>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
    </body>
</html>