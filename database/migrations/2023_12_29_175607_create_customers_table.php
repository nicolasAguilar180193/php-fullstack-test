<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Values\StatusValue;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->string('dni', 45)->comment('Documento de Identidad');
            $table->unsignedBigInteger('id_reg')->comment('');
            $table->unsignedBigInteger('id_com')->comment('');
            $table->string('email', 120)->unique()->comment('Correo Electrónico');
            $table->string('name', 45)->comment('Nombre');
            $table->string('last_name', 45)->comment('Apellido');
            $table->string('address', 255)->nullable()->comment('Dirección');
            $table->dateTime('date_reg')->comment('Fecha y hora del registro');
            $table->enum ('status', [
                StatusValue::ACTIVE->value,
                StatusValue::INACTIVE->value,
                StatusValue::REMOVED->value
            ])->default(StatusValue::ACTIVE->value)->comment(
                'estado del registro: A: Activo, I: Desactivado, trash: Registro eliminado'
            );

            $table->primary(['dni', 'id_reg', 'id_com']);

            $table->index(['id_com', 'id_reg'], 'fk_customers_communes1_idx');
            
            $table->unique('email', 'email_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
