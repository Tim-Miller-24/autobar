<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemAdditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additions', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->integer('position')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('addition_values', function (Blueprint $table) {
            $table->id();
            $table->text('name');

            $table->unsignedBigInteger('addition_id')->nullable();
            $table->foreign('addition_id')
                ->references('id')
                ->on('additions')
                ->onDelete('cascade');

            $table->integer('position')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('addition_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('addition_id')->nullable();
            $table->foreign('addition_id')
                ->references('id')
                ->on('additions')
                ->onDelete('cascade');

            $table->unsignedBigInteger('item_id')->nullable();
            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onDelete('cascade');

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
        Schema::dropIfExists('additions');
        Schema::dropIfExists('addition_values');
        Schema::dropIfExists('addition_items');
    }
}
