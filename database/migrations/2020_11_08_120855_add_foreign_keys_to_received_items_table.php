<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToReceivedItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table( 'received_items', function ( Blueprint $table ) {
            $table->foreign( 'crash_item_id', 'received_items_ibfk_1' )->references( 'id' )->on( 'crashed_items' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'item_id', 'received_items_ibfk_2' )->references( 'id' )->on( 'items' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'modifier_id', 'received_items_ibfk_3' )->references( 'id' )->on( 'users' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'purchase_item_id', 'received_items_ibfk_4' )->references( 'id' )->on( 'purchased_items' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
        } );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table( 'received_items', function ( Blueprint $table ) {
            $table->dropForeign( 'received_items_ibfk_1' );
            $table->dropForeign( 'received_items_ibfk_2' );
            $table->dropForeign( 'received_items_ibfk_3' );
            $table->dropForeign( 'received_items_ibfk_4' );
        } );
    }

}
