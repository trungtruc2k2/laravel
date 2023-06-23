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
        Schema::create('db_post', function (Blueprint $table) {
            $table->id(); //id
            $table->unsignedInteger('topic_id')->default(1);
            $table->string('title');
            $table->string('slug');
            $table->mediumText('detail');
            $table->string('image');
            $table->string('type');
            $table->string('metakey');
            $table->string('metadesc');
            $table->timestamps(); //created_at, updated_at
            $table->unsignedInteger('created_by')->default(1);
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedTinyInteger('status')->default(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('db_post');
    }
};
