<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::table('branches')->insert(
            array(
                'id'        => 1,
                'parent_id' => 1,
                'name'      => '国网浙江天台县供电公司',
                'branch'    => '国网浙江天台县供电公司',
                'ordering'  => 1
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
