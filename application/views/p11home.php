<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Pertemuan 11</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css"/>
    </head>
    <body>
        <div class="ui top menu">
            <div class="ui container">
                <a class="active item" href="/p11">Home</a>
                <a class="item" href="/p11/logout">Logout</a>
            </div>
        </div>
        <div class="pusher">
            <div class="ui two column grid">
                <div class="two wide column"></div>
                <div class="twelve wide column">
                    <div class="ui two column grid">
                        <div class="four wide column">
                            <div class="ui fluid icon input">
                                <input type="text" name="search" placeholder="Search...">
                                <i class="search icon"></i>
                            </div>
                        </div>
                        <div class="three wide column">
                            <button class="ui input blue button open-form">Create New</button>
                        </div>
                    </div>
                    <div class="ui segment editor" style="display: none;">
                        <form class="ui form">
                            <input type="hidden" name="id" />
                                <div class="field">
                                    <label>Name</label>
                                    <input type="text" name="name" class="ui input large" />
                                </div>
                            <div class="field">
                                <label>Address</label>
                                <input type="text" name="address" class="ui input large" />
                            </div>
                            <div class="field">
                                <label>Phone</label>
                                <input type="text" name="phone" class="ui input large" />
                            </div>
                            <button class="ui input green button create">Create</button>
                            <button class="ui input orange button update">Update</button>
                            <button class="ui input button cancel">Cancel</button>
                        </form>
                    </div>
                    <div class="ui segment">
                        <div class="ui active inverted dimmer">
                            <div class="ui text loader">Loading</div>
                        </div>
                        <table class="ui celled table" style="margin-top: 0;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table-content"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
        <script>
            $(document).ready(function () {
                $tableBody = $(".table-content");
                $tableForm = $(".editor");
                $tableLoader = $(".inverted.dimmer");
                $tableSearch = $('input[name="search"]');
                $buttonForm = $(".open-form");
                $buttonCreate = $(".create.button");
                $buttonUpdate = $(".update.button");
                $buttonCancel = $(".cancel.button");
                $buttonForm.click(function () {
                    $tableForm.slideDown();
                    $buttonCreate.show();
                    $buttonUpdate.hide();
                    $('input[name="name"]').val("");
                    $('input[name="address"]').val("");
                    $('input[name="phone"]').val("");
                });
                $buttonCancel.click(function () {
                    $tableForm.slideUp();
                });
                $buttonCreate.click(function () {
                    $tableForm.slideUp();
                });
                $buttonUpdate.click(function () {
                    $tableForm.slideUp();
                });
                $tableSearch.keypress(function(e) {
                    if (e.keyCode === 13) {
                        loadContent($tableSearch.val())
                    }
                });
                $(".ui.form").submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: "/p11/save",
                        method: "post",
                        data: {
                            id: $('input[name="id"]').val(),
                            name: $('input[name="name"]').val(),
                            address: $('input[name="address"]').val(),
                            phone: $('input[name="phone"]').val(),
                        },
                        dataType: "json",
                        success: function (response) {
                            loadContent();
                        },
                    });
                });
                function loadContent(keyword) {
                    $tableLoader.addClass("active");
                    $.get("/p11/contacts", { keyword: keyword }).then(function (result) {
                        $tableBody.html("");
                        result.map(function (data, index) {
                            $tableBody.append(
                                "" +
                                '<tr data-id="' + data.id + '">' +
                                ' <td data-label="Name">' + data.name + "</td>" +
                                ' <td data-label="Address">' + data.address + "</td>" +
                                ' <td data-label="Phone">' + data.phone + "</td>" +
                                ' <td data-label="Phone">' +
                                ' <a class="ui button action-edit" data-index="' + index + '">' +
                                ' <i class="edit outline icon"></i> Edit' +
                                " </a>" +
                                ' <a class="ui red button action-delete" data-index="' + index + '">' +
                            ' <i class="trash icon"></i> Delete' +
                            " </a>" +
                            " </td>" +
                            "</tr>"
                            );
                        });
                        $(".action-edit").click(function () {
                            var content = result[$(this).data("index")];
                            $('input[name="id"]').val(content.id);
                            $('input[name="name"]').val(content.name);
                            $('input[name="address"]').val(content.address);
                            $('input[name="phone"]').val(content.phone);
                            $tableForm.slideDown();
                            $buttonCreate.hide();
                            $buttonUpdate.show();
                        });
                        $(".action-delete").click(function() {
                            var content = result[$(this).data("index")];
                            $.ajax({
                                url: "/p11/delete/" + content.id,
                                method: "get",
                                dataType: "json",
                                success: function (response) {
                                    loadContent();                                        
                                },
                            });
                        });
                        $tableLoader.removeClass("active");
                    });
                }
                loadContent();
            });
        </script>
    </body>
</html>