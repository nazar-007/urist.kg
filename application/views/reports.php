<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reports</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>css/style.css">

</head>
<body style="background-color: #f2dede;">

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#insertNew">Добавить новость</button>
            <table class="table" id="table_reports">
                <tbody>
                    <?php
                    foreach ($reports as $report) {
                        $report_id = $report->id;
                        echo "<tr id='tr_$report_id'>
                                <td>
                                    <a id='a_$report_id' href='" . base_url() . "one_report/$report_id'>" . $report->name . "</a>
                                </td>
                                <td>
                                    <button onclick='deletePress(this)' type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteReport' data-id='" . $report_id ."' data-name='" . $report->name ."'><span class='glyphicon glyphicon-trash'></span></button>
                                    <button onclick='updatePress(this)' type='button' class='btn btn-warning' data-toggle='modal' data-target='#updateReport' data-id='" . $report_id ."' data-name='" . $report->name ."' data-text='" . $report->text . "' data-date='" . $report->date . "'><span class='glyphicon glyphicon-edit'></span></button>
                                </td>
                            </tr>";
                    }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="insertReport" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Добавление репортажа</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="javascript:void(0)" onsubmit="insertReport(this)" enctype="multipart/form-data">
                    <input type="hidden" class="csrf" name="csrf_test_name" value="<?php echo $csrf_hash?>">
                    <label>Заголовок:</label>
                    <input required type="text" class="form-control" name="name">
                    <label>Описание:</label>
                    <textarea required cols="5" class="form-control" name="text"></textarea>
                    <label>Фото:</label>
                    <input type="file" name="report_image[]" multiple>
                    <button class="btn btn-success center-block">Добавить</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteReport" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Удаление репортажа</h4>
            </div>
            <div class="modal-body">
                <form onsubmit="deleteReport(this)" method="post" action="javascript:void(0)">
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

<div class="modal fade" id="updateReport" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Редактирование репортажа</h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" onsubmit="updateReport(this)" enctype="multipart/form-data">
                    <div class="form-group">
                        <input class="csrf" type="hidden" name="csrf_test_name" value="<?php echo $csrf_hash; ?>"><br>
                        <input type="hidden" name="id" id="update_id">
                        <label for="update_name">Заголовок:</label>
                        <input name="name" id="update_name" type="text" class="form-control">
                        <label for="update_text">Описание:</label>
                        <input name="text" id="update_text" type="text" class="form-control">
                        <label for="update_img">Img:</label>
                        <input name="report_image" multiple id="update_img" type="file" class="form-control">
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

    function insertReport(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "reports/insert_report",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function (message) {
            $(".csrf").val(message.csrf_hash);
            $(".form-control").val('');
            $("#insertReport").trigger('click');
            $("#table_reports").append("<tr id='tr_" + message.id + "'> " +
                "<td> " +
                    "<a href='<?php echo base_url()?>one_report/" + message.id + "'>" + message.name + "</a> " +
                "</td> " +
                "<td>" +
                    "<button onclick='deletePress(this)' type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteReport' data-id='" + message.id + "' data-name='" + message.name + "'><span class='glyphicon glyphicon-trash'></span></button>" +
                    "<button onclick='updatePress(this)' type='button' class='btn btn-warning' data-toggle='modal' data-target='#updateReport' data-id='" + message.id + "' data-name='" + message.name + "' data-text='" + message.text + "' data-date='" + message.date + "'><span class='glyphicon glyphicon-edit'></span></button>" +
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
        delete_question.innerHTML = "Вы действительно хотите удалить репортаж " + name + "?";
    }

    function deleteReport(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "reports/delete_report",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function(message) {
            $(".csrf").val(message.csrf_hash);
            $("#deleteReport").trigger('click');
            $("#tr_" + message.id).remove();
        });
    }

    function updatePress(context) {
        var id = context.getAttribute('data-id');
        var name = context.getAttribute('data-name');
        var text = context.getAttribute('data-text');
        var update_id = document.getElementById('update_id');
        var update_name = document.getElementById('update_name');
        var update_text = document.getElementById('update_text');
        update_id.value = id;
        update_name.value = name;
        update_text.value = text;
    }

    function updateReport(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "reports/update_report",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function(message) {
            $(".csrf").val(message.csrf_hash);
            $("#updateReport").trigger('click');
            document.getElementById('a_' + message.id).classList.add('change');
            document.getElementById('a_' + message.id).innerHTML = message.name;
        })
    }
</script>


</body>
</html>