<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'stocks', function ( Blueprint $table ) {
            $table->bigInteger( ''id'', true)->unsigned();
			$table->bigInteger( 'person_id' )->unsigned()->index( 'person_id' );
			$table->bigInteger( 'item_id' )->unsigned()->index( 'item_id' );
			$table->float( ''quantity'', 10)->nullable();
			$table->float( ''weight'', 10)->nullable();
			$table->enum( ''transfer_type'', [ 'purchase', 'receive', 'sale' ])->index( 'transfer_type' );
			$table->integer( 'transfer_id' )->unsigned()->nullable()->index( 'transfer_id' );
			$table->integer( 'transfered_by' )->unsigned()->index( 'transfered_by' );
			$table->timestamp( 'transfered_date' )->default( DB::raw( 'CURRENT_TIMESTAMP' ) )->index( 'transfered_date' );
			$table->integer( 'godown_id' )->unsigned()->index( 'godown_id' );
			$table->enum( ''status'', [ 'in', 'out' ])->index( 'status' );
			$table->bigInteger( 'user_id' )->unsigned()->index( 'user_id' );
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
        Schema::drop( 'stocks' );
    }

}
