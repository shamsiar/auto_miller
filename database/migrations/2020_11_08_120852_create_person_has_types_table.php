<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonHasTypesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'person_has_types', function ( Blueprint $table ) {
            $table->bigInteger( 'person_id' )->unsigned()->index( 'person_id' );
            $table->integer( 'type_id' )->unsigned()->index( 'type_id' );
        } );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop( 'person_has_types' );
    }

}
