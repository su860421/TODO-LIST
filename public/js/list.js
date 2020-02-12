$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({ //-----------------------------------------------------------代辦事項生成
        url: "/show",
        type: "get",
        dataType: "json",
    })
    .done(function(data) {
        for (let value of data) {
            // 丟給 render function
            if (value.finish == 0) {
                addPost(value);
            } else {
                addfinishPost(value);
            }

        }
    })
    .fail(function(err) {
        alert("錯誤");
    })
$(document).ready(function() { //------------------------------------------------新增代辦事項
    $("#submitmsg").click(function() {
        $.ajax({
                url: "/new",
                type: "post",
                dataType: "json",
                data: {
                    title: $("#title").val(),
                    tododate: $("#todolist").val(),
                }
            })
            .done(function(data) {
                if (data.id) {
                    $("input").val("");
                    addPost(data);

                } else { //否則讀取後端回傳 json 資料 errorMsg 顯示錯誤訊息
                    alert(data.msg);
                }
            })
            .fail(function(err) {
                alert("错誤");
            })
    })
    $("#modify").click(function() { //----------------------------------------------------------修改
        var id = $(this).attr("name");
        $.ajax({
                type: "PUT", //傳送方式
                url: '/update', //傳送目的地
                dataType: "json", //資料格式
                data: { //傳送資料
                    id: id,
                    title: $("#modaltitle").val(),
                    tododate: $("#modaldate").val()
                }
            })
            .done(function(returnmsg) {
                if (returnmsg.status) {
                    alert(returnmsg.msg);
                } else {
                    $("#modifymsg").find(":text,datetime-local").each(function() {
                        $(this).val("");
                    });
                    var el = returnmsg.id;
                    document.getElementById('show' + el).innerHTML = ' 帳號 : ' + returnmsg.email + '  , 應完成時間時間 ：' + returnmsg.tododate +
                    '<br><br> 標題 : ' + returnmsg.title + '';
                    alert("已修改")

                }
            })
            .fail(function(err) {
                alert("错誤");
            })
    })
    $("#delemodify").click(function() { //----------------------------------------------------------刪除
        var id = $(this).attr("name");
        delet(id);
    })

});

function Logout(item) {
    $.ajax({
            type: "get", //傳送方式
            url: '/logout', //傳送目的地
            dataType: "json", //資料格式

        })
        .done(function(returnmsg) {
            location.href = "/login";
        })
        .fail(function(err) {
            location.href = "/login";
            alert("已登出");
        })
}

function delet(item) {
    $.ajax({
            type: "post", //傳送方式
            url: '/delet', //傳送目的地
            dataType: "json", //資料格式
            data: { //傳送資料
                id: item,
            }
        })
        .done(function(returnmsg) {
            if (returnmsg.status) {
                alert(returnmsg.msg);
            } else {
                var el = document.getElementById(returnmsg.id);
                //console.log(item);
                el.remove();

            }
        })
        .fail(function(err) {
            alert("错誤");
        })

}

function updat(item) { //---------------------------------------------修改浮動視窗
    $.ajax({
            url: "/updat",
            type: "post",
            dataType: "json",
            data: {
                id: item
            }
        })
        .done(function(update) {
            if (!update.id) {
                alert(update.msg);
            } else {
                document.getElementById('delemodify').name = update.id;
                document.getElementById('modify').name = update.id;
                document.getElementById('modaltitle').placeholder = update.title;
                document.getElementById('modaldate').placeholder = update.tododate;
                $('#updatModal').modal('show')
            }
        })
        .fail(function(err) {
            alert("错誤");
        })
}

function finish(item) { //---------------------------------------------已完成按鈕
    $.ajax({
            url: "/finish",
            type: "post",
            dataType: "json",
            data: {
                id: item
            }
        })
        .done(function(finish) {
            if (!finish.id) {
                alert(finish.msg);
            } else {
                var el = document.getElementById(item.id);
                //console.log(item);
                el.remove();
                addfinishPost(finish);
                alert("已完成該事項");
            }
        })
        .fail(function(err) {
            alert("错誤");
        })
}

function addPost(returnmsg) {
    var item = '' +
        '<div class="panel panel-default" id=' + returnmsg.id + '>' +
        '<div class="panel-heading">' +
        '<h3 class="panel-title" id="show' + returnmsg.id + '">' + ' 帳號 : ' + returnmsg.email + '  , 應完成時間時間 ：' + returnmsg.tododate + '<br><br>' +
        ' 標題 : ' + returnmsg.title +
        '</h3>' +
        '<button type="button" class="btn btn-success pull-right" style="margin-top:-45px;" onclick="updat(' + returnmsg.id + ');">' + '編輯' + '</button>' +
        '<button type="button" class="btn btn-primary pull-right"style="margin-right:80px;margin-top:-45px;" onclick="finish(' + returnmsg.id + ');">' + '已完成' + '</button>' +
        '</div>' +
        '</div>';
    $('#showownlist').append(item);

}

function addfinishPost(returnmsg) {
    var item = '' +
        '<div class="panel panel-default" id=' + returnmsg.id + '>' +
        '<div class="panel-heading">' +
        '<h3 class="panel-title" id="show' + returnmsg.id + '">' + ' 帳號 : ' + returnmsg.email + '  , 應完成時間時間 ：' + returnmsg.tododate + '<br><br>' +
        ' 標題 : ' + returnmsg.title +
        '</h3>' +
        '<button type="button" class="btn btn-danger pull-right" style="margin-top:-45px;" id="delmodify" onclick="delet(' + returnmsg.id + ')">' + '刪除' + '</button>' +
        '<button type="button" class="btn btn-primary pull-right"style="margin-right:80px;margin-top:-45px;" ">' + '已完成' + '</button>' +
        '</div>' +
        '</div>';
    $('#showfinishownlist').append(item);

}

function newownlist(item) { //---------------------------------------------------modal互動視窗顯示
    $('#myModal').modal('show')
}
