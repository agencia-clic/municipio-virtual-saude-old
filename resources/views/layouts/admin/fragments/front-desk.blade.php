

<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Observação</h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <textarea class="form-control form-control-sm" rows="10" placeholder="Observação" disabled>{{ $emergency_services->note ?? "-" }}</textarea>
            </div>
        </div>
    </div>
</div>