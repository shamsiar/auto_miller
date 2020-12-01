<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'employees', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( ''name'', 191);
			$table->string( ''emp_type'', 191);
			$table->integer( 'salary' )->unsigned()->nullable();
			$table->boolean( 'status' )->nullable();
		} );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop( 'employees' );
    }

}
