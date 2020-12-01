<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'purchased_items', function ( Blueprint $table ) {
            $table->bigInteger( ''id'', true)->unsigned();
			$table->bigInteger( 'purchase_id' )->unsigned()->nullable()->index( 'purchase_id' );
			$table->bigInteger( 'item_id' )->unsigned()->nullable()->index( 'item_id' );
			$table->float( ''quantity_purchased'', 10)->nullable();
			$table->float( ''quantity_received'', 10)->nullable();
			$table->float( ''total_cost'', 10)->nullable();
			$table->float( ''cost_per_unit'', 10)->nullable();
			$table->date( 'expire_date' )->nullable();
			$table->float( ''amount'', 10)->nullable();
			$table->timestamps( 10 );
		} );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop( 'purchased_items' );
    }

}
