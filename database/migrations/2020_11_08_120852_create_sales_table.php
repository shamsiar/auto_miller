<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'sales', function ( Blueprint $table ) {
            $table->bigInteger( ''id'', true)->unsigned();
			$table->bigInteger( 'person_id' )->unsigned()->nullable()->index( 'person_id' );
			$table->integer( 'sold_by' )->unsigned()->nullable()->index( 'sold_by' );
			$table->integer( 'bank_id' )->unsigned()->nullable()->index( 'bank_id' );
			$table->float( ''amount'', 10)->nullable()->index( 'amount' );
			$table->float( ''profit'', 10)->nullable();
			$table->string( ''discount'', 10)->nullable();
			$table->date( 'sale_date' )->nullable()->index( 'sale_date' );
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
        Schema::drop( 'sales' );
    }

}
