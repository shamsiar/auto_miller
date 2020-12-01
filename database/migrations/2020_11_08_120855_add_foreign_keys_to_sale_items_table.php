<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSaleItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table( 'sale_items', function ( Blueprint $table ) {
            $table->foreign( 'item_id', 'sale_items_ibfk_1' )->references( 'id' )->on( 'items' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'sale_id', 'sale_items_ibfk_2' )->references( 'id' )->on( 'sales' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
        } );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table( 'sale_items', function ( Blueprint $table ) {
            $table->dropForeign( 'sale_items_ibfk_1' );
            $table->dropForeign( 'sale_items_ibfk_2' );
        } );
    }

}
