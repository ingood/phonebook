/**
 * Created by Ade on 2016/11/15.
 */

/**
 * 得到窗口主体部分的实际高度
 * @returns {number|*}
 */
function getHeight() {
    // 表格现实高度 = 窗口高度 - 顶部菜单高度
    tbHeight = $(window).height() - $('nav').height();
    // alert($('nav').outerHeight(true);
    return tbHeight;
}

/**
 * 页面加载完成后,实例化表格和表格上面的按钮
 */
var isAdmin = false;
$(function () {
    //1.初始化Table
    var oTable = new TableInit();
    oTable.Init();

    // 2.初始化Button的点击事件
    var oButtonInit = new ButtonInit();
    oButtonInit.Init();

    // 侧边栏单位导航部分的实际高度初始化
    $('#nav-branch').height(getHeight()-78);
    // 窗口变化时改变表格和侧边栏的现实高度
    $(window).resize(function () {
        $("#tb_contacts").bootstrapTable('resetView', {
            height: getHeight()
        });
        $('#nav-branch').height(getHeight()-78);
        console.log($('#nav-branch').height());
    });


    // 非管理状态时的页面操作
    if (isAdmin == false) {
        /**
         * 点击 branch 名称,调用后台数据刷新列表内容
         */
        $('a.branchname').click(
            function () {
                $(this).parent().addClass('active').siblings().removeClass('active');
                var id = $(this).attr("data-pk");
                // // json 方式取得当前部门的名称,效率不高,还是直接页面获取好
                // $.get("/branch/json/"+id, function (res) {
                //     $('#toolbar').html(res.name);
                // });
                $('#toolbar h4').html($(this).html());
                // 执行 refreshOptions 操作,就能重新调用 url,而不用再执行 refresh 或者 load 操作。
                // 另外 refresh 和 load 都是单次操作,同一页面可以,不同页码调用还是使用 refreshOptions 更好。
                $('#tb_contacts').bootstrapTable('refreshOptions', {
                    url: '/contacts/json/' + id,
                    // 切换回第一页,否则传递的 page 参数还是刚才的页码,需要传递 pageNumber 来重置才可
                    pageNumber: 1
                });
            }
        );
    }
});

/**
 * 页面加载完成后,实例化 x-editable,并执行相关操作
 */
$(function () {
    // 解决 laravel csrf 错误的方法1
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if (isAdmin == false) {
        // 设置表格的可编辑状态
        $.fn.editable.defaults.disabled = true;
    }
    $('#nav-branch a').on('save',function (e, params) {
        $(this).css("color","red");
    });
});

/**
 * 初始化bootstrap-table表格对象,需实例化 TableInit,并执行 Init() 后,表格实际生成才完成。
 * @returns {Object}
 * @constructor
 */
