<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('pelanggan.home');
});


Route::get('/login_validate', function (){
   if (Auth::check()){
       if (Auth::user()->id_level == '1'){
           return redirect()->route('admin.home');
       }elseif(Auth::user()->id_level == '2'){
           return redirect()->route('waiter.home');
       }elseif (Auth::user()->id_level == '3'){
           return redirect()->route('kasir.home');
       }elseif (Auth::user()->id_level == '4'){
           return redirect()->route('owner.home');
       }
       return redirect()->route('login');
   }});
Auth::routes();


Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
	Route::get('/','HomeController@admin')->name('admin.home');

	//meja
	Route::resource('meja','MejaController');
	//masakan
	Route::resource('masakan','MasakanController');
	//Transaksi
	Route::resource('transaksi','TransaksiController');
	Route::post('/transaksi/cari', 'TransaksiController@cari')->name('transaksi.cari');
    Route::get('/transaksi/kasir/{idOrder}', 'TransaksiController@pesanan_show')->name('transaksi.pesanan_show');
    Route::post('/kasir/bayar/{idOrder}', 'TransaksiController@store')->name('transaksi.store');
    Route::get('/struk/{idTransaksi}/{bayar}', 'TransaksiController@struk')->name('transaksi.struk');
	//Order
	Route::resource('order','OrderController');
	Route::get('order/menu/{id}','OrderController@menu')->name('order.menu');
	Route::post('order/menu/{idOrder}','DetailOrderController@store')->name('order.keranjang');
	//Detail Order
        Route::get('/menu/destroy/{detailOrder}', 'DetailOrderController@destroy')->name('order.keranjang.destroy');
        Route::get('/menu/pesan/{idOrder}', 'DetailOrderController@pesan')->name('order.pesan_masakan');
        Route::get('/pesanan/{idOrder}', 'DetailOrderController@list_pesanan')->name('order.list_pesanan');

	Route::resource('register','Register');

	 //Laporan
    Route::get('/laporan', 'LaporanController@index')->name('laporan');
    Route::get('/laporan/{tahun}', 'LaporanController@filter_year')->name('laporan.filter');
    Route::get('/pertanggal/', 'LaporanController@pertanggal')->name('laporan.pertanggal');
    Route::get('/pertanggal/{tglAwal}/{tglAkhir}', 'LaporanController@store_pertanggal')->name('laporan.store_pertanggal');
    Route::get('/laporan/transaksi', 'LaporanController@show_transaksi')->name('laporan.show_transaksi');
});

Route::group(['prefix'=>'waiter'],function(){
	Route::get('/','HomeController@waiter')->name('waiter.home');
	//batalkan
	Route::get('/batalkan/{order}', 'HomeController@batalkan')->name('waiter.batalkan');
    Route::get('/antar_masakan/{detailOrder}', 'HomeController@antar_masakan')->name('waiter.antar_masakan');
    //Order
	Route::resource('order','OrderController');
	Route::get('order/menu/{id}','OrderController@menu')->name('order.menu');
	Route::post('order/menu/{idOrder}','DetailOrderController@store')->name('order.keranjang');
	//Detail Order
        Route::get('/menu/destroy/{detailOrder}', 'DetailOrderController@destroy')->name('order.keranjang.destroy');
        Route::get('/menu/pesan/{idOrder}', 'DetailOrderController@pesan')->name('order.pesan_masakan');
        Route::get('/pesanan/{idOrder}', 'DetailOrderController@list_pesanan')->name('order.list_pesanan');

});

Route::group(['prefix'=>'kasir'],function(){
	Route::get('/','HomeController@kasir')->name('kasir.home');
	//Transaksi
	Route::resource('transaksi','TransaksiController');
	Route::post('/transaksi/cari', 'TransaksiController@cari')->name('transaksi.cari');
    Route::get('/transaksi/kasir/{idOrder}', 'TransaksiController@pesanan_show')->name('transaksi.pesanan_show');
    Route::post('/kasir/bayar/{idOrder}', 'TransaksiController@store')->name('transaksi.store');
    Route::get('/struk/{idTransaksi}/{bayar}', 'TransaksiController@struk')->name('transaksi.struk');

});

Route::group(['prefix'=>'owner'],function(){
	Route::get('/','HomeController@owner')->name('owner.home');

	 //Laporan
    Route::get('/laporan', 'LaporanController@index')->name('laporan');
    Route::get('/laporan/{tahun}', 'LaporanController@filter_year')->name('laporan.filter');
    Route::get('/pertanggal/', 'LaporanController@pertanggal')->name('laporan.pertanggal');
    Route::get('/pertanggal/{tglAwal}/{tglAkhir}', 'LaporanController@store_pertanggal')->name('laporan.store_pertanggal');
    Route::get('/laporan/transaksi', 'LaporanController@show_transaksi')->name('laporan.show_transaksi');
});

	Route::group(['prefix'=>'pelanggan'],function(){
	 Route::get('/', 'PelangganController@index')->name('pelanggan.home');
    Route::post('/', 'PelangganController@pilih_meja')->name('pelanggan.pilih_meja');
    Route::get('dashboard/{idMeja}', 'PelangganController@dashboard')->name('pelanggan.dashboard');

    //Order
	Route::resource('pelanggan_order','PelangganOrderController');
	Route::get('pelanggan_order/menu/{id}','PelangganOrderController@menu')->name('pelanggan.order.menu');
	Route::post('pelanggan_order/menu/{idOrder}','PelangganOrderController@input')->name('pelanggan.order.keranjang');
	//Detail Order
        Route::get('/pelanggan_menu/destroy/{detailOrder}', 'PelangganOrderController@destroy')->name('pelanggan.order.keranjang.destroy');
        Route::get('/pelanggan_menu/pesan/{idOrder}', 'PelangganOrderController@pesan')->name('pelanggan.order.pesan_masakan');
        Route::get('/pelanggan_pesanan/{idOrder}', 'PelangganOrderController@list_pesanan')->name('pelanggan.order.list_pesanan');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/menu', 'HomeController@menu')->name('menu');
