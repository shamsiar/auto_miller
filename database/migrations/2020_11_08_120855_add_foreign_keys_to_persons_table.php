<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPersonsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table( 'persons', function ( Blueprint $table ) {
            $table->foreign( 'bank_id', 'FK_persons_banks' )->references( 'id' )->on( 'banks' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'modifier_id', 'FK_persons_modifiers' )->references( 'id' )->on( 'users' )->onUpdate( 'RESTRICT' )->onDelete( 'RESTRICT' );
        } );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table( 'persons', function ( Blueprint $table ) {
            $table->dropForeign( 'FK_persons_banks' );
            $table->dropForeign( 'FK_persons_modifiers' );
        } );
    }

}
