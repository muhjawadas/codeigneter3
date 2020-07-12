<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>UAS - Data Grid</title>

  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/color.css">
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/demo/demo.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
</head>

<body>
  <div class="easyui-panel" style="padding:5px;">
    <a href="/uas" class="easyui-linkbutton" data-options="plain:true">Dashboard</a>
    <a href="/uas/grid" class="easyui-linkbutton" data-options="plain:true">Data Grid</a>
    <a href="/uas/logout" class="easyui-linkbutton" data-options="plain:true">Logout</a>
  </div>

  <div class="easeyui-panel" style="width: 100%; text-align: center; margin: 10px 0;">
    <span>Search:</span>
    <input id="keyword" style="line-height:26px;border:1px solid #ccc">
    <a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="doSearch()">
      Search
    </a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newSales()">
      New
    </a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editSales()">
      Edit
    </a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteSales()">
      Delete
    </a>
  </div>

  <table id="grid" class="easyui-datagrid" url="/uas/sales" rownumbers="true"  title="Sales" style="width: 100%; height: 250px;">
    <thead>
      <tr>
        <th field="year" width="40%">Year</th>
        <th field="sales" width="30%">Sales</th>
        <th field="purchase" width="30%">Purchase</th>
      </tr>
    </thead>
  </table>

  <div class="easyui-dialog" data-options="closed:true,modal:true,border:'thin',buttons:'#dialog-buttons'" style="width: 400px;">
    <?php
    echo form_open("", array("id" => "form-contact", "style" => "margin: 0; padding: 20px 50px;"));
    ?>
    <table class="ui celled table">
      <tr>
        <td><?= form_input(array("name" => "year", "class" => "easyui-textbox", "label" => "Year:")) ?></td>
      </tr>
      <tr>
        <td><?= form_input(array("name" => "sales", "class" => "easyui-textbox", "label" => "Sales:")) ?></td>
      </tr>
      <tr>
        <td><?= form_input(array("name" => "purchase", "class" => "easyui-textbox", "label" => "Purchase:")) ?></td>
      </tr>
    </table>
    <?= form_close(); ?>
  </div>

  <div id="dialog-buttons">
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveSales()" style="width: 90px;">
      Save
    </a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="closeDialog()" style="width: 90px;">
      Cancel
    </a>
  </div>

  <script type="text/javascript">
    var url;

    function doSearch() {
      $('#grid').datagrid('load', {
        keyword: $('#keyword').val()
      });
    }

    function closeDialog() {
      return $(".easyui-dialog").dialog('close')
    }

    function newSales() {
      $(".easyui-dialog")
        .dialog("open")
        .dialog("center")
        .dialog("setTitle", "New Sales");
      $(".easyui-dialog").form("clear");

      url = "/uas/action_save";
    }

    function editSales() {
      var row = $(".easyui-datagrid").datagrid("getSelected");
      if (row) {
        $(".easyui-dialog")
          .dialog("open")
          .dialog("center")
          .dialog("setTitle", "Edit Sales");
        $(".easyui-dialog").form("load", row);

        url = "/uas/action_save/" + row.id;
      }
    }

    function saveSales() {
      $("#form-contact").form("submit", {
        url: url,
        onSubmit: function() {
          return $(this).form("validate");
        },
        success: function(result) {
          if (result.errorMsg) {
            $.messager.show({
              title: "Error",
              msg: result.errorMsg,
            });
          } else {
            $(".easyui-dialog").dialog("close");
            $(".easyui-datagrid").datagrid("reload");
          }
        },
      });
    }

    function deleteSales() {
      var row = $(".easyui-datagrid").datagrid("getSelected");
      if (row) {
        $.messager.confirm(
          "Confirm",
          "Anda yakin ingin menghapus pengguna ini?",
          function(r) {
            if (r) {
              $.get(
                "/uas/action_delete/" + row.id,
                function(result) {
                  $(".easyui-datagrid").datagrid("reload"); // reload the Sales data
                },
                "json"
              );
            }
          }
        );
      }
    }
  </script>
</body>

</html>