var TableInit = function () {
    // 等同于 var oTableInit = new Object(),采用后者PS会提示"Object instantiation can be simplified"
    var oTableInit = {};
    $("#toolbar").prop('display', "");
    // 初始化Table
    oTableInit.Init = function () {
        $('#tb_contacts').bootstrapTable({
            height: getHeight(),           //行高，如果没有设置height属性，表格自动根据记录条数觉得表格高度
            url: '/contacts/json',         //请求后台的URL（*）
            method: 'get',                      //请求方式（*）
            toolbar: '#toolbar',                //工具按钮用哪个容器
            striped: true,                      //是否显示行间隔色
            cache: false,                       //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
            pagination: true,                   //是否显示分页（*）
            sortable: false,                     //是否启用排序
            sortOrder: "asc",                   //排序方式
            queryParams: oTableInit.queryParams,//传递参数（*）
            sidePagination: "server",           //分页方式：client客户端分页，server服务端分页（*）
            pageNumber: 1,                       //初始化加载第一页，默认第一页
            pageSize: 20,                       //每页的记录行数（*）
            pageList: [10, 20, 50, 100],        //可供选择的每页的行数（*）
            search: true,                       //是否显示表格搜索，此搜索是客户端搜索，不会进服务端，所以，个人感觉意义不大
            //strictSearch: true,
            showColumns: true,                  //是否显示所有的列
            showRefresh: true,                  //是否显示刷新按钮
            minimumCountColumns: 2,             //最少允许的列数
            clickToSelect: true,                //是否启用点击选中行
            uniqueId: "ID",                     //每一行的唯一标识，一般为主键列
            showToggle: true,                    //是否显示详细视图和列表视图的切换按钮
            cardView: false,                    //是否显示详细视图
            detailView: false,                   //是否显示父子表
            columns: [{
                // 增加 field 可以对 checkbox 这列进行控制,但是也会将该值提交到后台,会造成后台出错。所以还是取消较好。
                // field: 'checkbox',
                // 如果 admin 为 true,则显示 checkbox,否则隐藏该列
                visible: isAdmin,
                checkbox: true
            }, {
                field: 'name',
                title: '姓名',
                // 65 可以显示3个字,72 可以显示4个汉字
                width: 72,
                editable: {
                    type: 'text',
                    title: '姓名',
                    validate: function (v) {
                        if (!v) return '用户名不能为空';
                        var partten = /^[\u4e00-\u9fa5、\s]+$/;
                        if (!partten.test(v)) return '请输入中文';
                    }
                }
            }, {
                field: 'department',
                title: '单位/部门',
                visible: isAdmin,
                editable: {
                    type: 'text',
                    title: '单位/部门',
                    validate: function (v) {
                        if (!v) return '单位/部门不能为空';
                        var partten = /^[\u4e00-\u9fa5、\s]+$/;
                        if (!partten.test(v)) return '请输入中文';
                    }
                }
            }, {
                field: 'title',
                title: '职务',
                editable: {
                    type: 'text',
                    title: '职务',
                    validate: function (v) {
                        var partten = /^[\u4e00-\u9fa5、\s]+$/;
                        if (!partten.test(v) && v) return '请输入中文';
                    }
                }
            }, {
                field: 'tel_work',
                title: '办公电话',
                editable: {
                    type: 'text',
                    title: '办公电话',
                    validate: function (v) {
                        if (!v) return '办公电话不能为空';
                        var partten = /^\d{8}$/;
                        if (!partten.test(v) && v) return '办公电话为8位数字';
                    }
                }
            }, {
                field: 'tel_pager',
                title: '系统号', editable: {
                    type: 'text',
                    title: '系统号',
                    validate: function (v) {
                        // 如果非空值,正则判断合法性
                        var partten = /^\d{4}$/;
                        if (!partten.test(v) && v) return '系统号为4位数字';
                    }
                }
            }, {
                field: 'tel_home',
                title: '宅电', editable: {
                    type: 'text',
                    title: '宅电',
                    validate: function (v) {
                        // 如果非空值,正则判断合法性
                        var partten = /^\d{4,8}$/;
                        if (!partten.test(v) && v) return '宅电为4-8位数字';
                    }
                }
            }, {
                field: 'tel_cell',
                title: '手机',
                editable: {
                    type: 'text',
                    title: '手机',
                    validate: function (v) {
                        // 如果非空值,正则判断合法性
                        var partten = /^1[3,5,8]\d{9}$/;
                        if (!partten.test(v) && v) return '请输入正确手机号码';
                    }
                }
            }, {
                field: 'tel_gov',
                title: '政府网',
                editable: {
                    type: 'text',
                    title: '政府网',
                    validate: function (v) {
                        // 如果非空值,正则判断合法性
                        var partten = /^\d{6}$/;
                        if (!partten.test(v) && v) return '政府网为6位数字';
                    }
                }
            }, {
                field: 'tel_group',
                title: '电力网',
                editable: {
                    type: 'text',
                    title: '电力网',
                    validate: function (v) {
                        // 如果非空值,正则判断合法性
                        var partten = /^6\d{5}$/;
                        if (!partten.test(v) && v) return '请输入正确的电力网号码';
                    }
                }
            }],
            onEditableSave: function (field, row, oldValue, $el) {
                // 表格编辑后,行列可能撑开,和表格头部不一致,所以需要重新设置行列宽度。
                $('#tb_contacts').bootstrapTable('resetView');
                $.ajax({
                    type: "post",
                    url: "/contacts/update",
                    data: row,
                    dataType: 'JSON',
                    success: function (data, status) {
                        if (status == "success") {
                            topAlert('提交数据成功');
                        }
                    },
                    error: function () {
                        alert('编辑失败');
                    },
                    complete: function () {
                    }

                });
            }
        });
    };

    //得到查询的参数,该参数自定义添加
    oTableInit.queryParams = function (params) {
        var temp = {   //这里的键的名字和控制器的变量名必须一直，这边改动，控制器也需要改成一样的
            per_page: params.limit,   //页面大小
            page: (params.offset / params.limit + 1),  //页码
            search: params.search,
            order: params.order,
            offset: params.offset,
            limit: params.limit,
            // 取得页面其他元素值的方式
            // departmentname: $("#txt_search_departmentname").val(),
            statu: $("#txt_search_statu").val()
        };
        return temp;
    };

    return oTableInit;
};

