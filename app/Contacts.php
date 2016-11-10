<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    // $fillable和$guarded方法同时只能定义一个，原因嘛很简单，非黑即白，定义了一个另外一个也就确定了。
    // “黑名单”,定义在$guarded中的属性在批量赋值时会被过滤掉。名单对 save 不影响。
    protected $guarded = ['updated_at','created_at'];
    // “白名单”,定义在$fillable中的属性可以通过批量赋值进行赋值。名单对 save 不影响。
//    protected $fillable = ['branch_id','name','fn','nickname','bday','tag','org','room','title','email','tel_work','tel_pager','tel_home','tel_cell','tel_gov','tel_group','adr_work','adr_home','city','url','wechat','qq','impp','note','photo','ordering'];

}
