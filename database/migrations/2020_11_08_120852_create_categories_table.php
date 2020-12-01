<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'categories', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'name', 191);
			$table->integer( 'parent_id' )->unsigned()->nullable()->index( 'parent_id' );
			$table->string( 'unit', 191)->nullable()->index( 'unit' );
			$table->string( 'image', 191)->nullable();
			$table->boolean( 'soft_delete' )->nullable();
			$table->bigInteger( 'modifier_id' )->unsigned()->nullable()->index( 'modifier_id' );
			$table->timestamps( 10 );
		} );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop( 'categories' );
    }

}
