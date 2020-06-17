<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8u">
    <title>Pertemuan 14</title> 
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css"> 
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/demo/demo.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
</head>
<body>
    <div class="easeyui-panel" id="menu" style="width:700px;text-align:center">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteUser()">Delete</a>
    </div>
    <table 
        id="datagrid-contacts"
        class="easyui-datagrid"
        title="My Contacts"
        style="width: 700px; height: 250px;"
        data-options="singeSelect:true,collapsible:true,url:'/p14/data14',method:'get'" 
    >
        <thead>
            <tr>
                <th data-options="field:'id'" width="10%">ID</th>
                <th data-options="field:'name'" width="30%">Name</th>
                <th data-options="field:'address'" width="40%">Address</th>
                <th data-options="field:'phone'" width="20%">Phone</th>
            </tr>
        </thead>
    </table>
    <div 
        id="form-dialog"
        class="easyui-dialog"
        style="width:400px;"
        data-options="closed:true,modal:true,border:'thin',buttons:'#form-dialog-buttons'" 
    >
        <?php
            echo form_open("", array("id" => "form-contact", "style" => "margin: 0; padding: 20px 50px;"));
        ?>
        <table class="ui celled table">
            <tr>
                <td><?= form_input(array("name" => "name", "class" => "easyui-textbox", "label" => "Name:")) ?></td>
            </tr>
            <tr>
                <td><?= form_input(array("name" => "address", "class" => "easyui-textbox", "label" => "Address:")) ?></td>
            </tr>
            <tr>
                <td><?= form_input(array("name" => "phone", "class" => "easyui-textbox", "label" => "Phone:")) ?></td>
            </tr>
        </table>
        <?= form_close(); ?>
    </div>
    <div id="form-dialog-buttons">
        <a  
            href="javascript:void(0)" 
            class="easyui-linkbutton" 
            iconCls="icon-ok" 
            onclick="saveUser()" 
            style="width:90px;"
        >
            Save
        </a>
        <a 
            href="javascript:void(0)"
            class="easyui-linkbutton"
            iconCls="icon-ok"
            onclick="javascript : $('#form-dialog').dialog('close')"
            style="width:90px;"
        >
            Cancel
        </a>
    </div>
    <script type="text/javascript">
        var url;
        function newUser() {
            $("#form-dialog")
                .dialog("open")
                .dialog("center")
                .dialog("setTitle", New Contacts");
            $("#form-dialog").form("clear");
            url = "p14/save";
        }
        
        function editUser() {
            var row = $("#datagrid-contacts").datagrid("getSelected");
            if (row) {
                $("#form-dialog").dialog("open").dialog("center").dialog("setTitle", "Edit User");
                $("#form-dialog").form("load", row); 
                
                url = "p14/save/" + row.id;
            }
        }
        
        function saveUser() {
            $("#form-contact").form("submit", {
                url: url, 
                onSubmit: function () {
                    return Whis).form("validate");
                },
                success: function (result) {
                    if (result.errorMsg) {
                        $.messager.show({
                            title: "Error",
                            msg: result.errorMsg,
                        });
                    } else {
                        $("#form-dialog").dialog("close"); 
                        $("#datagrid-contacts").datagrid("reload");
                    }
                },
            });
        }
        
        function deleteUser() {
            var row = $("#datagrid-contacts").datagrid("get5elected");
            if (row) {
                $.messager.confirm( 
                    "Confirm", 
                    "Are you sure you want to delete this user?", 
                    function (r) {
                        if (r) {
                            $.get( 
                                "p14/delete/" + row.id,
                                function (result) { 
                                    $("#datagrid-contacts").datagrid("reload"); // reload the user data 
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