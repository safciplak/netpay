<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateFileSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            NestedSet::columns($table);

//            $table->integer('parent');
//            $table->integer('right');
//            $table->integer('left');
//            $table->string('type', 30);
            $table->string('name', 60);
//            $table->text('children');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('files', function (Blueprint $table) {
//            NestedSet::dropColumns($table);
            Schema::dropIfExists('files');
        });
    }
}
