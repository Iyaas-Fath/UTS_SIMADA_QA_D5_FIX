<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DashboardReportingTest extends TestCase
{
    use RefreshDatabase;

    private function prepareData(): User
    {
        DB::table('opd')->insert(['id'=>1,'kode_opd'=>'KOMINFO','nama_opd'=>'Dinas Kominfo','created_at'=>now(),'updated_at'=>now()]);
        $user = User::create(['name'=>'Admin QA','email'=>'qa@example.test','password'=>bcrypt('password'),'role'=>'ADMIN','opd_id'=>null]);
        DB::table('procurement_packages')->insert([
            ['id'=>1,'kode_paket'=>'P-001','nama_paket'=>'Paket A','opd_id'=>1,'ppk_id'=>$user->id,'created_by'=>$user->id,'jenis_pengadaan'=>'Barang','metode'=>'e-Tendering','pagu'=>1000,'nilai_kontrak'=>800,'tahun_anggaran'=>2025,'status'=>'Proses','progress_persen'=>50,'tanggal_kontrak'=>'2025-01-10','created_at'=>now(),'updated_at'=>now()],
            ['id'=>2,'kode_paket'=>'P-002','nama_paket'=>'Paket B','opd_id'=>1,'ppk_id'=>$user->id,'created_by'=>$user->id,'jenis_pengadaan'=>'Jasa','metode'=>'e-Purchasing','pagu'=>500,'nilai_kontrak'=>null,'tahun_anggaran'=>2025,'status'=>'Perencanaan','progress_persen'=>0,'tanggal_kontrak'=>null,'created_at'=>now(),'updated_at'=>now()],
        ]);
        return $user;
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_dashboard_aggregates_pagu_realisasi_and_percentage(): void
    {
        $user = $this->prepareData();
        $this->actingAs($user)->get('/dashboard')
            ->assertOk()->assertSee('Total Paket')->assertSee('Paket A')
            ->assertSee('1.500')->assertSee('53,33%');
    }

    public function test_filters_are_applied_to_package_table_and_summary(): void
    {
        $user = $this->prepareData();
        $this->actingAs($user)->get('/dashboard?jenis=Barang')
            ->assertOk()->assertSee('Paket A')->assertDontSee('Paket B')
            ->assertSee('1.000');
    }

    public function test_csv_export_uses_selected_filter(): void
    {
        $user = $this->prepareData();
        $response = $this->actingAs($user)->get('/dashboard/export?jenis=Jasa');
        $response->assertOk()->assertHeader('content-type', 'text/csv; charset=UTF-8');
        $this->assertStringContainsString('Paket B', $response->streamedContent());
        $this->assertStringNotContainsString('Paket A', $response->streamedContent());
    }
}
