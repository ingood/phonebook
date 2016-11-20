<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="icon" href="/favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="/libraries/bootstrap-table/bootstrap-table.min.css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]>
    <script src="/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <![endif]-->


</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="imcon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">国网浙江天台县供电公司通讯录</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" id="admin">管理登陆</a></li>
                <li><a href="#">帮助</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search..."  style="display: none;">
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px; display: none;">
        <li class="nav-item open">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-folder"></i>
                <span class="title">Multi Level Menu</span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu" style="display: block;">
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-settings"></i> Item 1
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="javascript:;" target="_blank" class="nav-link">
                                <i class="icon-user"></i> Arrow Toggle
                                <span class="arrow nav-toggle"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-power"></i> Sample Link 1</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-paper-plane"></i> Sample Link 1</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-star"></i> Sample Link 1</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-camera"></i> Sample Link 1</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-link"></i> Sample Link 2</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-pointer"></i> Sample Link 3</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    <div class="row">
        <div class="col-sm-2 col-md-2 sidebar">
            <ul class="list-group" id="nav-branch">
                @foreach($branches as $branch)
                    @if( is_array($branch))
                        <li>
                            <ul class="nav sub-menu">
                                @foreach($branch as $subbranch)
                                    <li><a href="/contacts/list/{{$subbranch->id}}">{{$subbranch->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @elseif(0)
                        <li  class="active"><a href="/contacts/list/{{$branch->id}}">{{ $branch->name }}</a></li>
                    @else
                        <li  class="list-group-item"><a href="#" pk="{{$branch->id}}" class="editbtn add"><span class="glyphicon glyphicon-plus"></span></a> <a href="#" pk="{{$branch->id}}" class="editbtn remove"><span class="glyphicon glyphicon-remove"></span></a> <a data-name="name" class="branchname editable-click" data-pk="{{$branch->id}}" data-title="部门名称" href="/contacts/list/{{$branch->id}}">{{ $branch->name }}</a></li>
                    @endif
                @endforeach
                    <li  class="list-group-item"><a href="#" id="addbranch" data-title="新增单位/部门">新增单位/部门 <span class="glyphicon glyphicon-plus-sign"></span></a></li>
            </ul>
        </div>
        <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 ajaxtable">
            <div class="panel-body" style="padding:0px; ">
                <div id="toolbar" class="btn-group">
                    <button id="btn_add" type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>新增
                    </button>
                    <button id="btn_edit" type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>修改
                    </button>
                    <button id="btn_delete" type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>删除
                    </button>
                </div>
                <table id="tb_contacts"></table>
            </div>
        </div>
        <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 main" style="display: none;">

            {{--<h2 class="sub-header">XX部门通讯录列表</h2>--}}
            <div class="table-responsive">
                <table class="table table-striped table-hover table-condensed">
                    <colgroup>
                        <col style="width:55px;">
                        {{--<col style="width:80px;">--}}
                        <col style>
                        <col style>
                        <col style>
                        <col style="width:38px;">
                        <col style>
                        <col style>
                        <col style>
                    </colgroup>
                    <thead>
                    <tr style="display: none;">
                        <th colspan="9" style="color:darkred;font-weight: bold; font-size: 16px;">● 领导班子</th>
                    </tr>
                    <tr>
                        <th>姓名</th>
                        <th>部门</th>
                        <th>岗位</th>
                        <th>办公</th>
                        <th>微波</th>
                        <th>家庭</th>
                        <th>移动</th>
                        <th>政府</th>
                        <th>短号</th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($contacts as $contact)
                        {{--                    @if($contact->department == '领导班子' )--}}
                        <tr class="xrow">
                            <td><a href="#" data-name="name" class="name" data-pk="{{$contact->id}}"
                                   data-title="输入姓名">{{$contact->name}}</a></td>
                            <td><a href="#" data-name="department" class="department" data-pk="{{$contact->id}}"
                                   data-title="输入部门">{{$contact->department}}</a></td>
                            <td><a href="#" data-name="title" class="title" data-pk="{{$contact->id}}"
                                   data-title="Enter title">{{$contact->title}}</a></td>
                            <td><a href="#" data-name="tel_work" class="tel_work" data-pk="{{$contact->id}}"
                                   data-title="Enter tel_work">{{$contact->tel_work}}</a></td>
                            <td><a href="#" data-name="tel_pager" class="tel_pager" data-pk="{{$contact->id}}"
                                   data-title="Enter tel_pager">{{$contact->tel_pager}}</a></td>
                            <td><a href="#" data-name="tel_home" class="tel_home" data-pk="{{$contact->id}}"
                                   data-title="Enter tel_home">{{$contact->tel_home}}</a></td>
                            <td><a href="#" data-name="tel_cell" class="tel_cell" data-pk="{{$contact->id}}"
                                   data-title="Enter tel_cell">{{$contact->tel_cell}}</a></td>
                            <td><a href="#" data-name="tel_gov" class="tel_gov" data-pk="{{$contact->id}}"
                                   data-title="Enter tel_gov">{{$contact->tel_gov}}</a></td>
                            <td><a href="#" data-name="tel_group" class="tel_group" data-pk="{{$contact->id}}"
                                   data-title="Enter tel_group">{{$contact->tel_group}}</a></td>
                        </tr>
                        {{--@endif--}}
                    @endforeach
                    </tbody>
                </table>
                {!! $contacts->render() !!}


            </div>
        </div>
    </div>
</div>

<div id="msg" class="alert">
    <strong>提示: </strong><span></span>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 9999; display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">新增单位/部门</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <tr>
                        <td>单位/部门名称</td>
                        <td><a href="#"></a></td>
                    </tr>
                    <tr>
                        <td>上级单位/部门</td>
                        <td><a href="#"></a></td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-md-3">单位/部门名称</div><div class="col-md-7"><a href="#"></a></div>
                </div>
                <div class="row">
                    <div class="col-md-3">上级单位/部门</div><div class="col-md-7"><a href="#"></a></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/assets/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
{{--<script src="/assets/js/docs.min.js"></script>--}}
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/assets/js/ie10-viewport-bug-workaround.js"></script>
{{--X-editable. | include x-editable after core library (bootstrap, jquery-ui)!--}}
<link href="/libraries/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
<script src="/libraries/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
{{--bootstrap-table --}}
<script src="/libraries/bootstrap-table/bootstrap-table.min.js"></script>
<script src="/libraries/bootstrap-table/locale/bootstrap-table-zh-CN.js"></script>
{{--bootstrap-table Extensions--}}
{{--<script src="/libraries/bootstrap-table/extensions/editable/bootstrap-table-editable.js">--}}
<script src="/js/bootstrap-table-editable.js"></script>
<script src="/js/bootstrap-editable.js"></script>
{{--By visy--}}
<script src="/js/contacts.js"></script>
{{--<script>--}}
    {{--$(function () {--}}
    {{--$('#tb_contacts').bootstrapTable('resetView');--}}

    {{--});--}}
{{--</script>--}}
</body>
</html>
