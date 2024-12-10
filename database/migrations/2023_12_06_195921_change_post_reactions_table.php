<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Supprimer la clé étrangère avant de renommer la colonne
        Schema::table('post_reactions', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
        });

        // Utiliser une requête brute pour contourner les limitations de `renameColumn`
        DB::statement("ALTER TABLE post_reactions CHANGE post_id object_id BIGINT UNSIGNED");

        // Ajouter la colonne object_type
        Schema::table('post_reactions', function (Blueprint $table) {
            $table->string('object_type')->after('object_id');
        });

        // Renommer la table
        Schema::rename('post_reactions', 'reactions');

        // Mettre à jour la colonne object_type
        DB::table('reactions')
            ->update(['object_type' => 'App\Models\Post']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Renommer la table pour revenir à l'ancienne
        Schema::rename('reactions', 'post_reactions');

        // Supprimer la colonne object_type et renommer object_id en post_id
        Schema::table('post_reactions', function (Blueprint $table) {
            $table->dropColumn('object_type');
        });

        // Revenir au nom original avec une requête brute
        DB::statement("ALTER TABLE post_reactions CHANGE object_id post_id BIGINT UNSIGNED");

        // Ajouter de nouveau la clé étrangère
        Schema::table('post_reactions', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts');
        });
    }
};
