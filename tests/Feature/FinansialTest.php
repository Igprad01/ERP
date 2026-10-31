<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Category;
use App\Models\Finansial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FinansialTest extends TestCase
{
    use RefreshDatabase;

    private function buatAkun(string $nama, float $saldo): Account
    {
        return Account::create([
            'nama' => $nama,
            'type' => 'cash',
            'saldo_awal' => $saldo,
            'saldo' => $saldo,
            'is_active' => true,
        ]);
    }

    private function buatKategori(): Category
    {
        return Category::create(['nama' => 'Umum']);
    }

    private function dataTransaksi(array $override = []): array
    {
        return array_merge([
            'transaksi_date' => now()->toDateString(),
            'transaksi_type' => 'expense',
            'account_id' => null,
            'account_to_id' => null,
            'category_id' => $this->buatKategori()->id,
            'goal_id' => null,
            'debt_id' => null,
            'trip_id' => null,
            'periode' => 'monthly',
            'status' => 'Done',
            'type' => 'expense',
            'mekanisme_pembayaran' => 'Tunai',
            'total_cost' => 20000,
            'catatan' => null,
        ], $override);
    }

    public function test_saldo_tersinkron_saat_transaksi_dibuat_diubah_dan_dihapus(): void
    {
        $kas = $this->buatAkun('Kas', 100000);
        $bank = $this->buatAkun('Bank', 50000);

        Finansial::add($this->dataTransaksi([
            'transaksi_type' => 'income',
            'type' => 'income',
            'account_id' => $kas->id,
            'total_cost' => 50000,
        ]));
        $this->assertEquals(150000, $kas->fresh()->saldo);

        $expense = Finansial::add($this->dataTransaksi([
            'account_id' => $kas->id,
        ]));
        $this->assertEquals(130000, $kas->fresh()->saldo);

        Finansial::add($this->dataTransaksi([
            'transaksi_type' => 'transfer',
            'account_id' => $kas->id,
            'account_to_id' => $bank->id,
            'total_cost' => 10000,
        ]));
        $this->assertEquals(120000, $kas->fresh()->saldo);
        $this->assertEquals(60000, $bank->fresh()->saldo);

        Finansial::edit($this->dataTransaksi([
            'account_id' => $kas->id,
            'total_cost' => 30000,
        ]), (string) $expense->id);
        $this->assertEquals(110000, $kas->fresh()->saldo);

        Finansial::remove((string) $expense->id);
        $this->assertEquals(140000, $kas->fresh()->saldo);
    }

    public function test_nomor_referensi_dibuat_otomatis_dan_unik(): void
    {
        $kas = $this->buatAkun('Kas', 100000);

        $pertama = Finansial::add($this->dataTransaksi(['account_id' => $kas->id]));
        $kedua = Finansial::add($this->dataTransaksi(['account_id' => $kas->id]));

        $this->assertMatchesRegularExpression('/^TRX-\d{8}-[A-Z0-9]{5}$/', $pertama->reference_number);
        $this->assertNotSame($pertama->reference_number, $kedua->reference_number);

        Finansial::edit($this->dataTransaksi([
            'account_id' => $kas->id,
            'total_cost' => 25000,
        ]), (string) $pertama->id);

        $this->assertSame($pertama->reference_number, $pertama->fresh()->reference_number);
    }

    public function test_nomor_referensi_tampil_readonly_di_form(): void
    {
        $this->get(route('finansial.create'))->assertOk()
            ->assertSee('TRX-'.now()->format('Ymd'), false)
            ->assertSee('readonly', false);

        $kas = $this->buatAkun('Kas', 100000);
        $transaksi = Finansial::add($this->dataTransaksi(['account_id' => $kas->id]));

        $this->get(route('finansial.edit', $transaksi->id))->assertOk()
            ->assertSee($transaksi->reference_number)
            ->assertSee('readonly', false);
    }

    public function test_halaman_finansial_dirender(): void
    {
        $kas = $this->buatAkun('Kas', 100000);

        $transaksi = Finansial::add($this->dataTransaksi([
            'account_id' => $kas->id,
        ]));

        $this->get(route('finansial'))->assertOk();
        $this->get(route('finansial.create'))->assertOk();
        $this->get(route('finansial.edit', $transaksi->id))->assertOk();

        $this->get(route('finansial', ['transaksi_type' => 'income']))
            ->assertOk()
            ->assertDontSee($transaksi->reference_number);

        $this->get(route('finansial', ['transaksi_type' => 'expense']))
            ->assertOk()
            ->assertSee($transaksi->reference_number);
    }
}
