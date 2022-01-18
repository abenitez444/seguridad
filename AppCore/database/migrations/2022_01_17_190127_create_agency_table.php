<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->string('name_agency');
            $table->string('rut')->nullable();
            $table->string('local_agency')->nullable();
            $table->string('tlf_agency')->nullable();
            $table->string('desc_sociality')->nullable();
            $table->string('email')->notNullable();
            $table->integer('email_verified');
            $table->integer('email_verified_at');
            $table->integer('country');
            $table->integer('state');
            $table->string('password')->nullable();
            $table->string('address')->nullable();
            $table->integer('is_active');
            $table->integer('is_admin');
            $table->integer('is_superadmin');
            $table->integer('type');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agency');
    }
}
