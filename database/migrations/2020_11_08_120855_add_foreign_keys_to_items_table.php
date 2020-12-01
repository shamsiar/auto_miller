<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table( 'items', function ( Blueprint $table ) {
            $table->foreign( 'category_id', 'items_ibfk_1' )->references( 'id' )->on( 'categories' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'modifier_id', 'items_ibfk_2' )->references( 'id' )->on( 'users' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
        } );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table( 'items', function ( Blueprint $table ) {
            $table->dropForeign( 'items_ibfk_1' );
            $table->dropForeign( 'items_ibfk_2' );
        } );
    }

}
