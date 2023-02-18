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
        Schema::table('users', function (Blueprint $table) {
            $table->ipAddress('password', 255)->change();
            $table->renameColumn('nickname', 'nick_name')->change();
            $table->renameColumn('nick_name', 50)->change();
            $table->ipAddress('account', 50)->change();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->ipAddress('password', 45)->change();
            $table->renameColumn('nick_name', 'nickname')->change();
            $table->renameColumn('nick_name', 45)->change();
            $table->ipAddress('account', 45)->change();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->change();
        });
    }
};