/**
 * 初始化页面上面的按钮事件
 * @returns {Object}
 * @constructor
 */
var ButtonInit = function () {
    var oInit = new Object();
    var postdata = {};

    oInit.Init = function () {
        //初始化页面上面的按钮事件
    };

    return oInit;
};

/**
 * 显示提示框,并自动隐藏,本页面没有采用该函数
 * @param tip 提示信息
 * @param type 'success'是成功信息，'danger'是失败信息,'info'是普通信息
 */
function showTip(tip, type) {
    var $tip = $('#tip');
    $tip.attr('class', 'alert alert-' + type).text(tip).css('margin-left', -$tip.outerWidth() / 2).fadeIn(500).delay(2000).fadeOut(500);
}

/**
 * 顶部弹出框,可以自定义提示类型、提示信息和弹出对象
 * @param msg
 * @param type
 * @param div
 */
function topAlert(msg, type, div) {
    type = type || "success";
    div = div || "#msg";
    $(div).removeClass('alert-success').removeClass('alert-info').removeClass('alert-warning').removeClass('alert-danger');
    var strong;
    switch (type) {
        case 'success':
            strong = "真棒! ";
            $(div).addClass("alert-success");
            break;
        case 'info':
            strong = "注意! ";
            $(div).addClass("alert-info");
            break;
        case 'warning':
            strong = "警告! ";
            $(div).addClass("alert-warning");
            break;
        case 'danger':
            strong = "悲催!! ";
            $(div).addClass("alert-danger");
            break;
        default:
            strong = "提示! ";
            $(div).addClass("alert-info");
    }
    $(div + '>strong').html(strong);
    $(div + '>span').html(msg);
    $(div).fadeIn(500).delay(2000).fadeOut(500);
}

/**
 * 生成可编辑的 x-editable
 */

