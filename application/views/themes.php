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
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-9">
            <table id="table_categories" border="1">
                <tbody>
                <?php
                foreach ($categories as $category) {
                    $category_id = $category->id;

                    // если айди категории совпадает с текущей айдишкой, которая приходит из контроллера, тогда присвой класс current_category

                    if ($category_id == $current_id) {
                        echo "<ul class='current_category' id='ul_$category->id'>";
                    } else {
                        echo "<ul id='ul_$category->id'>";
                    }
                    echo "<li>
                        <a id='a_$category->id' href='" . base_url() . "themes/$category->id'>" . $category->category_name . "</a>
                        <button onclick='deletePress(this)' type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteCategory' data-id='" . $category->id . "' data-name='" . $category->category_name . "'><span class='glyphicon glyphicon-trash'></span></button>
                        <button onclick='updatePress(this)' type='button' class='btn btn-warning' data-toggle='modal' data-target='#updateCategory' data-id='" . $category->id . "' data-name='" . $category->category_name . "'><span class='glyphicon glyphicon-edit'></span></button>
                    </li>
                 </ul>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-9 col-md-9">
            <button onclick="sortThemes(this)" class="order_by" data-id="0" data-order_by="comments desc">Комментируемые</button>
            <button onclick="sortThemes(this)" class="order_by" data-id="1" data-order_by="views desc">Просматриваемые</button>
            <button onclick="sortThemes(this)" class="order_by" data-id="2" data-order_by="likes desc">Популярные</button>

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
                    <input required type="text" class="form-control" name="category_name">
                    <label>Категория:</label>
                    <select required name="category_id">
                        <option value="">Выберите категорию</option>
                        <?php
                        foreach ($categories as $category) {
                            echo "<option value='$category->id'>$category->category_name</option>";
                        }
                        ?>
                    </select>
                    <button class="btn btn-success center-block">Добавить</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>

    function sortThemes(context) {
        var id = context.getAttribute('data-id');
        $('.order_by').removeClass('order_by_pressed');
        $('.order_by').eq(id).addClass('order_by_pressed');

        var order_by = context.getAttribute('data-order_by');
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "themes/sort_themes",
            data: {order_by: order_by, csrf_test_name: $(".csrf").val()},
            dataType: "JSON"
        }).done(function (message) {
            $(".csrf").val(message.csrf_hash);
            $("#table_themes").html(message.themes);
        })
    }

</script>

</body>
</html>