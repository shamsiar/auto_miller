<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPersonHasTypesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table( 'person_has_types', function ( Blueprint $table ) {
            $table->foreign( 'person_id', 'FK_person_has_types_person' )->references( 'id' )->on( 'persons' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'type_id', 'FK_person_has_types_types' )->references( 'id' )->on( 'types' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
        } );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table( 'person_has_types', function ( Blueprint $table ) {
            $table->dropForeign( 'FK_person_has_types_person' );
            $table->dropForeign( 'FK_person_has_types_types' );
        } );
    }

}
