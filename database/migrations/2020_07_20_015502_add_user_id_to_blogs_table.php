<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index()->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            /*when we migrate refresh or rollback the migration, we will get error due to using foreign key in the up method.
             to remove this error we will also drop Foreign key in the down method */
            $table->dropForeign('user_id');
             $table->dropColumn('user_id');
        });
    }
}
