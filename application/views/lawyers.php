<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lawyers</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>css/style.css">

</head>
<body style="background-color: #f2dede;">

<div class="container">
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#insertLawyer">Добавить юриста</button>
            <div class="row">
                <table border="3" class="table" id="table_lawyers">
                    <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Фото</th>
                            <th>Работа</th>
                            <th>Почта</th>
                            <th>Телефон</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($lawyers as $lawyer) {
                            $lawyer_id = $lawyer->id;
                            echo "<tr id='tr_$lawyer_id'>
                                        <td>
                                            <a id='a_$lawyer_id' href='" . base_url() . "one_lawyer/$lawyer_id'>" . $lawyer->name . "</a>
                                        </td>
                                        <td>
                                            <img src='" . base_url() . "uploads/" . $lawyer->img ."' width='100'>
                                        </td>
                                        <td>
                                            $lawyer->work    
                                        </td>
                                        <td>
                                            $lawyer->mail
                                        </td>
                                        <td>
                                            $lawyer->phone
                                        </td>
                                        <td>
                                            <button onclick='deletePress(this)' type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteLawyer' data-id='" . $lawyer_id ."' data-name='" . $lawyer->name ."'><span class='glyphicon glyphicon-trash'></span></button>
                                            <button type='button' class='btn btn-warning'>
                                                <a href='" . base_url() . "update_lawyer/$lawyer_id'>Update</a>
                                            </button>
                                        </td>
                                    </tr>";
                        }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="insertLawyer" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Добавление юриста</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="javascript:void(0)" onsubmit="insertLawyer(this)" enctype="multipart/form-data">
                    <input type="hidden" class="csrf" name="csrf_test_name" value="<?php echo $csrf_hash?>">
                    <label>ФИО:</label>
                    <input required type="text" class="form-control" name="name">
                    <label>Фото:</label>
                    <input required type="file" name="img">
                    <label>Место работы:</label>
                    <input required type="text" class="form-control" name="work">
                    <label>Mail:</label>
                    <input required type="text" class="form-control" name="mail">
                    <label>Телефон:</label>
                    <input required type="text" class="form-control" name="phone">
                    <button class="btn btn-success center-block">Добавить</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteLawyer" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Удаление юриста</h4>
            </div>
            <div class="modal-body">
                <form onsubmit="deleteLawyer(this)" method="post" action="javascript:void(0)">
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

<script>

    function insertLawyer(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "lawyers/insert_lawyer",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function (message) {
            $(".csrf").val(message.csrf_hash);
            $(".form-control").val('');
            $("#insertLawyer").trigger('click');
            $("#table_lawyers").append("<tr id='tr_" + message.id + "'> " +
                "<td> " +
                    "<a href='<?php echo base_url()?>one_lawyer/" + message.id + "'>" + message.name + "</a> " +
                "</td> " +
                "<td>" +
                    "<img src='<?php echo base_url()?>uploads/" + message.img + "' width='100'> " +
                "</td> " +
                "<td>" + message.work + "</td>" +
                "<td>" + message.mail + "</td>" +
                "<td>" + message.phone + "</td>" +
                "<td>" +
                    "<button onclick='deletePress(this)' type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteLawyer' data-id='" + message.id + "' data-name='" + message.name + "'><span class='glyphicon glyphicon-trash'></span></button>" +
                    "<button type='button' class='btn btn-warning'>" +
                        "<a href='update_lawyer/" + message.id + "'>Update</a>" +
                    "</button>" +
                "</td>" +
            "</tr>");
        })
    }

    function deletePress(context) {
        var id = context.getAttribute('data-id');
        var name = context.getAttribute('data-name');
        var delete_id = document.getElementById('delete_id');
        var delete_question = document.getElementById('delete_question');
        delete_id.value = id;
        delete_question.innerHTML = "Вы действительно хотите удалить юриста. которого зовут " + name + "?";
    }

    function deleteLawyer(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "lawyers/delete_lawyer",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function(message) {
            $(".csrf").val(message.csrf_hash);
            $("#deleteLawyer").trigger('click');
            $("#tr_" + message.id).remove();
        });
    }
</script>


</body>
</html>