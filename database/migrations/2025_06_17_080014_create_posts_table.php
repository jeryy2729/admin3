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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
                 $table->unsignedBigInteger('category_id'); // no foreign key constraint
                                        $table->string('name')->nullable(); 
                                         $table->string('slug')->unique();
  $table->string('image')->nullable();

                 $table->string('description')->nullable();
            $table->boolean('status');
                               $table->unsignedBigInteger('user_id'); 
// No foreignId, no constraint
        $table->boolean('is_approved')->default(false);
$table->boolean('is_featured')->default(false);

             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
