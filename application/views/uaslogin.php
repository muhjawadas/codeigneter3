<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>UAS - Login</title>

  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/color.css">
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/demo/demo.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>

  <style>
    .panel {
      margin: 0 auto;
    }
  </style>
</head>

<body>
  <div class="easyui-panel" title="Login Form" style="width:100%;max-width:400px;padding:30px 60px;">
    <form id="login-form" method="post">
      <div style="margin-bottom:20px">
        <input class="easyui-textbox" name="username" style="width:100%" data-options="label:'User:'">
      </div>
      <div style="margin-bottom:20px">
        <input class="easyui-textbox" name="password" style="width:100%" data-options="label:'Password:'" type="password">
      </div>
    </form>
    <div style="text-align:center;padding:5px 0">
      <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()" style="width:80px">Submit</a>
    </div>
  </div>

  <script type="text/javascript">
    function submitForm() {
      $("#login-form").form("submit", {
        url: '/uas/action_login',
        onSubmit: function() {
          return $(this).form("validate");
        },
        success: function(result) {
          if (result !== 'valid') {
            $.messager.show({
              title: "Error",
              msg: result,
            });
          } else {
            window.location = "/uas";
          }
        },
      });
    }
  </script>
</body>

</html>