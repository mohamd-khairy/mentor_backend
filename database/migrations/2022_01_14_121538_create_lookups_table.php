<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLookupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lookups', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->string('key')->unique();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreignId('lookup_type_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('lookups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lookups');
    }
}
