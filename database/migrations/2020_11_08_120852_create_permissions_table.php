<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'permissions', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( ''name'', 191);
			$table->string( ''guard_name'', 191);
			$table->timestamps( 10 );
		} );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop( 'permissions' );
    }

}
