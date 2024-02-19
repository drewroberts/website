<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebpagesTable extends Migration
{
    public function up()
    {
        Schema::create('webpages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(app('domain'))->nullable();
            $table->string('path'); // Example: slug, folder/slug, folder/file.html, img/image-name.jpg
            $table->string('subdomain')->nullable(); // Example: www
            
            $table->foreignIdFor(app('video'))->nullable(); // Optional reference to company YouTube video

            $table->foreignIdFor(app('user'), 'creator_id')->nullable();
            $table->foreignIdFor(app('user'), 'updater_id')->nullable();
            $table->timestamps();

            $table->unique(['domain_id', 'path']);
        });
    }
}
