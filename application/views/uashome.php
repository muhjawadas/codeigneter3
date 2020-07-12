<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>UAS - Dashboard</title>

  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/color.css">
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/demo/demo.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>

<body>
  <div class="easyui-panel" style="padding:5px;">
    <a href="/uas" class="easyui-linkbutton" data-options="plain:true">Dashboard</a>
    <a href="/uas/grid" class="easyui-linkbutton" data-options="plain:true">Data Grid</a>
    <a href="/uas/logout" class="easyui-linkbutton" data-options="plain:true">Logout</a>
  </div>

  <div class="easeyui-panel" style="width: 100%; text-align: center; margin: 10px 0;">
    <a href="#" class="easyui-linkbutton" iconCls="icon-filter" plain="true" onclick="filterChart()">
      Filter
    </a>
    <a href="/uas/download_pdf" class="easyui-linkbutton" iconCls="icon-save" plain="true">
      Download PDF
    </a>
    <a href="/uas/download_xls" class="easyui-linkbutton" iconCls="icon-save" plain="true">
      Download XLS
    </a>
  </div>

  <div id="p" class="easyui-panel" title="Report" style="width:100%; height:300px;padding:10px;">
    <div id="myfirstchart" style="height: 300px;"></div>
  </div>

  <div class="easyui-dialog" data-options="closed:true,modal:true,border:'thin',buttons:'#dialog-buttons'" style="width: 400px;">
    <?php
    echo form_open("", array("id" => "form-contact", "style" => "margin: 0; padding: 20px 50px;"));
    ?>
    <table class="ui celled table">
      <tr>
        <td>
          <label>
            Start:
            <input class="easyui-combobox" name="start" data-options="valueField:'year',textField:'year',url:'/uas/get_year'">
          </label>
        </td>
      </tr>
      <tr>
        <td>
          <label>
            End: &nbsp;
            <input class="easyui-combobox" name="end" data-options="valueField:'year',textField:'year',url:'/uas/get_year'">
          </label>
        </td>
      </tr>
    </table>
    <?= form_close(); ?>
  </div>

  <div id="dialog-buttons">
    <a href="#" class="easyui-linkbutton" iconCls="icon-filter" onclick="loadData()" style="width: 90px;">
      Filter
    </a>
  </div>

  <script type="text/javascript">
    var isDialog;

    function closeDialog() {
      return $(".easyui-dialog").dialog('close')
    }

    function filterChart() {
      isDialog = true
      $(".easyui-dialog")
        .dialog("open")
        .dialog("center")
        .dialog("setTitle", "Filter Chart");
      $(".easyui-dialog").form("clear");
    }

    function loadData() {
      var start, end;

      if (isDialog) {
        closeDialog()
        isDialog = null

        start = document.querySelector('[name="start"]').value
        end = document.querySelector('[name="end"]').value
      }

      $.get('/uas/sales?start=' + start + '&end=' + end, function(result) {
        var data = JSON.parse(result)
        $("#myfirstchart").empty();
        new Morris.Line({
          element: 'myfirstchart',
          data: data,
          xkey: 'year',
          lineColors: ['#2c5870', '#41b4f2'],
          ykeys: ['sales', 'purchase'],
          labels: ['Sales', 'Purchase']
        });
      })
    }

    loadData()
  </script>
</body>

</html>