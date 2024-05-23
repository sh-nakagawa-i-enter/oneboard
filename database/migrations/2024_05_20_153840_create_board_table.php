<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('board', function (Blueprint $table) {
            $table->bigIncrements('message_id');
            $table->string('user_name')->nullable(false);
            $table->text('message')->nullable(false);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->tinyInteger('delete_flag')->default(0);
            $table->unsignedBigInteger('user_id');
            
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->dropForeign('board_user_id_foreign');
        Schema::dropIfExists('board');
    }
};
