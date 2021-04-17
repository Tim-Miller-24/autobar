<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkdayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workdays', function (Blueprint $table) {
            $table->id();

            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();

            $table->unsignedBigInteger('user_id')
                ->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('workday_id')
                ->nullable()
                ->after('user_id');

            $table->foreign('workday_id')
                ->references('id')
                ->on('workdays')
                ->onDelete('set null');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('income_id')
                ->nullable()
                ->after('item_id');

            $table->foreign('income_id')
                ->references('id')
                ->on('incomes')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workday');

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('workday_id');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('income_id');
        });
    }
}
