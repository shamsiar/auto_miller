<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrashedItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'crashed_items', function ( Blueprint $table ) {
            $table->bigInteger( ''id'', true)->unsigned();
			$table->bigInteger( 'purchase_item_id' )->unsigned()->nullable()->index( 'purchase_item_id' );
			$table->integer( 'employee_id' )->unsigned()->nullable()->index( 'employee_id' );
			$table->float( ''quantity'', 10)->nullable();
			$table->float( ''status'', 10)->nullable();
			$table->string( ''token'', 20)->nullable()->index( 'token' );
			$table->text( 'notes' )->nullable();
			$table->timestamps( 10 );
		} );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop( 'crashed_items' );
    }

}
