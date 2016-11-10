
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
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
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">国网浙江天台县供电公司通讯录</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">管理登陆</a></li>
                <li><a href="#">帮助</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="#">Overview</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#">Analytics</a></li>
                <li><a href="#">Export</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="">Nav item</a></li>
                <li><a href="">Nav item again</a></li>
                <li><a href="">One more nav</a></li>
                <li><a href="">Another nav item</a></li>
                <li><a href="">More navigation</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="">Nav item again</a></li>
                <li><a href="">One more nav</a></li>
                <li><a href="">Another nav item</a></li>
            </ul>
        </div>
        <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 main">
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
                    <tr>
                        <th colspan="9" style="color:darkred;font-weight: bold; font-size: 16px;">● 领导班子</th>
                    </tr>
                    <tr>
                        <th>姓名</th>
                        {{--<th>部门</th>--}}
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
                    {{--@if($contact->department == '办公室' )--}}
                    <tr>
                        <td>{{$contact->name}}</td>
{{--                        <td>{{$contact->department}}</td>--}}
                        <td>{{$contact->title}}</td>
                        <td>{{$contact->tel_work}}</td>
                        <td>{{$contact->tel_pager}}</td>
                        <td>{{$contact->tel_home}}</td>
                        <td>{{$contact->tel_cell}}</td>
                        <td>{{$contact->tel_gov}}</td>
                        <td>{{$contact->tel_group}}</td>
                    </tr>
                    {{--@endif--}}
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/assets/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/assets/js/docs.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
