<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id')->unsigned()->comment('部门ID');
            $table->string('name')->nullable()->comment('姓名');
            $table->string('fn')->comment('vCard formatted name');
            $table->string('nickname')->comment('昵称');
            $table->date('bday')->comment('生日');
            $table->string('tag')->comment('标签');
            $table->string('org')->comment('机构;部门');
            $table->string('room')->comment('门牌号');
            $table->string('title')->comment('职务');
            $table->string('email')->comment('主要邮件');
            $table->string('tel_work')->comment('办公室电话');
            $table->string('tel_pager')->comment('系统号');
            $table->string('tel_home')->comment('宅电');
            $table->string('tel_cell')->comment('手机');
            $table->string('tel_gov')->comment('政府网');
            $table->string('tel_group')->comment('电力网');
            $table->string('adr_work')->comment('工作地址');
            $table->string('adr_home')->comment('家庭地址');
            $table->string('city')->comment('所在城市');
            $table->string('url')->comment('个人网址');
            $table->string('wechat')->comment('微信号');
            $table->string('qq')->comment('QQ号');
            $table->string('impp')->comment('即使消息');
            $table->string('note')->comment('备注');
            $table->string('photo')->comment('头像url');
            $table->integer('ordering')->comment('排序');
            $table->timestamps();
            $table->index('name');
            $table->foreign('branch_id')->references('id')->on('branches')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contacts');
    }
}

