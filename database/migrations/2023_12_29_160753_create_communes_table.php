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
        Schema::create('communes', function (Blueprint $table) {
            $table->unsignedInteger('id_com')->autoIncrement();
            $table->unsignedInteger('id_reg');
            $table->string('description', 90);
            $table->enum ('status', [
                StatusValue::ACTIVE->value,
                StatusValue::INACTIVE->value,
                StatusValue::REMOVED->value
            ])->default(StatusValue::ACTIVE->value);

            $table->unique(['id_com', 'id_reg']);

            $table->index('id_reg', 'fk_communes_regions_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communes');
    }
};
