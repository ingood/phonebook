<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Excel;
use App\Contacts;

class ExcelController extends Controller
{
    // Excel 文件到处功能

    public function export()
    {
        $cellData = [
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];


        // dd($cellData);
        // iconv在转换字符"—"到gb2312时会出错,可以采用 `//IGNORE` 忽略转换中的错误。//TRANSLIT

        Excel::create('haha',function ($excel) use ($cellData){
            $excel->sheet('学生成绩', function ($sheet) use ($cellData){
                $sheet->rows($cellData);
            })->export('xls');
        });
    }

    public function import()
    {


        $filePath = 'storage/exports/'.'tttxl.xls';
        $data = [];
        // &$data 加上 `&` 则变量为地址传递,对象外将可以调用改版的内容。
        Excel::load($filePath, function ($reader) use (&$data) {
//            $data = $reader->get()->toArray();
            $data = $reader->get()->toArray();

//            $data=$row->firstname;
//            $data = $reader->dump(); // 输出读取结果,以对象的模式

//            // Loop through all sheets
//            $reader->each(function($row) {
//                dump($row);
//            });

        });

        // 选择一个指定的表
        Excel::selectSheets('abc')->load($filePath, function ($reader) use (&$data) {
//            $data = $reader->dump(); // 输出读取结果,以对象的模式
        });

        // 通过索引选择一个指定的表
        Excel::selectSheetsByIndex(0)->load($filePath, function ($reader) use (&$data) {
//            $data = $reader->dump(); // 输出读取结果,以对象的模式
        });

        // 选择表中的列
        Excel::selectSheetsByIndex(0)->load($filePath, function ($reader) use (&$data) {
//            $data = $reader->dump(); // 输出读取结果,以对象的模式
            $data = $reader->get(array('name','department'));
            dd($data);
        });
    }

}
