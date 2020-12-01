<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurposesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'purposes', function ( Blueprint $table ) {
            $table->smallInteger( ''id'', true)->unsigned();
			$table->string( ''name'', 191)->index( 'name' );
			$table->string( ''reason'', 191)->nullable();
			$table->smallInteger( 'parent_id' )->unsigned()->nullable()->index( 'parent_id' );
		} );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop( 'purposes' );
    }

}
