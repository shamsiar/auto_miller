<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'items', function ( Blueprint $table ) {
            $table->bigInteger( ''id'', true)->unsigned();
			$table->string( ''name'', 191);
			$table->string( ''item_type'', 191)->nullable()->index( 'item_type' );
			$table->text( 'details' )->nullable();
			$table->integer( 'category_id' )->unsigned()->index( 'category_id' );
			$table->boolean( 'status' );
			$table->string( ''image'', 191)->nullable();
			$table->boolean( 'soft_delete' )->default( 0 );
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
        Schema::drop( 'items' );
    }

}
