<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('opd', function (Blueprint $table) {
            $table->id();
            $table->string('kode_opd', 20)->unique();
            $table->string('nama_opd', 150);
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 30)->default('PPK')->after('password');
            $table->unsignedBigInteger('opd_id')->nullable()->after('role');
        });
        Schema::create('procurement_packages', function (Blueprint $table) {
            $table->id();
            $table->string('kode_paket', 30)->unique();
            $table->string('nama_paket');
            $table->foreignId('opd_id')->constrained('opd');
            $table->unsignedBigInteger('ppk_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('jenis_pengadaan', 40);
            $table->enum('metode', ['e-Tendering', 'e-Pengadaan Langsung', 'e-Purchasing']);
            $table->decimal('pagu', 18, 2);
            $table->decimal('nilai_kontrak', 18, 2)->nullable();
            $table->unsignedSmallInteger('tahun_anggaran');
            $table->enum('status', ['Perencanaan', 'Proses', 'Selesai'])->default('Perencanaan');
            $table->integer('progress')->default(0);
            $table->date('tanggal_kontrak')->nullable();
            $table->timestamps();
        });
        Schema::create('package_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained('procurement_packages')->cascadeOnDelete();
            $table->string('nama_tahap', 100);
            $table->unsignedSmallInteger('urutan')->default(1);
            $table->date('tgl_rencana')->nullable();
            $table->date('tgl_realisasi')->nullable();
            $table->enum('status_tahap', ['Belum', 'Berjalan', 'Selesai'])->default('Belum');
            $table->timestamps();
        });
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->nullable()->constrained('procurement_packages')->nullOnDelete();
            $table->unsignedBigInteger('generated_by')->nullable();
            $table->string('jenis_dokumen', 60);
            $table->enum('format', ['PDF', 'XLSX']);
            $table->string('file_path', 255)->nullable();
            $table->string('status_tte', 30)->default('Belum ditandatangani');
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
        Schema::dropIfExists('package_stages');
        Schema::dropIfExists('procurement_packages');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'opd_id']);
        });
        Schema::dropIfExists('opd');
    }
};
