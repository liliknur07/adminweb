@extends('layouts.admin')

@section('main-content')

  @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  @if (session('status'))
    <div class="alert alert-success border-left-success" role="alert">
      {{ session('status') }}
    </div>
  @endif

  <h1 class="h3 mb-4 text-gray-800">{{ __('Status: Menunggu') }}</h1>

  <div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Laporan Penyalahgunaan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $abuses_pending; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-skull-crossbones fa-2x text-gray-300"></i>
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
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Permintaan Sosialisasi</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $socializations_pending; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-hand-holding-heart fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Permintaan Rehabilitasi</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $rehabilitations_pending; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-ambulance fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Permintaan Konseling</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $consultations_pending; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-heart fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <h1 class="h3 mb-4 text-gray-800">{{ __('Status: Selesai') }}</h1>

  <div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Laporan Penyalahgunaan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $abuses_done; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-skull-crossbones fa-2x text-gray-300"></i>
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
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Permintaan Sosialisasi</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $socializations_done; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-hand-holding-heart fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Permintaan Rehabilitasi</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $rehabilitations_done; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-ambulance fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Permintaan Konseling</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $consultations_done; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-heart fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
