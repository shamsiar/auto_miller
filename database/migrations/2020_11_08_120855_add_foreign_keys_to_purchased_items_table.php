<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPurchasedItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table( 'purchased_items', function ( Blueprint $table ) {
            $table->foreign( 'item_id', 'purchased_items_ibfk_1' )->references( 'id' )->on( 'items' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'purchase_id', 'purchased_items_ibfk_2' )->references( 'id' )->on( 'purchases' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
        } );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table( 'purchased_items', function ( Blueprint $table ) {
            $table->dropForeign( 'purchased_items_ibfk_1' );
            $table->dropForeign( 'purchased_items_ibfk_2' );
        } );
    }

}
