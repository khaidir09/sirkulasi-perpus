<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wishlists', function (Blueprint $table) {
            $table->renameColumn('jenis_barang', 'types_id');
            $table->integer('types_id')->unsigned()->change();
            $table->renameColumn('merek', 'brands_id');
            $table->integer('brands_id')->unsigned()->change();
            $table->renameColumn('model_seri', 'model_series_id');
            $table->integer('model_series_id')->unsigned()->change();
            $table->string('garansi')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wishlists', function (Blueprint $table) {
            //
        });
    }
};
