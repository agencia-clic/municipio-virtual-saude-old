@extends('layouts.admin.app')

@section('content')

<div class="row g-3 mb-3">
    <div class="col-md-6 col-xxl-3">
        <div class="card h-md-100 ecommerce-card-min-width card-border">
            <div class="card-header pb-0">
                <h6 class="mb-0 mt-2 d-flex align-items-center">
                    TRIAGENS
                </h6>
            </div>
            <div class="card-body d-flex flex-column justify-content-end">
                <div class="row">
                    <div class="col">
                        <p class="font-sans-serif lh-1 mb-1 fs-4">{{ $emergency_services_screenings }}</p>
                        <span class="badge badge-soft-success rounded-pill fs--2">ABERTOS</span>
                    </div>
                    <div class="col-auto ps-0">
                        <!--<div class="echart-bar-weekly-sales h-100"></div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-xxl-3">
        <div class="card h-md-100 ecommerce-card-min-width card-border">
            <div class="card-header pb-0">
                <h6 class="mb-0 mt-2 mb-0 d-flex align-items-center">
                    ATEDIMENTOS MEDICOS
                </h6>
            </div>
            <div class="card-body d-flex flex-column justify-content-end">
                <div class="row">
                    <div class="col">
                        <p class="font-sans-serif lh-1 mb-0 mt-0 fs-4">{{ $emergency_services_forward_internal }}</p>
                        <span class="badge badge-soft-success rounded-pill fs--2">ABERTOS</span>
                    </div>
                    <div class="col-auto ps-0">
                        <!--<div class="echart-bar-weekly-sales h-100"></div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xxl-3">
        <div class="card h-md-100 ecommerce-card-min-width card-border">
            <div class="card-header pb-0">
                <h6 class="mb-0 mt-2 d-flex align-items-center">
                    OBSERVAÇÂO
                </h6>
            </div>
            <div class="card-body d-flex flex-column justify-content-end">
                <div class="row">
                    <div class="col">
                        <p class="font-sans-serif lh-1 mb-1 fs-4">{{ $observation }}</p>
                        <span class="badge badge-soft-success rounded-pill fs--2">ABERTOS</span>
                    </div>
                    <div class="col-auto ps-0">
                        <!--<div class="echart-bar-weekly-sales h-100"></div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xxl-3">
        <div class="card h-md-100 ecommerce-card-min-width card-border">
            <div class="card-header pb-0">
                <h6 class="mb-0 mt-2 d-flex align-items-center">
                    INTERNADOS
                </h6>
            </div>
            <div class="card-body d-flex flex-column justify-content-end">
                <div class="row">
                    <div class="col">
                        <p class="font-sans-serif lh-1 mb-1 fs-4">{{ $internal }}</p>
                        <span class="badge badge-soft-success rounded-pill fs--2">ABERTOS</span>
                    </div>
                    <div class="col-auto ps-0">
                        <!--<div class="echart-bar-weekly-sales h-100"></div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection
