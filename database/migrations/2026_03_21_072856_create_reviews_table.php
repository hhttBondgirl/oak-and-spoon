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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // どのメニュー(menusテーブルのid)に対するレビューかを表す
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            $table->string('user_name');   // 投稿者の名前
            $table->string('gender');      // 投稿者の性別
            $table->text('comment');       // レビュー本文
            $table->integer('stars');      // 星の数（1〜5とか）
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
