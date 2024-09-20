<?php

use App\Models\Letter;
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
        Schema::create('letters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuidMorphs('letterable');
            $table->integer('serial_number')->nullable();
            $table->string('letter_number')->nullable();
            $table->boolean('verified')->default(false);
            $table->enum('status', Letter::STATUSES)->default(Letter::STATUS_WAITING);
            $table->text('note')->nullable();
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
        Schema::dropIfExists('letters');
    }
};
