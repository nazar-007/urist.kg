function insertTheme(context) {
    var form = $(context)[0];
    var all_inputs = new FormData(form);
    var url = document.querySelector('.url').getAttribute('data-url');
    console.log(url);
    $.ajax({
        method: "POST",
        url: url+"pdf_file/insert_category",
        data: all_inputs,
        dataType: "JSON",
        contentType: false,
        processData: false
    }).done(function (message) {
        $(".csrf").val(message.csrf_hash); // обрати внимание, что таким образом меняются все токены CSRF c классом csrf.
        $(".form-control").val('');
        $("#insertTheme").trigger('click');
        $("#table_themes_body").append("<tr><td style='background-color:white;'>10</td><td>"+message.category_dis+"</td><td>"+message.category_name+"</td><td><button data-id="+message.id+" data-dis="+message.dis+" data-name="+message.name+" type='button' class='btn btn-info' data-toggle='modal' data-target='#updateTheme' onclick='updateThemeFirst(this)'>Изменить категорию</button></td></tr>");
                                                                 
        });
}
function insertThemeFile(context) {
    var form = $(context)[0];
    var all_inputs = new FormData(form);
    var url = document.querySelector('.url').getAttribute('data-url');
    console.log(url);
    $.ajax({
        method: "POST",
        url: url+"pdf_file/insert_category_file",
        data: all_inputs,
        dataType: "JSON",
        contentType: false,
        processData: false
    }).done(function (message) {
        $(".csrf").val(message.csrf_hash); // обрати внимание, что таким образом меняются все токены CSRF c классом csrf.
        $(".form-control").val('');
        $("#insertTheme").trigger('click');
        $("#table_themes_body").append("<tr><td style='background-color:white;'>"+message.name+"</td><td><button data-id="+message.id+" type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteCategory' onclick='updateThemeFirst(this)'>Удалить файл</button></td><td><a href='"+url+"pdf_files/"+message.route+"'><button data-id="+message.id+"  type='button' class='btn btn-success' >Скачать</button></td></a></tr>");
        

    });
}
function deletePress(context) {
    var id = context.getAttribute('data-id');
    var delete_id = document.getElementById('delete_id');
    delete_id.value = id;
}
function deleteCategory(context) {
    var form = $(context)[0];
    var all_inputs = new FormData(form);
    var url = document.querySelector('.url').getAttribute('data-url');
    $.ajax({
        method: "POST",
        url: url+"pdf_file/delete_category",
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
function updateTheme(context) {
    var form = $(context)[0];
    var all_inputs = new FormData(form);
    var url = document.querySelector('.url').getAttribute('data-url');
    console.log(url);
    $.ajax({
        method: "POST",
        url: url+"pdf_file/update_category",
        data: all_inputs,
        dataType: "JSON",
        contentType: false,
        processData: false
    }).done(function (message) {
        $(".csrf").val(message.csrf_hash); // обрати внимание, что таким образом меняются все токены CSRF c классом csrf.
        $(".form-control").val('');
        $("#updateTheme").trigger('click');
        $('.clicked').attr('data-name',message.category_dis);
        $('.clicked').attr('data-dis',message.category_name);
        $('.clicked').parent().prev().html(message.category_dis);
        $('.clicked').parent().prev().prev().html(message.category_name);
    })
}
function updateThemeFirst(context){
        var id = context.getAttribute('data-id');
        var category_name = context.getAttribute('data-name');
        var category_dis = context.getAttribute('data-dis');
        console.log(id);
        document.getElementById('update_id').value = id;
        document.getElementById('update_name').value = category_name;
        document.getElementById('update_dis').value = category_dis;
        document.querySelector('.btn').classList.remove('pushed');
        context.classList.add('clicked');  
}