<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPurchasesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table( 'purchases', function ( Blueprint $table ) {
            $table->foreign( 'bank_id', 'purchases_ibfk_1' )->references( 'id' )->on( 'banks' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'modifier_id', 'purchases_ibfk_2' )->references( 'id' )->on( 'users' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'person_id', 'purchases_ibfk_3' )->references( 'id' )->on( 'persons' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'user_id', 'purchases_ibfk_4' )->references( 'id' )->on( 'users' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'receiver_id', 'purchases_ibfk_5' )->references( 'id' )->on( 'employees' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
        } );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table( 'purchases', function ( Blueprint $table ) {
            $table->dropForeign( 'purchases_ibfk_1' );
            $table->dropForeign( 'purchases_ibfk_2' );
            $table->dropForeign( 'purchases_ibfk_3' );
            $table->dropForeign( 'purchases_ibfk_4' );
            $table->dropForeign( 'purchases_ibfk_5' );
        } );
    }

}
