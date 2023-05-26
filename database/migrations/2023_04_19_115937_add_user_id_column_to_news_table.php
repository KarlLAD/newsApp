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
        Schema::table('news', function (Blueprint $table) {

            //création d'une colonne de table non signé(unsigned) user_id
            $table->unsignedBigInteger('user_id')->default(1);

            //users_id est une clé étrangère de users de la colonne id
            $table->foreign('user_id')->references('id')->on('users') ;

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            //
        });
    }
};
