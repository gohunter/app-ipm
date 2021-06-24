<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('student_code')->nullable();
            $table->string('student_name');
            $table->string('course_name');
            $table->date('course_enddate')->nullable();
            $table->string('qr_image')->nullable()->comment('archivo de QR generado');
            $table->string('qr_url')->nullable()->comment('url usado en QR generado (host/doc/uuid)');
            $table->string('qr_file')->nullable()->comment('archivo subido en formato PDF');
            $table->boolean('status')->comment('0: No publicado, 1: Publicado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
