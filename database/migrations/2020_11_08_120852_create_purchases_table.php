<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'purchases', function ( Blueprint $table ) {
            $table->bigInteger( ''id'', true)->unsigned();
			$table->bigInteger( 'person_id' )->unsigned()->nullable()->index( 'person_id' );
			$table->integer( 'receiver_id' )->unsigned()->nullable()->index( 'receiver_id' );
			$table->integer( 'bank_id' )->unsigned()->nullable()->index( 'bank_id' );
			$table->float( ''amount'', 10)->nullable()->index( 'amount' );
			$table->float( ''quantity_purchased'', 10)->nullable();
			$table->float( ''quantity_received'', 10)->nullable();
			$table->string( ''token'', 20)->nullable()->index( 'token' );
			$table->string( ''vechile_info'', 191)->nullable();
			$table->timestamp( 'purchase_date' )->default( DB::raw( 'CURRENT_TIMESTAMP' ) );
			$table->boolean( 'store_account_payment' )->nullable()->index( 'store_account_payment' );
			$table->text( 'notes' )->nullable();
			$table->enum( ''status'', [ 'processing', 'unloading', 'stocked' ])->nullable()->index( 'status' );
			$table->bigInteger( 'user_id' )->unsigned()->nullable()->index( 'user_id' );
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
        Schema::drop( 'purchases' );
    }

}
