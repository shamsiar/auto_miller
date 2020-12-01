<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStoreAccountsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table( 'store_accounts', function ( Blueprint $table ) {
            $table->foreign( 'person_id', 'store_accounts_ibfk_1' )->references( 'id' )->on( 'persons' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'purchase_id', 'store_accounts_ibfk_2' )->references( 'id' )->on( 'purchases' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
            $table->foreign( 'sale_id', 'store_accounts_ibfk_3' )->references( 'id' )->on( 'sales' )->onUpdate( 'CASCADE' )->onDelete( 'CASCADE' );
        } );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table( 'store_accounts', function ( Blueprint $table ) {
            $table->dropForeign( 'store_accounts_ibfk_1' );
            $table->dropForeign( 'store_accounts_ibfk_2' );
            $table->dropForeign( 'store_accounts_ibfk_3' );
        } );
    }

}
