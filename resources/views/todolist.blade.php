<!DOCTYPE html>
<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/2.3.1/js/bootstrap-modal.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="/" style="font-weight:bolder">代辦事項</a>
          </div>
          <div class="btn-group pull-right btn-group-lg" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary" onclick="newownlist('1');">新增代辦事項</button>
            <button type="button" class="btn btn-secondary" onclick="Logout(1);">登出</button>
          </div>
        </div>
    </nav>
        <h1 align="center">尚未完成</h1></br>

    <div id="showownlist">
    </div>

    <h1 align="center">已完成</h1></br>
      <div id="showfinishownlist">
      </div>

    <div class="updatems">
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">新增一個代辦事項</h4>
              </div>
              <form class="bs-example bs-example-form" role="form" id="modifymsg">
                <div class="input-group" style="margin-left:20px;">
                   <input type="text" class="form-control" placeholder="事件名稱" name="title" id="title" style="margin-top:10px;"></br>
                </div>
                <div class="input-group" style="margin-left:20px;">
                  <input type="datetime-local" class="form-control"  name="todolist" id="todolist" style="margin-top:10px;"></input></br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top:20px;">關閉</button>
                    <button type="button" class="btn btn-dark" id="submitmsg" style="margin-top:20px;">新增代辦事項</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>

    <div class="updatmsg">
      <div class="modal fade" id="updatModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">修改該筆資料</h4>
              </div>
              <form class="bs-example bs-example-form" role="form" id="modifymsg">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="" id="modaltitle" style="margin-left:10px;"></br>
                </div>
                <div class="input-group">
                  <input type="datetime-local" class="form-control input-group-lg" placeholder="" id="modaldate" style="margin-top:10px;margin-left:10px;"></textarea></br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                    <button type="button" class="btn btn-primary" id="modify" name="" data-dismiss="modal">修改</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
    <script src="js/list.js" type='text/javascript'></script>
  </body>
</html>
