@extends('Admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>
        <form method="GET" action="{{ route('admin.export') }}">
            <div class="input-group">
                <input type="date" name="start_date" class="form-control" required>
                <input type="date" name="end_date" class="form-control mx-2" required>
                <button class="btn btn-success btn-sm shadow-sm">
                    <i class="fas fa-file-export fa-sm text-white-50"></i> Export Excel
                </button>
            </div>
        </form>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Total Reservations -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Reservations</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalReservations ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Approvals -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Approvals</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingApprovals ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Vehicles -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Available Vehicles</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $availableVehicles ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fuel Consumption -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Fuel Consumption (L)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $fuelConsumption ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gas-pump fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row">
        <!-- Line Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Vehicle Usage per Month</h6>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Most Used Vehicles</h6>
                </div>
                <div class="card-body">
                    <canvas id="vehicleChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const monthlyCtx = document.getElementById('monthlyChart');
    const vehicleCtx = document.getElementById('vehicleChart');

    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_values(array_map(fn($m) => \Carbon\Carbon::create()->month($m)->format('F'), $monthlyBookings->keys()->toArray()))) !!},
            datasets: [{
                label: 'Pemesanan',
                data: {!! json_encode($monthlyBookings->values()) !!},
                borderColor: 'rgba(78, 115, 223, 1)',
                backgroundColor: 'rgba(78, 115, 223, 0.2)',
                fill: true,
                tension: 0.3
            }]
        }
    });

    new Chart(vehicleCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($vehicleUsage->pluck('name')) !!},
            datasets: [{
                data: {!! json_encode($vehicleUsage->pluck('total')) !!},
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796']
            }]
        }
    });
</script>
@endpush
