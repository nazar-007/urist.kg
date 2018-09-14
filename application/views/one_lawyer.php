<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>One lawyer</title>
    <style>

        .one-experience {
            border: 3px solid saddlebrown;
        }

    </style>
    <link href="<?php echo base_url()?>css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <a href="<?php echo base_url()?>lawyers">Ко всем юристам</a>
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <?php
            foreach ($one_lawyer as $info_lawyer) {
                echo "<h3 class='centered'>" . $info_lawyer->name . "</h3>";
                echo "<h5>" . $info_lawyer->work . "</h5>";
                echo "<h5>" . $info_lawyer->mail . "</h5>";
                echo "<h5>" . $info_lawyer->phone . "</h5>";
                echo "<img src='" . base_url() . "uploads/" . $info_lawyer->img . "' width='100'>";
                echo "<button type='button' class='btn btn-warning'>
                    <a href='" . base_url() . "update_lawyer/$lawyer_id'>Update</a>
                </button>";
            }
            ?>
        </div>

        <div class="col-lg-9 col-md-9">
            <h3 class="centered">Work experiences</h3>
            <button class="btn btn-info" data-toggle="modal" data-target="#insertExperience">Добавить опыт работы</button>
            <div id="experiences">
            <?php
            foreach ($experiences as $experience) {
                $experience_id = $experience->id;
                echo "<div id='tr_$experience_id' class='one-experience'>
                    <div>
                        $experience->work_place
                    </div>
                    <div>
                        $experience->work_date
                    </div>
                    <div>
                        $experience->work_desc
                    </div>
                    <div>
                        <button class='btn btn-danger' onclick='deletePress(this)' data-id='$experience_id' data-toggle='modal' data-target='#deleteExperience'><span class='glyphicon glyphicon-trash'></span></button>
                    </div>
                </div>";
            }
            ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="insertExperience" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Добавление опыта работы</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="javascript:void(0)" onsubmit="insertExperience(this)" enctype="multipart/form-data">
                    <input type="hidden" class="csrf" name="csrf_test_name" value="<?php echo $csrf_hash?>">
                    <label>Место работы:</label>
                    <input required type="text" class="form-control" name="work_place">
                    <label>Дата работы:</label>
                    <input required type="text" class="form-control" name="work_date">
                    <label>Описание работы:</label>
                    <input required type="text" class="form-control" name="work_desc">
                    <input type="hidden" name="lawyer_id" value="<?php echo $lawyer_id?>">
                    <button class="btn btn-success center-block">Добавить</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteExperience" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Удаление опыта работы</h4>
            </div>
            <div class="modal-body">
                <form onsubmit="deleteExperience(this)" method="post" action="javascript:void(0)">
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

    function insertExperience(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "experiences/insert_experience",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function (message) {
            $(".csrf").val(message.csrf_hash);
            $(".form-control").val('');
            $("#insertExperience").trigger('click');
            $("#experiences").append("<div id='tr_" + message.id + "' class='one-experience'>" +
                "<div>" + message.work_place + "</div>" +
                "<div>" + message.work_date + "</div>" +
                "<div>" + message.work_desc + "</div>" +
                "<div>" +
                "<button class='btn btn-danger' onclick='deletePress(this)' data-id='" + message.id + "' data-toggle='modal' data-target='#deleteExperience'><span class='glyphicon glyphicon-trash'></span></button> " +
                "</div> " +
                "</div>");
        })
    }

    function deletePress(context) {
        var id = context.getAttribute('data-id');
        var delete_id = document.getElementById('delete_id');
        var delete_question = document.getElementById('delete_question');
        delete_id.value = id;
        delete_question.innerHTML = "Вы действительно хотите удалить этот опыт?";
    }

    function deleteExperience(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "experiences/delete_experience",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function(message) {
            $(".csrf").val(message.csrf_hash);
            $("#deleteExperience").trigger('click');
            $("#tr_" + message.id).remove();
        });
    }
</script>


</body>
</html>