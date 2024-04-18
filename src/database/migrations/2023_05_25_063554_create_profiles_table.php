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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('profile')->nullable();
            $table->string('profile_icon')->nullable();
            $table->string('profile_background')->nullable();

            // リレーションで親のusersテーブルのidのレコードが消された場合、紐づくuser_idを持つprofilesテーブルのレコードを削除する
            $table->foreignIdFor(User::class)->unique()->onUpdate('CASCADE')->onDelete('CASCADE')->constrained();
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
