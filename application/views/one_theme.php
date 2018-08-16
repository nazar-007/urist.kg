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
    <title>One theme</title>
    <style>
        #comments {
            margin-bottom: 10px;
        }
        .one-comment {
            margin-bottom: 10px;
            background-color: #2cc36b;
            border: 3px solid red;
        }
        .user-info {
            background-color: seagreen;
        }
        .comment-text {
            font-size: 1.5em;
        }
        .centered {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <a href="<?php echo base_url()?>categories">На главную</a>
    <div class="row">
        <div class="col-lg-3 col-md-9">
            <table id="table_categories" border="1">
                <tbody>
                <?php
                foreach ($categories as $category) {
                    $category_id = $category->id;
                    $this->load->model('themes_model');
                    echo "<ul id='ul_$category->id'>
                        <li>
                            <a id='a_$category->id' href='" . base_url() . "themes/$category->id'>" . $category->category_name . "</a>";
//                            <button onclick='deletePress(this)' type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteCategory' data-id='" . $category->id ."' data-name='" . $category->category_name ."'><span class='glyphicon glyphicon-trash'></span></button>
//                            <button onclick='updatePress(this)' type='button' class='btn btn-warning' data-toggle='modal' data-target='#updateCategory' data-id='" . $category->id ."' data-name='" . $category->category_name ."'><span class='glyphicon glyphicon-edit'></span></button>
                    echo "</li>
                     </ul>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-9 col-md-9">
            <?php
            foreach ($one_theme as $info_theme) {
                echo "<h3 class='centered'>" . $info_theme->theme_name . "</h3>";
                echo "<h5>" . $info_theme->theme_desc . "</h5>";
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>