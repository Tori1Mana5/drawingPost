<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('body')->nullable();
            $table->text('image')->nullable();

            // リレーションで親のusersテーブルのidのレコードが消された場合、紐づくuser_idを持つpostsテーブルのレコードを削除する
            $table->foreignIdFor(User::class)->onUpdate('CASCADE')->onDelete('CASCADE')->constrained();
            $table->timestamps();

            // ソフトデリート用設定
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
        Schema::dropIfExists('users');
    }
};
