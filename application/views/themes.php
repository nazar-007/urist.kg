<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Themes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .order_by_pressed {
            border: 5px solid #5a0099;
            transition: 0.5s ease;
        }
        .current_category {
            background-color: tan;
            border: 5px solid black;
        }

        .rules {
            background-color: darksalmon;
        }
    </style>
</head>
<body style="background-color: #f2dede">

<div class="container">
    <a href="<?php echo base_url()?>categories">На главную</a>
    <div class="row">
        <div class="col-lg-3 col-md-9">
            <table id="table_categories" border="1">
                <tbody>
                <?php
                foreach ($categories as $category) {
                    $category_id = $category->id;
                    if ($category_id == $current_id) {
                        echo "<ul class='current_category' id='ul_$category->id'>";
                    } else {
                        echo "<ul id='ul_$category->id'>";
                    }
                    echo "<a id='a_$category->id' href='" . base_url() . "themes/$category->id'>" . $category->category_name . "</a>
                    </ul>";
                }
                ?>
                </tbody>
            </table>

            <br><br>

            <?php
            foreach ($first_theme as $theme) {
                echo "<div class='rules'>
                        <a id='first_theme' href='" . base_url() . "one_theme/" . $theme->id . "'>" . $theme->theme_name ."</a>
                        <button class='btn btn-warning' data-toggle='modal' data-target='#updateTheme' onclick='updateThemePress(this)' data-id='" . $theme->id . "' data-theme_name='" .  $theme->theme_name. "' data-theme_desc='$theme->theme_desc'><span class='glyphicon glyphicon-edit'></span></button>    
                    </div>";
            }
            ?>
        </div>
        <div class="col-lg-9 col-md-9">
            <form action="javascript:void(0)" onsubmit="searchThemes(this)">
                <input type="hidden" class="csrf" name="csrf_test_name" value="<?php echo $csrf_hash?>">
                <input type="hidden" name="category_id" value="<?php echo $current_id?>">
                <input required type="text" name="theme_name" size="70" placeholder="Поиск тем">
                <button type="submit">Искать</button>
            </form>

            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#insertTheme">Добавить тему</button><br>


            <button onclick="sortThemes(this)" class="order_by" data-id="0" data-order_by="comments desc" data-category_id="<?php echo $current_id?>">Комментируемые</button>
            <button onclick="sortThemes(this)" class="order_by" data-id="1" data-order_by="views desc" data-category_id="<?php echo $current_id?>">Просматриваемые</button>
            <button onclick="sortThemes(this)" class="order_by" data-id="2" data-order_by="likes desc" data-category_id="<?php echo $current_id?>">Популярные</button>

            <table id="table_themes" border="1">
                <?php

                foreach ($themes as $theme) {
                    echo "<tr id='tr_$theme->id'>
                    <td>
                        <a id='a_$theme->id' href='" . base_url() . "one_theme/$theme->id'>" . $theme->theme_name . "</a>
                    </td>
                    <td>
                        $theme->comments комментов
                    </td>
                    <td>
                        $theme->views просмотров
                    </td>
                    <td>
                        $theme->likes лайков
                    </td>
                    <td>
                          <button onclick='deleteThemePress(this)' type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteTheme' data-id='$theme->id' data-name='$theme->theme_name'><span class='glyphicon glyphicon-trash'></span></button>
                    </td>
                    <td>
                          <button onclick='updateThemePress(this)' type='button' class='btn btn-warning' data-toggle='modal' data-target='#updateTheme' data-id='$theme->id' data-theme_name='$theme->theme_name' data-theme_desc='$theme->theme_desc'><span class='glyphicon glyphicon-edit' ></span ></button >
                    </td>
                 </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="insertTheme" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Добавление темы</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="javascript:void(0)" onsubmit="insertTheme(this)">
                    <input type="hidden" class="csrf" name="csrf_test_name" value="<?php echo $csrf_hash?>">
                    <label>Название темы:</label>
                    <input required type="text" class="form-control" name="theme_name">
                    <label>Описание темы:</label>
                    <textarea required cols="5" class="form-control" name="theme_desc"></textarea>
                    <input type="hidden" name="category_id" value="<?php echo $current_id?>">
                    <button class="btn btn-success center-block">Добавить</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteTheme" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Удаление темы</h4>
            </div>
            <div class="modal-body">
                <form onsubmit="deleteTheme(this)" method="post" action="javascript:void(0)">
                    <h3 id="delete_question"></h3>
                    <div class="form-group">
                        <input class="csrf" type="hidden" name="csrf_test_name" value="<?php echo $csrf_hash; ?>"><br>
                        <input type="hidden" id="delete_id" name="id">
                        <button class="btn btn-danger center-block" type="submit">Удалить</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="updateTheme" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Редактирование темы</h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" onsubmit="updateTheme(this)">
                    <div class="form-group">
                        <input class="csrf" type="hidden" name="csrf_test_name" value="<?php echo $csrf_hash; ?>"><br>
                        <input type="hidden" name="id" id="update_theme_id">
                        <input type="hidden" name="category_id" value="<?php echo $current_id?>">
                        <label>Name:</label>
                        <input name="theme_name" id="update_theme_name" type="text" class="form-control">
                        <label>Description:</label>
                        <input name="theme_desc" id="update_theme_desc" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-warning center-block" type="submit">Редактировать</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>

    function insertTheme(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "themes/insert_theme",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function (message) {
            $(".csrf").val(message.csrf_hash);
            $(".form-control").val('');
            $("#insertTheme").trigger('click');
            $("#table_themes").append("<tr id='tr_" + message.id + "'>" +
                "<td> " +
                "<a id='a_" + message.id + "' href='<?php echo base_url()?>one_theme/" + message.id + "'>" + message.theme_name + "</a> " +
                "</td> " +
                "<td>" +
                "0 комментов " +
                "</td> " +
                "<td>" +
                "0 просмотров " +
                "</td> " +
                "<td>" +
                "0 лайков " +
                "</td> " +
                "<td>" +
                "<button onclick='deleteThemePress(this)' type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteTheme' data-id='" + message.id + "' data-name='" + message.theme_name + "'><span class='glyphicon glyphicon-trash'></span></button> " +
                "</td> " +
                "<td>" +
                "<button onclick='updateThemePress(this)' type='button' class='btn btn-warning' data-toggle='modal' data-target='#updateTheme' data-id='" + message.id + "' data-theme_name='" + message.theme_name + "' data-theme_desc='" + message.theme_desc + "'><span class='glyphicon glyphicon-edit'></span></button>" +
                "</td>" +
                "</tr>");
        })
    }


    function searchThemes(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "themes/search_themes_by_category_id",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function (message) {
            $(".csrf").val(message.csrf_hash); // обрати внимание, что таким образом меняются все токены CSRF c классом csrf.
            $("#table_themes").html(message.themes);
        })
    }

    function deleteThemePress(context) {
        var id = context.getAttribute('data-id');
        var theme_name = context.getAttribute('data-name');
        var delete_id = document.getElementById('delete_id');
        var delete_question = document.getElementById('delete_question');
        delete_id.value = id;
        delete_question.innerHTML = "Вы действительно хотите удалить тему " + theme_name + "?";
    }

    function deleteTheme(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "themes/delete_theme",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function(message) {
            $(".csrf").val(message.csrf_hash);
            $("#deleteTheme").trigger('click');
            $("#tr_" + message.id).remove();
        });
    }


    function updateThemePress(context) {
        var id = context.getAttribute('data-id');
        var theme_name = context.getAttribute('data-theme_name');
        var theme_desc = context.getAttribute('data-theme_desc');
        var update_theme_id = document.getElementById('update_theme_id');
        var update_theme_name = document.getElementById('update_theme_name');
        var update_theme_desc = document.getElementById('update_theme_desc');
        update_theme_id.value = id;
        update_theme_name.value = theme_name;
        update_theme_desc.value = theme_desc;
    }

    function updateTheme(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "themes/update_theme",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function (message) {
            $(".csrf").val(message.csrf_hash);
            $("#updateTheme").trigger('click');

            if (message.category_id > 0) {
                document.getElementById('a_' + message.id).classList.add('change');
                document.getElementById('a_' + message.id).innerHTML = message.theme_name;
            } else {
                document.getElementById('first_theme').classList.add('change');
                document.getElementById('first_theme').innerHTML = message.theme_name;
            }
        })
    }


    function sortThemes(context) {
        var id = context.getAttribute('data-id');
        $('.order_by').removeClass('order_by_pressed');
        $('.order_by').eq(id).addClass('order_by_pressed');

        var order_by = context.getAttribute('data-order_by');
        var category_id = context.getAttribute('data-category_id');
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "themes/sort_themes_by_category_id",
            data: {order_by: order_by, category_id: category_id, csrf_test_name: $(".csrf").val()},
            dataType: "JSON"
        }).done(function (message) {
            $(".csrf").val(message.csrf_hash);
            $("#table_themes").html(message.themes);
        })
    }

</script>

</body>
</html>