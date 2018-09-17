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
    <title>One new</title>
</head>
<body>
<div class="container">
    <a href="<?php echo base_url()?>reports">Ко всем репортажам</a>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <?php
            foreach ($one_report as $info_report) {
                $report_id = $info_report->id;

                echo "<h3 class='centered'>" . $info_report->name . "</h3>";
                echo "<h5>" . $info_report->text . "</h5>";
                echo "<h5>" . $info_report->date . "</h5>";
                echo "<img src='" . base_url()."uploads/" . $info_report->img . "'>";

            }
            ?>
        </div>
    </div>
</div>

</body>
</html>