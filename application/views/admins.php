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
        .error {
            color: red;
        }
    </style>

</head>
<body>

<div class="container">

    <form method="post" onsubmit="loginAdmin(this)" action="javascript:void(0)">
        <input type="hidden" name="csrf_test_name" value="<?php echo $csrf_hash?>">
        <label>Login: </label>
        <input type="text" name="login" class="form-control">
        <label>Password: </label>
        <input type="password" name="password" class="form-control">
        <div id="admin_error" class="error"></div>
        <input type="submit">
    </form>

</div>

<script>

    function loginAdmin(context) {
        var form = $(context)[0];
        var all_inputs = new FormData(form);
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>" + "admins/login",
            data: all_inputs,
            dataType: "JSON",
            contentType: false,
            processData: false
        }).done(function (message) {
            if (message.admin_error) {
                $(".csrf").val(message.csrf_hash);
                $("#admin_error").html(message.admin_error);
            }

            if (message.admin_success) {
                location.href = "<?php echo base_url()?>categories";
            }
        })
    }


</script>


</body>
</html>