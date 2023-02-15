<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg bg-white custom-nav mb-3">
    
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false" aria-label="Toggle Navigation">
        <span class="navbar-toggle-icon">
            <span class="toggle-line"></span>
        </span>
    </button>
    
    <a class="navbar-brand me-1 me-sm-3" href="{{ route('home') }}">
        <div class="d-flex align-items-center">
            <img class="me-2" src="{{ Storage::url('assets/sus-header.png') }}" alt="" width="40" />
            <span class="font-sans-serif text-secondary">MV</span>
             <span class="font-sans-serif">S</span>
        </div>
    </a>

    @if(empty($layout['menu']))
        @include('layouts/admin/fragments.menu')
    @endif
</nav>