<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Excel;

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
        Excel::create('hh',function ($excel) use ($cellData){
            $excel->sheet('score', function ($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->store('csv');
    }

    public function import()
    {
        $filePath = 'storage/exports/'.'aa.csv';
        Excel::load($filePath, function ($reader){
            $data = $reader->all();
            dd($data);
        },"UTF-8");
    }

}
