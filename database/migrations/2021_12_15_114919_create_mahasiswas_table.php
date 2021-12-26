<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->text("nbi");
            $table->text("nama");
            $table->text("telp");
            $table->text("alamat");
            $table->text("email");
            $table->date("tgl_lahir");
            $table->text("prodi");
            $table->text("fakultas");
            $table->double("ipk");
            $table->text("dosen_wali");
            $table->text("foto")->nullable();
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
        Schema::dropIfExists('mahasiswas');
    }
}
