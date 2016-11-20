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
    <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
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
                <input type="text" class="form-control" placeholder="Search..." style="display: none;">
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true"
        data-slide-speed="200" style="padding-top: 20px; display: none;">
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
            <div class="list-group" id="nav-branch">
                @foreach($branches as $branch)
                    <a href="javascript:void(0);" class="branchname list-group-item" data-name="name"
                       class="branchname"
                       data-pk="{{$branch->id}}"
                       data-title="部门名称">{{ $branch->name }}</a>
                @endforeach
                @if( !empty($isAdmin) and ($isAdmin == true) )
                    <a href="javascript:void(0);" id="addbranch" data-title="新增单位/部门" class="branchname list-group-item">
                        新增单位/部门<span class="glyphicon glyphicon-plus-sign"></span>
                    </a>
                @endif
            </div>
            <div id="branchset"><i class="icon-settings"></i><i class="icon-plus" data-toggle="modal" data-target="#newBranchModal"></i></div>
        </div>
        {{-- 主体表格开始 --}}
        <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 ajaxtable">
            <div class="panel-body" style="padding:0px; ">
                {{--工具栏部分--}}
                @if(!empty($isAdmin) and ($isAdmin == true) )
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
                @else
                    <div id="toolbar" class="btn-group">
                        <h4 style="padding: 0px; margin: 0px;">国网天台县供电公司</h4>
                    </div>
                @endif
                {{--表格加载部分--}}
                <table id="tb_contacts" data-toggle=""></table>
            </div>
        </div>
        {{-- 主体表格结束 --}}
    </div>
    <div id="newBranchModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">新增单位/部门</h4>
                </div>
                <div class="modal-body">
                    <form action="" role="form">
                        <div class="form-group"><label for="newBranchName">新单位名称</label><input type="text"
                                                                                               class="form-control"
                                                                                               id="newBranchName"
                                                                                               placeholder="请输入新单位名称">
                        </div>
                        <div class="form-group"><label for="parentBranchName">上级单位名称</label><select name="parentBranchName" id="parentBranchName" class="form-control selectpicker">
                                @foreach($branches as $branch)
                                <option value="$branch->id">{{$branch->name}}</option>
                                @endforeach
                            </select></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<div id="msg" class="alert">
    <strong>提示: </strong><span></span>
</div>
<div id="editbtn" style="display: none;"><span pk="{{$branch->id}}" class="glyphicon glyphicon-plus editbtn add"></span><span pk="{{$branch->id}}" class="glyphicon glyphicon-remove editbtn remove"></span></div>


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
<script src="/libraries/bootstrap-table/bootstrap-table.js"></script>
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

</html>
