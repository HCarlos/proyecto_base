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
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nombre')->nullable();
            $table->string('ap_paterno')->nullable();
            $table->string('ap_materno')->nullable();
            $table->string('rfc',13)->default('')->nullable();
            $table->string('curp',18)->default('')->nullable();
            $table->string('razon_social',250)->default('')->nullable();
            $table->string('calle',250)->default('')->nullable();
            $table->string('num_ext',100)->default('')->nullable();
            $table->string('num_int',100)->default('')->nullable();
            $table->string('colonia',150)->default('')->nullable();
            $table->string('localidad',150)->default('')->nullable();
            $table->string('estado',25)->default('TABASCO')->nullable();
            $table->string('pais',25)->default('MÉXICO')->nullable();
            $table->string('cp',10)->default('')->nullable();
            $table->string('email1',100)->default('')->nullable();
            $table->string('email2',100)->default('')->nullable();
            $table->string('cel1',100)->default('')->nullable();
            $table->string('cel2',100)->default('')->nullable();
            $table->string('tel1',100)->default('')->nullable();
            $table->string('tel2',100)->default('')->nullable();
            $table->string('lugar_nacimiento',250)->default('')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->smallInteger('genero')->default(0)->nullable();
            $table->string('ocupacion',250)->default('')->nullable();
            $table->string('lugar_trabajo',250)->default('')->nullable();
            $table->string('root',150)->default('')->nullable();
            $table->string('filename',50)->nullable();
            $table->unsignedInteger('iduser_ps')->nullable();
            $table->boolean('admin')->default(false);
            $table->boolean('alumno')->default(false);
            $table->boolean('foraneo')->default(false);
            $table->boolean('exalumno')->default(false);
            $table->boolean('credito')->default(false);
            $table->unsignedInteger('dias_credito')->default(0)->nullable();
            $table->decimal('limite_credito',10,2)->default(0.00)->nullable();
            $table->decimal('saldo_a_favor',10,2)->default(0.00)->nullable();
            $table->decimal('saldo_en_contra',10,2)->default(0.00)->nullable();
            $table->unsignedTinyInteger('familia_cliente_id')->default(1)->nullable();
            $table->unsignedSmallInteger('status_user')->default(1)->nullable();
            $table->unsignedSmallInteger('idemp')->default(0)->nullable();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->index('familia_cliente_id');
            $table->index('idemp');
            $table->timestamp('email_verified_at')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('user');
    }
}
