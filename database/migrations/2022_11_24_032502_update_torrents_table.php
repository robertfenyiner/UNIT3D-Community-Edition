<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('torrents')
            ->whereNull('imdb')
            ->orWhere('imdb', '<', 0)
            ->orWhere('imdb', '>', 2_000_000_000)
            ->orWhere('imdb', 'not regexp', '\d+')
            ->update(['imdb' => '0']);

        DB::table('torrents')
            ->whereNull('tmdb')
            ->orWhere('tmdb', '<', 0)
            ->orWhere('tmdb', '>', 2_000_000_000)
            ->orWhere('tmdb', 'not regexp', '\d+')
            ->update(['tmdb' => '0']);

        DB::table('torrents')
            ->whereNull('tvdb')
            ->orWhere('tvdb', '<', 0)
            ->orWhere('tvdb', '>', 2_000_000_000)
            ->orWhere('tvdb', 'not regexp', '\d+')
            ->update(['tvdb' => '0']);

        DB::table('torrents')
            ->whereNull('mal')
            ->orWhere('mal', '<', 0)
            ->orWhere('mal', '>', 2_000_000_000)
            ->orWhere('mal', 'not regexp', '\d+')
            ->update(['mal' => '0']);

        Schema::table('torrents', function (Blueprint $table): void {
            $table->integer('imdb')->unsigned()->change();
            $table->integer('tvdb')->unsigned()->change();
            $table->integer('tmdb')->unsigned()->change();
            $table->integer('mal')->unsigned()->change();
        });
    }
};
