<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // メニュー名（例：コーヒー）
            $table->string('slug')->unique(); // URLに使う名前（例：coffee）※重複禁止！
            $table->integer('price');        // 価格（数値）
            $table->string('image');         // 画像のファイル名（例：coffee.png）
            $table->text('description');     // メニューの説明文
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
