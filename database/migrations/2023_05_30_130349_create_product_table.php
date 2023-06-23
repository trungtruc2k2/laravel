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
        Schema::create('db_product', function (Blueprint $table) {
            $table->id(); //id
            $table->unsignedInteger('category_id')->default(1);
            $table->unsignedInteger('brand_id')->default(1);
            $table->string('name');
            $table->string('slug');
            $table->float('price');
            $table->float('price_sale');
            $table->string('image');
            $table->unsignedInteger('qty')->default(1);
            $table->string('metakey');
            $table->string('metadesc');
            $table->mediumText('detail');
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
        Schema::dropIfExists('db_product');
    }
};
