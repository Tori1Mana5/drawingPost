<?php

use App\Models\User;
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
        Schema::create('user_tokens', function (Blueprint $table) {
            $table->id();

            // リレーションで親のusersテーブルのidのレコードが消された場合、紐づくuser_idを持つuser_tokensテーブルのレコードを削除する
            $table->foreignIdFor(User::class)->unique()->onUpdate('CASCADE')->onDelete('CASCADE')->constrained();
            $table->string('token')->unique();
            $table->dateTime('expire_at')->nullable();
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
        Schema::dropIfExists('user_tokens');
    }
};
