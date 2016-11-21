<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('branches',function (Blueprint $table){
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->comment('父机构id');
            $table->string('name')->comment('部门名称');
            $table->string("branch")->comment('所属机构');
            $table->integer('ordering')->comment('排序');
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('branches');
    }
}
