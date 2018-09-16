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
    <script src="<?php echo base_url()?>script/pdf.js"></script>
    <style>
        .order_by_pressed {
            border: 5px solid #5a0099;
            transition: 0.5s ease;
        }
    </style>

</head>
<body style="background-color: #f2dede;">
<div class="container">
   <div><div class="url" data-url="<?php echo base_url()?>"></div></div> 
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-3 col-xs-3">

            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#insertTheme">Добавить файл</button><br>

            <table class="table table-bordered" id="table_themes" style="background-color:white;"> 
                <thead>
                  <tr>
                    <th  style="background-color:white;">НАЗВАНИЕ</th>
                    <th colspan="2" style="background-color:white;">РЕДАКТИРОВАТЬ</th>
                  </tr>
                </thead>
                <tbody id="table_themes_body">
                <?php
                $i = 1;
                foreach ($categories as $category) { ?>
                  <tr>
                      <td><?php echo $category['name'] ?></td>
      
                      <td><button  data-id="<?php echo $category['id'] ?>" type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCategory" onclick="updateThemeFirst(this)">Удалить файл</button></td>
                       <td><a href="<?php echo base_url()?>pdf_files/<?php echo $category['route']?>"><button type="button" class="btn btn-success"  onclick="updateThemeFirst(this)">Скачать</button></a></td>
                  </tr>
                <?php $i++;}?>
                </tbody>
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
                <form method="post" action="javascript:void(0)" onSubmit="insertThemeFile(this)">
                    <input type="hidden" class="csrf" name="csrf_test_name" value="<?php echo $csrf_hash?>">
                    <label>Название файла:</label>
                    <input required type="text" class="form-control" name="category_name">
                    <label>Файл:</label>
                    <input required type="file" class="form-control" name="userfile">
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
                    <h4 id="delete_question">*ОБРАТИТЕ ВНИМАНИЕ<br>УДАЛЕНИЕ КАТЕГОРИИ УДАЛИТ ВСЕ ФАЙЛЫ ВНУТРИ НЕЕ<br> ОТМЕНИТЬ ЭТО ДЕЙСТВИЕ <span style="color:red;">НЕВОЗМОЖНО</span><br>СОВЕТУЕМ СКАЧАТЬ НУЖНЫ ФАЙЛЫ ПЕРЕД УДАЛЕНИЕМ<br> ЭТО ДЕЙСТВИЕ <span style="color:red;">НЕОБРАТИМО</span> </h4>
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
                <h4 class="modal-title">Редактирование категории</h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" onsubmit="updateTheme(this)">
                    *Редактирование никак не взаимодействует с файлами в самой категории
                    <div class="form-group">
                        <input class="csrf" type="hidden" name="csrf_test_name" value="<?php echo $csrf_hash; ?>"><br>
                        <input type="hidden" name="category_id" class='zzz' id="update_id">
                        <label for="update_name">Name:</label>
                        <input name="category_name" id="update_name" type="text" class="form-control">
                        <label for="update_name">Dis:</label>
                        <textarea name="category_dis" id="update_dis" type="text" class="form-control"></textarea>
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
</body>
</html>