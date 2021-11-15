<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading pb-0 mb-0">Manajer</div>
                    <a class="nav-link pb-0 mb-0" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        UPK Punagaya
                    </a>
                    <div class="sb-sidenav-menu-heading pb-0 mb-0">Manajer Bagian</div>
                    <a class="nav-link pb-0 mb-0" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Operasi
                    </a>
                    <a class="nav-link pb-0 mb-0" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Pemeliharaan
                    </a>
                    <div class="sb-sidenav-menu-heading pb-0 mb-0">Supervisor Operasi</div>
                    <a class="nav-link pb-0 mb-0" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Shift A
                    </a>
                    <a class="nav-link pb-0 mb-0" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Shift B
                    </a>
                    <a class="nav-link pb-0 mb-0" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Shift C
                    </a>
                    <a class="nav-link pb-0 mb-0" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Shift D
                    </a>
                    <div class="sb-sidenav-menu-heading pb-0 mb-0">Supervisor Pemeliharaan</div>
                    <a class="nav-link pb-0 mb-0" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Boiler
                    </a>
                    <a class="nav-link pb-0 mb-0" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Turbin
                    </a>
                    <a class="nav-link pb-0 mb-0" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Instrument & Control
                    </a>
                    <a class="nav-link pb-0 mb-0" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Listrik
                    </a>
                    <div class="sb-sidenav-menu-heading pb-0 mb-0">Menu Operator</div>
                    <a class="nav-link pb-0 mb-0" href="charts.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Baca SOP IK
                    </a>
                    <a class="nav-link pb-0 mb-0" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Checklist SOP IK
                    </a>
                    <a class="nav-link pb-0 mb-0" href="charts.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        SR CM
                    </a>
                    <a class="nav-link pb-0 mb-0" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        SR FLM
                    </a>
                    <a class="nav-link pb-0 mb-0" href="charts.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Form 5S
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Muhammad Irfan
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <?= $this->renderSection('page-content'); ?>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2021</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>