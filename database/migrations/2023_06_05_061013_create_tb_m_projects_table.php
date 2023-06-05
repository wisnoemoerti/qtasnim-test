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
        Schema::create('tb_m_projects', function (Blueprint $table) {
            $table->bigIncrements('project_id');
            $table->string('project_name',100);
            $table->unsignedBigInteger('client_id');
            $table->date('project_start');
            $table->date('project_end');
            $table->char('project_status',15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_m_projects');
    }
};
