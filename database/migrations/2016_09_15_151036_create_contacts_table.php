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
            $table->integer('branch_id')->unsigned()->default(1)->comment('部门ID');
            $table->string('name')->comment('姓名');
            $table->string('fn')->nullable()->comment('vCard formatted name');
            $table->string('nickname')->nullable()->comment('昵称');
            $table->date('bday')->nullable()->comment('生日');
            $table->string('tag')->nullable()->comment('标签');
            $table->string('org')->nullable()->comment('机构;部门');
            $table->string('department')->nullable()->comment('部门');
            $table->string('room')->nullable()->comment('门牌号');
            $table->string('title')->nullable()->comment('职务');
            $table->string('email')->nullable()->comment('主要邮件');
            $table->string('tel_work')->nullable()->comment('办公室电话');
            $table->string('tel_pager')->nullable()->comment('系统号');
            $table->string('tel_home')->nullable()->comment('宅电');
            $table->string('tel_cell')->nullable()->comment('手机');
            $table->string('tel_gov')->nullable()->comment('政府网');
            $table->string('tel_group')->nullable()->comment('电力网');
            $table->string('adr_work')->nullable()->comment('工作地址');
            $table->string('adr_home')->nullable()->comment('家庭地址');
            $table->string('city')->nullable()->comment('所在城市');
            $table->string('url')->nullable()->comment('个人网址');
            $table->string('wechat')->nullable()->comment('微信号');
            $table->string('qq')->nullable()->comment('QQ号');
            $table->string('impp')->nullable()->comment('即使消息');
            $table->string('note')->nullable()->comment('备注');
            $table->string('photo')->nullable()->comment('头像url');
            $table->integer('ordering')->nullable()->comment('排序');
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