$(document).ready(function () {
    if (isAdmin == true) {
        /**
         * editable 默认 ajax 参数配置
         * @type {{type: string, dataType: string}}
         */
        $.fn.editable.defaults.ajaxOptions = {
            type: 'post',
            // 此处设置为 json,则返回的 json 数据不再用 eval 转化。
            dataType: 'json'
        };

        // editable 的显示模式,popup 还是 inline
        $.fn.editable.defaults.mode = 'popup';
        // 空值的现实样式,此处设置为"-"
        $.fn.editable.defaults.emptytext = '—';
        // 错误的 response 参数包含整个页面响应,如响应状态 response.status
        $.fn.editable.defaults.error = function (response, newValue) {
            if (response.status === 500) {
                return '糟糕! 服务出错, 重试看看!';
            } else {
                return response.responseText;
            }
        };

        /**
         * 对页面中联系人元素进行编辑操作
         */
        $('.name,.title,.tel_work,.tel_pager,.tel_home,.tel_cell,.tel_gov,.tel_group').editable({
            type: 'text',
            // 记录的 id 通过 pk 进行传输
            url: '/contacts/update',
//            title: '输入姓名',
            // 解决 laravel csrf 错误的方法2
//            params: {_token:token},
            success: function (response, newValue) {
//                alert(response);
//                var response = eval ("(" + response + ")");
                if (response.status == 'ok') {
                    topAlert(response.msg);
                } else if (response.msg) {
                    topAlert(response.msg, 'danger')
                } else {
                    return false;
                }
//                return response.msg; //msg will be shown in editable form 信息显示在编辑区域,不是很方便。
            }
        });

        /**
         * 单位部门的编辑操作,采用 selector 属性模式,可以对动态新增的元素加载 editable 扩展。
         */
        $('#nav-branch').editable({
            selector: 'a',
            type: 'text',
            mode: 'inline',
            url: '/branch/update',
            highlight: "#019A61",
            success: function (response, newValue) {
                if (response.status == 'ok') {
                    topAlert(response.msg);
                } else if (response.msg) {
                    topAlert(response.msg, 'danger')
                } else {
                    return false;
                }
            }
        });



        // 给侧边栏链接添加可编辑样式
        // $('#nav-branch a').addClass('editable-click');
        /**
         * 通过 editable 在页面直接新增单位部门
         */
        $('#addbranch').editable({
            mode: 'inline',
            showbuttons: false,
            pk: 1,                   // 记录的 id 通过 pk 进行传输
            url: 'branch/store',    // 新增记录服务端执行页面
            defaultValue: '',       // 编辑状态初始化的值
            display: false,
            value: "",              // 编辑状态的值
            success: function (response, newValue) {
                if (response.status == 'ok') {
                    topAlert(response.msg);
                    $(this).parent().before('<li class="list-group-item"><a href="branch/' + response.id + '" pk="' + response.id + '" class="editbtn add"><span class="glyphicon glyphicon-plus"></span></a> <a href="#" pk="' + response.id + '" class="editbtn remove"><span class="glyphicon glyphicon-remove"></span></a> <a data-name="name" class="branchname editable-click" data-pk="' + response.id + '" data-title="部门名称" href="/contacts/list/' + response.id + '">' + response.name + '</a></li>');
                } else {
                    topAlert(response.msg, 'danger')
                }
            }
        });

        /**
         * 鼠标移到侧边栏 branch 名称上,显示删除和新建按钮,移出时隐藏这两个按钮
         */
        $('#nav-branch').on('mouseover mouseout', '.list-group-item', function (e) {
            if (e.type == 'mouseover') {
                $(this).children('.editbtn').show();
            } else if (e.type == 'mouseout') {
                $(this).children('.editbtn').hide();
            }
        });
        /**
         * 侧边栏单位部门悬浮时显示的新增按钮相关操作
         */
        $('a.editbtn.add').click(function (event) {
            event.stopPropagation();
            event.preventDefault();
            alert('d');
            var id = $(this).attr("pk");
            $.ajax({
                url: '/branch/add/{id}',
                type: 'GET', //GET
                async: true,    //或false,是否异步
                data: {
                    id: id
                },
                timeout: 5000,    //超时时间
                dataType: 'json'    //返回的数据格式：json/xml/html/script/jsonp/text
                // beforeSend:function(xhr){
                //     console.log(xhr)
                //     console.log('发送前')
                // },
                // success:function(data,textStatus,jqXHR){
                //     console.log(data)
                //     console.log(textStatus)
                //     console.log(jqXHR)
                // },
                // error:function(xhr,textStatus){
                //     console.log('错误')
                //     console.log(xhr)
                //     console.log(textStatus)
                // },
                // complete:function(){
                //     console.log('结束')
                // }
            });
        });

        /**
         * 点击该 branch 的删除按钮,删除该 branch
         */
        $('#nav-branch').on('click', 'a.editbtn.remove', function () {
            event.stopPropagation();
            event.preventDefault();
            alert('del');
            var id = $(this).attr("pk");
            $.ajax({
                url: '/branch/remove/' + id,
                type: 'GET', //GET
                async: true,    //或false,是否异步
                data: {
                    id: id
                },
                timeout: 5000,    //超时时间
                dataType: 'json',    //返回的数据格式：json/xml/html/script/jsonp/text
                success: function (response, status) {
                    topAlert(response.msg);

                },
                error: function (response, status) {
                    topAlert(response.msg);
                }
            });
            $(this).parent().remove();
        });
    }

    /**
     * model 新增部门,一定要设置返回类型 json,这样才能正确识别返回的 json 数据
     */
    $('#addBranchBtn').click(function () {
        pbid = $('#parentBranchName').val();
        $.post('/branch/store', $('#newBranchForm').serialize(),
            function (res) {
                topAlert("新增部门<" + res.name + ">成功!");
                $("#parentBranchName option[value="+pbid+"]").after('<option value="'+res.id+'"> &emsp;'+res.name+'</option>');
                $('#nav-branch a[data-pk='+pbid+']').after('<a href="javascript:void(0);" class="branchname list-group-item pdl1" data-name="name" data-pk="'+res.id+'" data-title="'+res.name+'">'+res.name+'</a>');
            },"json");
    });

});
