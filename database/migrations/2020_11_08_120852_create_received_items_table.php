<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivedItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'received_items', function ( Blueprint $table ) {
            $table->bigInteger( ''id'', true)->unsigned();
			$table->bigInteger( 'purchase_item_id' )->unsigned()->nullable()->index( 'purchase_item_id' );
			$table->bigInteger( 'crash_item_id' )->unsigned()->nullable()->index( 'crash_item_id' );
			$table->bigInteger( 'item_id' )->unsigned()->nullable()->index( 'item_id' );
			$table->float( ''total_weight'', 10)->nullable();
			$table->float( ''quantity'', 10)->nullable();
			$table->float( ''sell_price'', 10)->nullable();
			$table->float( ''profit'', 10)->nullable();
			$table->date( 'expire_date' )->nullable();
			$table->date( 'receive_date' )->nullable();
			$table->boolean( 'status' )->nullable()->index( 'status' );
			$table->text( 'notes' )->nullable();
			$table->boolean( 'soft_delete' )->nullable()->index( 'soft_delete' );
			$table->bigInteger( 'modifier_id' )->unsigned()->nullable()->index( 'modifier_id' );
			$table->timestamps( 10 );
		} );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop( 'received_items' );
    }

}
