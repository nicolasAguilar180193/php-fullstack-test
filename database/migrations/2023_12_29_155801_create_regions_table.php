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
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id_reg');
            $table->string('description', 90);
            $table->enum ('status', [
                StatusValue::ACTIVE->value,
                StatusValue::INACTIVE->value,
                StatusValue::REMOVED->value
            ])->default(StatusValue::ACTIVE->value);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
