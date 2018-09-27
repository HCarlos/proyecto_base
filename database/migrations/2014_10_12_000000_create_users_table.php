<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nombre')->nullable();
            $table->string('ap_paterno')->nullable();
            $table->string('ap_materno')->nullable();
            $table->string('curp',18)->default('')->nullable();
            $table->string('emails',500)->default('')->nullable();
            $table->string('celulares',250)->default('')->nullable();
            $table->string('telefonos',250)->default('')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->smallInteger('genero')->default(0)->nullable();
            $table->string('root',150)->default('')->nullable();
            $table->string('filename',50)->nullable();
            $table->string('filename_png',50)->nullable();
            $table->string('filename_thumb',50)->nullable();
            $table->unsignedInteger('iduser_ps')->nullable();
            $table->boolean('admin')->default(false);
            $table->boolean('alumno')->default(false);
            $table->boolean('foraneo')->default(false);
            $table->boolean('exalumno')->default(false);
            $table->boolean('credito')->default(false);
            $table->string('session_id')->nullable();
            $table->unsignedSmallInteger('status_user')->default(1)->nullable();
            $table->unsignedSmallInteger('empresa_id')->default(0)->nullable();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->index('empresa_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('user_adress', function (Blueprint $table) {
            $table->increments('id');
            $table->string('calle',250)->default('')->nullable();
            $table->string('num_ext',100)->default('')->nullable();
            $table->string('num_int',100)->default('')->nullable();
            $table->string('colonia',150)->default('')->nullable();
            $table->string('localidad',150)->default('')->nullable();
            $table->string('estado',25)->default('TABASCO')->nullable();
            $table->string('pais',25)->default('MÉXICO')->nullable();
            $table->string('cp',10)->default('')->nullable();
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::create('user_extend', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('dias_credito')->default(0)->nullable();
            $table->decimal('limite_credito',10,2)->default(0.00)->nullable();
            $table->decimal('saldo_a_favor',10,2)->default(0.00)->nullable();
            $table->decimal('saldo_en_contra',10,2)->default(0.00)->nullable();
            $table->string('ocupacion',250)->default('')->nullable();
            $table->string('lugar_trabajo',250)->default('')->nullable();
            $table->string('lugar_nacimiento',250)->default('')->nullable();
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('user_adress');
        Schema::dropIfExists('user_extend');
        Schema::dropIfExists('users');
    }
}
