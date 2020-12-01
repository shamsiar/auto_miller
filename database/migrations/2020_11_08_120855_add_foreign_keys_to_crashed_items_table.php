<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCrashedItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table( 'crashed_items', function ( Blueprint $table ) {
            $table->foreign( 'purchase_item_id', 'crashed_items_ibfk_1' )->references( 'id' )->on( 'purchased_items' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'employee_id', 'crashed_items_ibfk_2' )->references( 'id' )->on( 'employees' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
        } );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table( 'crashed_items', function ( Blueprint $table ) {
            $table->dropForeign( 'crashed_items_ibfk_1' );
            $table->dropForeign( 'crashed_items_ibfk_2' );
        } );
    }

}
