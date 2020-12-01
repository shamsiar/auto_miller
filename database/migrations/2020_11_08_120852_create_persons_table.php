<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'persons', function ( Blueprint $table ) {
            $table->bigInteger( 'id', true)->unsigned();
			$table->string( 'name', 191);
			$table->string( 'mobile', 191);
			$table->string( 'phone', 191)->nullable();
			$table->string( 'company', 191)->nullable();
			$table->text( 'address' )->nullable();
			$table->string( 'email', 191)->nullable();
			$table->string( 'image', 191)->nullable();
			$table->integer( 'bank_id' )->unsigned()->nullable()->index( 'FK_persons_banks' );
			$table->string( 'bank_account', 191)->nullable();
			$table->boolean( 'status' )->nullable()->default( 1 );
			$table->boolean( 'soft_delete' )->nullable();
			$table->bigInteger( 'modifier_id' )->unsigned()->nullable()->index( 'FK_persons_modifiers' );
			$table->timestamps( 10 );
		} );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop( 'persons' );
    }

}
