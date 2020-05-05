<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>P7 - Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
</head>
<body>
    <div class="ui top menu">
        <div class="ui container">
            <a class="active item" href="/p7">Login</a>
        </div>
    </div>
    <div class="pusher">
        <div class="ui two column grid">
            <div class="two wide column"></div>
            <div class="eight wide column">
                <?php
                    if (isset($msg)) echo $msg;
                    echo form_open("/p7/login");
                ?>
                <table class="ui celled table">
                    <tr>
                        <td>Username</td>
                        <td><?=form_input( array("name"=>"username", "class"=>"ui input large", "style"=>"width:550px") )?></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><?=form_input( array("name"=>"password", "class"=>"ui input large", "style"=>"width:550px") )?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <?=form_submit('submit', 'Login', array("class"=>"ui primary button"))?>
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