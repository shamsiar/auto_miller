<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStocksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table( 'stocks', function ( Blueprint $table ) {
            $table->foreign( 'godown_id', 'stocks_ibfk_1' )->references( 'id' )->on( 'godowns' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'item_id', 'stocks_ibfk_2' )->references( 'id' )->on( 'items' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'person_id', 'stocks_ibfk_3' )->references( 'id' )->on( 'persons' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'user_id', 'stocks_ibfk_4' )->references( 'id' )->on( 'users' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'transfered_by', 'stocks_ibfk_5' )->references( 'id' )->on( 'employees' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
        } );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table( 'stocks', function ( Blueprint $table ) {
            $table->dropForeign( 'stocks_ibfk_1' );
            $table->dropForeign( 'stocks_ibfk_2' );
            $table->dropForeign( 'stocks_ibfk_3' );
            $table->dropForeign( 'stocks_ibfk_4' );
            $table->dropForeign( 'stocks_ibfk_5' );
        } );
    }

}
