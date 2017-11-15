<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('addressable_type')->index(); // Users, Brands, Places, Contacts
            $table->unsignedInteger('addressable_id')->index();
            $table->unsignedInteger('type_id')->index();
            $table->unsignedInteger('market_id')->nullable()->index(); // ID of market in which address belongs
            $table->string('address');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->unsignedInteger('state_id')->index()->default(1); // ID of state on states table. Defaults to Florida. States are < 100. Country is parent_id on the State.
            $table->string('zip_code', 5)->nullable()->index(); // NULL if country is other than US. In which case, the entire code is in zip_extension
            $table->string('zip_extension', 35)->nullable(); // Use when is PO Box or has other number after ZIP Code
            $table->unsignedInteger('created_by')->default(1);
            $table->unsignedInteger('updated_by')->default(1);
            $table->timestamps();
        });

        Schema::table('addresses', function($table) {
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('market_id')->references('id')->on('markets')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('zip_code')->references('code')->on('zips')->onDelete('restrict')->onUpdate('cascade'); // Notice primary key is 'code' and not 'id'
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function ($table) {
            $table->dropForeign(['type_id']);
            $table->dropForeign(['market_id']);
            $table->dropForeign(['state_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('addresses');
        Schema::enableForeignKeyConstraints();
    }
}
