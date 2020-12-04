<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table( 'categories', function ( Blueprint $table ) {
            $table->foreign( 'modifier_id', 'categories_ibfk_1' )->references( 'id' )->on( 'users' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
        } );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table( 'categories', function ( Blueprint $table ) {
            $table->dropForeign( 'categories_ibfk_1' );
        } );
    }

}