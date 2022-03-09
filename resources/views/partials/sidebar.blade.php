<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{request()->is('/') ? 'active'  : ''}}" href="/">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    Home
                </a>
                @if(!isAdmin())
                <a class="nav-link {{request()->is('kta') || request()->is('kta/*')  ? 'active'  : ''}}" href="/kta">
                    <div class="sb-nav-link-icon"><i class="fas fa-address-card"></i></div>
                    Kartu Tanda Anggota
                </a>
                @endif
                @if(isAdmin())
                <div class="sb-sidenav-menu-heading">manage</div>
                <a class="nav-link {{request()->is('users')  || request()->is('users/*') ? 'active'  : ''}}" href="{{route('users.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Users
                </a>
                <a class="nav-link {{request()->is('kta') || request()->is('kta/*')  ? 'active'  : ''}}" href="/kta">
                    <div class="sb-nav-link-icon"><i class="fas fa-address-card"></i></div>
                    Kartu Tanda Anggota
                </a>
                @endif
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as :</div>
            <button class="btn btn-sm mt-2 text-capitalize btn-{{colorRole(auth()->user()->role->name)}}">{{auth()->user()->role->name}}</button>
        </div>
    </nav>
</div>