<?php

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
        Schema::create('followed_users', function (Blueprint $table) {
            $table->id();
            // リレーションで親のusersテーブルのidのレコードが消された場合、紐づくfollowing_user_idとfollowd_user_idをを持つfollowd_usersテーブルのレコードを削除する
            $table->foreignId('following_user_id')->onUpdate('CASCADE')->onDelete('CASCADE')->constrained('users');
            $table->foreignId('followed_user_id')->onUpdate('CASCADE')->onDelete('CASCADE')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followed_users');
    }
};
