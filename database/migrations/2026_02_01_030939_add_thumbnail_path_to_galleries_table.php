<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThumbnailPathToGalleriesTable extends Migration
{
    public function up()
    {
        Schema::table('galery', function (Blueprint $table) {
            $table->string('thumbnail_path')->nullable()->after('media_path');
        });
    }

    public function down()
    {
        Schema::table('galery', function (Blueprint $table) {
            $table->dropColumn('thumbnail_path');
        });
    }
}