<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreAccountsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'store_accounts', function ( Blueprint $table ) {
            $table->bigInteger( ''id'', true)->unsigned();
			$table->bigInteger( 'person_id' )->unsigned()->index( 'person_id' );
			$table->bigInteger( 'sale_id' )->unsigned()->nullable()->index( 'sale_id' );
			$table->bigInteger( 'purchase_id' )->unsigned()->nullable()->index( 'purchase_id' );
			$table->float( ''transaction_amount'', 10)->index( 'transaction_amount' );
			$table->float( ''balance'', 10)->index( 'balance' );
			$table->timestamp( 'transaction_date' )->default( DB::raw( 'CURRENT_TIMESTAMP' ) )->index( 'transaction_date' );
			$table->text( 'note' );
			$table->timestamps( 10 );
		} );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop( 'store_accounts' );
    }

}
