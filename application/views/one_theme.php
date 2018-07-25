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
<?php echo "<pre>" ?>
    <input class="csrf" value="<?php echo $csrf_hash?>"> 
<?php echo "</pre>" ?>
<div class="container">
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
                            <a id='a_$category->id' href='" . base_url() . "themes/$category->id'>" . $category->category_name . "</a>
                            <button onclick='deletePress(this)' type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteCategory' data-id='" . $category->id ."' data-name='" . $category->category_name ."'><span class='glyphicon glyphicon-trash'></span></button>
                            <button onclick='updatePress(this)' type='button' class='btn btn-warning' data-toggle='modal' data-target='#updateCategory' data-id='" . $category->id ."' data-name='" . $category->category_name ."'><span class='glyphicon glyphicon-edit'></span></button>
                        </li>
                     </ul>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-9 col-md-9">
            <?php
            foreach ($one_theme as $info_theme) {
                echo "<h1 class='centered'>" . $info_theme->theme_name . "</h1>";
            }
            ?>

            <h3>Комменты: </h3>
            <div id="comments">
                <?php
                foreach ($comments as $comment) {
                    echo "<div class='one-comment'>
                    <div class='user-info'>$comment->user_name, $comment->user_email</div>
                    <div class='comment-text'>$comment->comment_text</div>
                </div>";
                }
                ?>
            </div>
            <form method="post" action="javascript:void(0)" onsubmit="insertComment(this)">
                <input type="hidden" class="csrf" name="csrf_test_name" value="<?php echo $csrf_hash?>">

                <textarea required rows="5" name="comment_text" class="form-control" placeholder="Введите свой коммент"></textarea>
                <label>Ваше имя</label>
                <input required type="text" name="user_name" class="form-control">
                <label>Ваш логин</label>
                <input required type="text" name="user_email" class="form-control">
                <input type="hidden" name="theme_id" value="<?php echo $theme_id?>">
                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>
</div>

<script>
    function insertComment(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "comments/insert_comment",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function (message) {
            $(".csrf").val(message.csrf_hash);
            $(".form-control").val('');
            $("#comments").prepend("<div class='one-comment'>" +
                "<div class='user-info'>" + message.user_name + ", " + message.user_email + "</div> " +
                "<div class='comment-text'>" + message.comment_text + "</div> " +
            "</div>");
        })
    }

</script>


</body>
</html>