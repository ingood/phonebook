<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Excel;
use App\Contacts;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacts = Contacts::all();
        return view("contacts/contacts",['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        });
//        dd($data);
        foreach ($data as $row){
//            var_dump($row);
            $contacts = Contacts::create($row);
            $contacts->nickname = '昵称';
            if ($contacts->name == '陈斌'){
                $contacts->name = '陈大斌';
            }
            $contacts->save();
        }
        echo "导入成功!";
    }
}
