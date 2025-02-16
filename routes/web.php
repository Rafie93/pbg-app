<?php

use App\Http\Controllers\AuthController;
use App\Livewire\Admin\DashboardControl;
use App\Livewire\Admin\Laporan\LaporanPenerbitanImb;
use App\Livewire\Admin\Laporan\LaporanPengajuan;
use App\Livewire\Admin\Laporan\LaporanRetribusi;
use App\Livewire\Admin\Laporan\LaporanSurvie;
use App\Livewire\Admin\Laporan\RekapPembayaran;
use App\Livewire\Admin\Laporan\RekapSurvie;
use App\Livewire\Admin\Master\FungsiCreate;
use App\Livewire\Admin\Master\FungsiRead;
use App\Livewire\Admin\Master\JenisBangunanCreate;
use App\Livewire\Admin\Master\JenisBangunanRead;
use App\Livewire\Admin\Master\PetugasCreate;
use App\Livewire\Admin\Master\PetugasRead;
use App\Livewire\Admin\PenerbitanImbCreate;
use App\Livewire\Admin\PenerbitanImbListRead;
use App\Livewire\Admin\PermohonanListDetail;
use App\Livewire\Admin\PermohonanListRead;
use App\Livewire\Admin\RetribusiCreate;
use App\Livewire\Admin\RetribusiListDetail;
use App\Livewire\Admin\RetribusiListRead;
use App\Livewire\Admin\SurvieListCreate;
use App\Livewire\Admin\SurvieListRead;
use App\Livewire\AjukanPermohonanIMB;
use App\Livewire\HomeControl;
use App\Livewire\HubungiKamiControl;
use App\Livewire\LoginControl;
use App\Livewire\MyProfileControl;
use App\Livewire\RegisterControl;
use App\Livewire\RetribusiPemohon;
use App\Livewire\RetribusiPemohonBayar;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeControl::class)->name('home');
Route::get('/register', RegisterControl::class)->name('register');
Route::get('/login', LoginControl::class)->name('login');
Route::get('/logout', [LoginControl::class,'logout'])->name('logout');

Route::get('/hubungi-kami', HubungiKamiControl::class)->name('hubungi-kami');

// ADMIN
Route::get('/admin', [AuthController::class,'index'])->name('admin.login');
Route::post('/admin', [AuthController::class,'login'])->name('admin.login');


// auth`
Route::group(['middleware' => ['auth:sanctum','verified']], function () {


    // Route::get('/import', [ImportController::class,'index'])->name('import');
    // Route::post('/import/store', [ImportController::class,'store'])->name('import.store');

    Route::get('/profile', MyProfileControl::class)->name('profile');
    Route::get('/ajukan-permohonan', AjukanPermohonanIMB::class)->name('ajukan.permohonan');
    Route::get('/retribusi-pemohon', RetribusiPemohon::class)->name('retribusi.pemohon');
    Route::get('/retribusi-pemohon/bayar/{id}', RetribusiPemohonBayar::class)->name('retribusi.pemohon.bayar');


    
    // BACKEND ADMIN
    Route::get('/dashboard', DashboardControl::class)->name('dashboard');
    Route::get('/permohonan/list', PermohonanListRead::class)->name('permohonan.list');
    Route::get('/permohonan/detail/{id}', PermohonanListDetail::class)->name('admin.permohonan.detail');

    Route::get('/retribusi/create', RetribusiCreate::class)->name('retribusi.create');
    Route::get('/retribusi/list', RetribusiListRead::class)->name('retribusi.list');
    Route::get('/retribusi/detail/{id}', RetribusiListDetail::class)->name('retribusi.detail');

    Route::get('/penerbitan-imb/list', PenerbitanImbListRead::class)->name('penerbitan.list');
    Route::get('/penerbitan-imb/create', PenerbitanImbCreate::class)->name('penerbitan.create');
    Route::get('/penerbitan-imb/edit/{id}', PenerbitanImbCreate::class)->name('penerbitan.edit');


    Route::get('/survie/list', SurvieListRead::class)->name('survie.list');
    Route::get('/survie/create', SurvieListCreate::class)->name('survie.create');
    Route::get('/survie/edit/{id}', SurvieListCreate::class)->name('survie.edit');

    // laporan
    Route::get('/laporan/laporan-pengajuan', LaporanPengajuan::class)->name('laporan.pengajuan');
    Route::get('/laporan/laporan-pengajuan/pdf', [LaporanPengajuan::class,'pdf'])->name('laporan.pengajuan.pdf');

    Route::get('/laporan/laporan-retribusi', LaporanRetribusi::class)->name('laporan.retribusi');
    Route::get('/laporan/laporan-retribusi/pdf', [LaporanRetribusi::class,'pdf'])->name('laporan.retribusi.pdf');
    
    Route::get('/laporan/laporan-survie', LaporanSurvie::class)->name('laporan.survie');
    Route::get('/laporan/laporan-survie/pdf', [LaporanSurvie::class,'pdf'])->name('laporan.survie.pdf');

    Route::get('/laporan/laporan-penerbitan-imb', LaporanPenerbitanImb::class)->name('laporan.penerbitan');
    Route::get('/laporan/laporan-penerbitan-imb/pdf', [LaporanPenerbitanImb::class,'pdf'])->name('laporan.penerbitan.pdf');

    Route::get('/laporan/rekap-pembayaran', RekapPembayaran::class)->name('rekap.pembayaran');
    Route::get('/laporan/rekap-pembayaran/pdf', [RekapPembayaran::class,'pdf'])->name('rekap.pembayaran.pdf');
    
    Route::get('/laporan/rekap-survie', RekapSurvie::class)->name('rekap.survie');
    Route::get('/laporan/rekap-survie/pdf', [RekapSurvie::class,'pdf'])->name('rekap.survie.pdf');
    

    Route::get('/master/fungsi', FungsiRead::class)->name('master.fungsi');
    Route::get('/master/fungsi/form', FungsiCreate::class)->name('master.fungsi.form');
    Route::get('/master/fungsi/edit/{id}', FungsiCreate::class)->name('master.fungsi.edit');

    Route::get('/master/jenis-bangunan', JenisBangunanRead::class)->name('master.jenis-bangunan');
    Route::get('/master/jenis-bangunan/form', JenisBangunanCreate::class)->name('master.jenis-bangunan.form');
    Route::get('/master/jenis-bangunan/edit/{id}', JenisBangunanCreate::class)->name('master.jenis-bangunan.edit');

    Route::get('/master/petugas', PetugasRead::class)->name('master.petugas');
    Route::get('/master/petugas/form', PetugasCreate::class)->name('master.petugas.form');
    Route::get('/master/petugas/edit/{id}', PetugasCreate::class)->name('master.petugas.edit');

});
