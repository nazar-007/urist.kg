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
    <title>Update lawyer</title>
    <link href="<?php echo base_url()?>css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <a href="<?php echo base_url()?>lawyers">Ко всем юристам</a>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 class="centered">Редактирование юриста</h3>
            <form method="post" action="<?php echo base_url()?>update_lawyer_process" enctype="multipart/form-data">
            <?php
            foreach ($one_lawyer as $info_lawyer) :?>
                <input type="hidden" name="id" value="<?php echo $info_lawyer->id?>">
                <input type="hidden" name="csrf_test_name" value="<?php echo $csrf_hash;?>">
                <label>ФИО</label>
                <input type='text' class='form-control' name='name' value='<?php echo $info_lawyer->name?>'>
                <label>Фото</label>
                <input type='file' class='form-control' name='img'>
                <label>Работа</label>
                <input type='text' class='form-control' name='work' value='<?php echo $info_lawyer->work?>'>
                <label>Почта</label>
                <input type='text' class='form-control' name='mail' value='<?php echo $info_lawyer->mail?>'>
                <label>Телефон</label>
                <input type='text' class='form-control' name='phone' value='<?php echo $info_lawyer->phone?>'>
                <button type='submit' class='btn btn-warning'>Редактировать</button>
            <?php
            endforeach;
            ?>
            </form>
        </div>

        <div class="col-lg-12 col-md-12">
            <h3 class="centered">Редактирование опыта работы</h3>
            <?php foreach ($experiences as $experience):?>

            <form method="post" action="<?php echo base_url()?>experiences/update_experience">
                <input type="hidden" name="csrf_test_name" value="<?php echo $csrf_hash?>">
                <input type="hidden" name="id" value="<?php echo $experience->id?>">
                <label>Место работы</label>
                <input type="text" class="form-control" name="work_place" value="<?php echo $experience->work_place ?>">
                <label>Дата работы</label>
                <input type="text" class="form-control" name="work_date" value="<?php echo $experience->work_date ?>">
                <label>Описание работы</label>
                <input type="text" class="form-control" name="work_desc" value="<?php echo $experience->work_desc ?>">
                <input type="hidden" name="lawyer_id" value="<?php echo $lawyer_id?>">
                <button class="btn btn-success" type="submit">Редактировать</button>
                <hr>
            </form>

            <?php
            endforeach;
            ?>
        </div>
    </div>
</div>

</body>
</html>