<?php

use App\Models\IncomingLetterCategory;
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
        Schema::create('incoming_letters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUUid('incoming_letter_category_id');
            $table->string('letter_number');
            $table->string('regarding');
            $table->string('attachment');
            $table->string('from');
            $table->string('to');
            $table->date('date');
            $table->string('file');
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
        Schema::dropIfExists('incoming_letters');
    }
};
