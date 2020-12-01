<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'sale_items', function ( Blueprint $table ) {
            $table->bigInteger( ''id'', true)->unsigned();
			$table->bigInteger( 'sale_id' )->unsigned()->nullable()->index( 'sale_id' );
			$table->bigInteger( 'item_id' )->unsigned()->nullable()->index( 'item_id' );
			$table->float( ''quantity'', 10)->nullable()->index( 'quantity' );
			$table->float( ''weight'', 10)->nullable();
			$table->float( ''cost_price'', 10)->nullable()->index( 'cost_price' );
			$table->float( ''unit_price'', 10)->nullable()->index( 'unit_price' );
			$table->float( ''total_amount'', 10)->nullable();
			$table->float( ''profit'', 10)->nullable();
			$table->text( 'notes' )->nullable();
		} );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop( 'sale_items' );
    }

}
