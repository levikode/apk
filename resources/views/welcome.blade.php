@extends('layouts.template')
@section('judulh1','  Dashboard')

@section('konten')

<div class="row">
    <div class="col-12">
      <div class="alert border-left-secondary shadow alert-warning alert-dismissible fade shadow show" role="alert">
        <strong>Selamat Datang!</strong> Anda telah masuk sebagai <strong>{{ Auth::user()->name }}</strong>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">
            &times;
          </span>
        </button>
      </div>
    </div>
  </div>

<div class="container-fluid">
    <!-- Header -->
    <div class="row">
        <!-- <div class="col-md-12">
            <h1 class="mt-4">Dashboard</h1>
        </div> -->
    </div>
    <canvas id="pegawaiChart" width="400" height="50"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lakukan request ke backend untuk mendapatkan data
        fetch('/chart-data')
            .then(response => response.json())
            .then(data => {
                var ctx = document.getElementById('pegawaiChart').getContext('2d');
                var pegawaiChart = new Chart(ctx, {
                    type: 'bar',  // Tipe chart, bisa juga 'line' atau 'pie'
                    data: {
                        labels: ['Pegawai', 'User'],
                        datasets: [{
                            label: 'Total Data',
                            data: [data.pegawai, data.user],  // Data dari backend
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                            ],
                            borderColor: [
                                'rgb(94, 107, 116)',
                                'rgb(22, 111, 111)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    });
</script>
<div class="row">
<div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Total Pegawai:
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
               {{ $data->count() }}
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
<div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Total User:
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $user->count() }}
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <!-- Statistics Overview -->
    <!-- <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Pegawai: {{ $data->count() }}</div> 
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Total User: {{ $user->count() }}</div> 
            </div>
        </div>
        </div>
       -->
        </div>
    </div>

    <!-- Table Data Terbaru -->
    <!-- resources/views/login.blade.php<div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">Data Pegawai Terbaru</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Petugas</th>
                                <th>Nama</th>
                                <th>NIP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $dt)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ optional($dt->user)->name }}</td>
                                <td>{{ $dt->nama }}</td>
                                <td>{{ $dt->nip }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection
