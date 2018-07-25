<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>css/style.css">
    <style>
        .order_by_pressed {
            border: 5px solid #5a0099;
            transition: 0.5s ease;
        }
    </style>

</head>
<body style="background-color: #f2dede;">

<div class="container">
    
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#insertCategory">Добавить категорию</button>
            <table class="table" id="table"  >
 
                <?php
                foreach ($categories as $category) {
                    $category_id = $category->id;
                    ?>
<!--
                    // айдишки ul_ нужны для того, чтобы при удалении категории стиралась именно эта категория, а айдишка a_ нужна, чтобы при изменении названия категории менялось названии этой категории
                    // функция deletePress и updatePress нужны, чтобы при открытии модалки в инпут попадала айдишка именно этой категории
-->

    <tbody>
      <tr class="info" id='ul_<?php echo $category_id?>'>
          <td><a href="<?php echo base_url()?>themes/<?php echo $category->id?>"><?php echo $category->category_name?></a></td>
      </tr>
    </tbody>


<!--
                    echo "<ul '><li><a id='a_$category->id' href='" . base_url() . "themes/$category->id'>" . $category->category_name . "</a>
                            <button onclick='deletePress(this)' type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteCategory' data-id='" . $category->id ."' data-name='" . $category->category_name ."'><span class='glyphicon glyphicon-trash'></span></button>
                            <button onclick='updatePress(this)' type='button' class='btn btn-warning' data-toggle='modal' data-target='#updateCategory' data-id='" . $category->id ."' data-name='" . $category->category_name ."'><span class='glyphicon glyphicon-edit'></span></button>
                            <ul>";
         
-->
    
             <?php   }
                ?>
            </table>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-3 col-xs-3">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#insertTheme">Добавить тему</button><br>

            

            <button onclick="sortThemes(this)" class="order_by" data-id="0" data-order_by="comments desc">Комментируемые</button>
            <button onclick="sortThemes(this)" class="order_by" data-id="1" data-order_by="views desc">Просматриваемые</button>
            <button onclick="sortThemes(this)" class="order_by" data-id="2" data-order_by="likes desc">Популярные</button>
            <table class="table table-bordered" id="table_themes"> 
                <?php
                $i = 0;
                
                foreach ($categories as $category) {
                ?>
                <thead>
                  <tr>
                    <th colspan="3"><?php echo $category->category_name?></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $cats_themes[$i]['0']['theme_name'] ?></td>
                  </tr>
                  <tr>
                    <td><?php echo $cats_themes[$i]['1']['theme_name'] ?></td>
                  </tr>
                  <tr>
                    <td><?php echo $cats_themes[$i]['2']['theme_name'] ?></td>
                  </tr>
                </tbody>
                <?php $i++;}?>
            </table>

        </div>
    </div>
</div>

<div class="modal fade" id="insertCategory" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Добавление категории</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="javascript:void(0)" onsubmit="insertCategory(this)">
                    <input type="hidden" class="csrf" name="csrf_test_name" value="<?php echo $csrf_hash?>">
                    <label>Название категории:</label>
                    <input required type="text" class="form-control" name="category_name">
                    <button class="btn btn-success center-block">Добавить</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
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

<div class="modal fade" id="deleteCategory" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Удаление категории</h4>
            </div>
            <div class="modal-body">
                <form onsubmit="deleteCategory(this)" method="post" action="javascript:void(0)">
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

<div class="modal fade" id="updateCategory" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Редактирование категории</h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" onsubmit="updateCategory(this)">
                    <div class="form-group">
                        <input class="csrf" type="hidden" name="csrf_test_name" value="<?php echo $csrf_hash; ?>"><br>
                        <input type="hidden" name="id" id="update_id">
                        <label for="update_name">Name:</label>
                        <input name="category_name" id="update_name" type="text" class="form-control">
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
    
    $( document ).ready(function() {
        console.log('refresh');
    });
    
    function insertCategory(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "categories/insert_category",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function (message) {
            $(".csrf").val(message.csrf_hash); // обрати внимание, что таким образом меняются все токены CSRF c классом csrf.
            $(".form-control").val('');
            $("#insertCategory").trigger('click');
            $("#table_categories").append("<ul id='tr_" + message.id + "'>" +
                "<li>" +
                    "<a id='" + message.id + "' href='<?php echo base_url()?>themes/" + message.id + "'>" + message.category_name + "</a>" +
                    "<button onclick='deletePress(this)' type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteCategory' data-id='" + message.id + "' data-name='" + message.category_name + "'><span class='glyphicon glyphicon-trash'></span></button> " +
                    "<button onclick='updatePress(this)' type='button' class='btn btn-warning' data-toggle='modal' data-target='#updateCategory' data-id='" + message.id + "' data-name='" + message.category_name + "'><span class='glyphicon glyphicon-edit'></span></button>" +
                "</li>" +
            "</ul>");
        })
    }

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
            "</tr>");
        })
    }

    function deletePress(context) {

        // при нажатии кнопки беру дата-атрибуты и вписываю значения в скрытые инпуты

        var id = context.getAttribute('data-id');
        var category_name = context.getAttribute('data-name');
        var delete_id = document.getElementById('delete_id');
        var delete_question = document.getElementById('delete_question');
        delete_id.value = id;
        delete_question.innerHTML = "Вы действительно хотите удалить категорию " + category_name + "?";
    }

    function deleteCategory(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "categories/delete_category",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function(message) {
            $(".csrf").val(message.csrf_hash);
            $("#deleteCategory").trigger('click');
            $("#ul_" + message.id).remove();
        });
    }

    function updatePress(context) {
        var id = context.getAttribute('data-id');
        var category_name = context.getAttribute('data-name');
        var update_id = document.getElementById('update_id');
        var update_name = document.getElementById('update_name');
        update_id.value = id;
        update_name.value = category_name;
    }

    function updateCategory(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "categories/update_category",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function(message) {
            $(".csrf").val(message.csrf_hash);
            $("#updateCategory").trigger('click');

            // присваиваю измененной категории новое имя и класс

            document.getElementById('a_' + message.id).classList.add('change');
            document.getElementById('a_' + message.id).innerHTML = message.category_name;
        })
    }

    function sortThemes(context) {
        var id = context.getAttribute('data-id');

        // при сортировке сначала удаляю класс order_by_pressed со всех кнопок, затем присваиваю этот класс на нажатую кнопку
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