<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGodownsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'godowns', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( ''name'', 191);
			$table->string( ''location'', 191)->index( 'location' );
			$table->boolean( 'status' );
		} );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop( 'godowns' );
    }

}
