@extends('layouts.templateadmin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-4">

    <div class="row g-4">
        <!-- Karyawan -->
        <div class="col-md-4 text-center">
            <div class="card text-white bg-primary shadow h-100">
                <div class="card-body">
                    <h5 class="card-title pt-2">Jumlah Karyawan</h5>
                    <p class="display-6">12</p>
                </div>
            </div>
        </div>
        <!-- Pesanan -->
        <div class="col-md-4 text-center">
            <div class="card text-white bg-success shadow h-100 ">
                <div class="card-body">
                    <h5 class="card-title pt-2">Jumlah Pesanan</h5>
                    <p class="display-6">278</p>
                </div>
            </div>
        </div>
        <!-- Pelanggan -->
        <div class="col-md-4 text-center">
            <div class="card text-white bg-warning shadow h-100">
                <div class="card-body">
                    <h5 class="card-title pt-2">Jumlah Pelanggan</h5>
                    <p class="display-6">89</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <div class="card shadow border-0">
               <div class="card-body">
					<h5 class="card-title pt-2">Grafik Jumlah Pesanan per Bulan</h5>
					<canvas id="pesananChart" height="50" width="100%"></canvas>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js_script')
<script>
    const ctx = document.getElementById('pesananChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Pesanan',
                data: [45, 65, 38, 80, 70, 95],
                fill: true,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                tension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 20
                    }
                }
            }
        }
    });
</script>
@endpush
