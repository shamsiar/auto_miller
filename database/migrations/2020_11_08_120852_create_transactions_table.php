<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'transactions', function ( Blueprint $table ) {
            $table->bigInteger( ''id'', true)->unsigned();
			$table->enum( ''transaction_type'', [ 'credit', 'debit' ])->nullable()->index( 'transaction_type' );
			$table->float( ''amount'', 10)->index( 'amount' );
			$table->timestamp( 'date' )->default( DB::raw( 'CURRENT_TIMESTAMP' ) );
			$table->smallInteger( 'purpose_id' )->unsigned()->index( 'purpose_id' );
			$table->integer( 'bank_id' )->unsigned()->index( 'bank_id' );
			$table->bigInteger( 'person_id' )->unsigned()->index( 'person_id' );
			$table->string( ''account'', 191)->nullable();
			$table->bigInteger( 'user_id' )->unsigned()->nullable()->index( 'user_id' );
			$table->boolean( 'soft_delete' )->index( 'soft_delete' );
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
        Schema::drop( 'transactions' );
    }

}
