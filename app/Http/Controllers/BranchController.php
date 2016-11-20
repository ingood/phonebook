<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $branch = new Branch();
        $branch->name = $request->get('value');
        if($branch->save()){
            return '{"status": "ok", "msg": "添加成功!", "name":"'.$branch->name.'","id":'.$branch->id.'}';
        }else{
            return '{"status": "error", "msg": "你的信息有误!"}';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function json($id)
    {
        // 返回部门信息
        $branch = Branch::findOrfail($id)->toArray();
        return $branch;
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
    public function update(Request $request)
    {
        // pk 就是 contacts 表的 id, 通过前端 data-pk="{{ $contact->id }}" 设置
//        dd($request);
        // x-editable 默认通过 pk 传输 id
        $branch = Branch::findOrFail($request->get('pk'));
        $key = $request->get('name');
        $value = $request->get('value');
        $branch->$key = $value;
        if($branch->save()){
            return '{"status": "ok", "msg": "'.$branch->name.'编辑成功!"}';
        }else{
            return '{"status": "error", "msg": "你的信息有误!"}';
        }
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
        $branch = Branch::findOrFail($id);
        if($branch->delete()){
            return '{"status": "ok", "msg": "'.$branch->name.'删除成功!"}';
        }else{
            return '{"status": "error", "msg": "你的信息有误!"}';
        }
    }
}
