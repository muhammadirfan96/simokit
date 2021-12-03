<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light bg_blue_light border_bottom" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <?php if (in_groups('admin')) : ?>
                        <!-- admin -->
                        <div class="sb-sidenav-menu-heading pb-0 mb-0 text_orange">admin</div>
                        <a class="nav-link pb-0 mb-0" href="/Db_home">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                            Database
                        </a>
                        <a class="nav-link pb-0 mb-0" href="index.html">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                            Schedule C.O.
                        </a>
                        <a class="nav-link pb-0 mb-0" href="index.html">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                            Schedule 5S
                        </a>
                    <?php endif; ?>

                    <?php if (in_groups('admin') || in_groups('manager bagian operasi')) : ?>
                        <!-- manager bagian operasi -->
                        <div class="sb-sidenav-menu-heading pb-0 mb-0 text_orange">manager op</div>
                        <a class="nav-link pb-0 mb-0" href="index.html">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                            Logsheet
                        </a>
                        <a class="nav-link pb-0 mb-0" href="index.html">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                            Make Notice
                        </a>
                    <?php endif; ?>
                    <?php if (in_groups('admin') || in_groups('supervisor operasi shift a') || in_groups('supervisor operasi shift b') || in_groups('supervisor operasi shift c') || in_groups('supervisor operasi shift d')) : ?>
                        <!-- supervisor operasi -->
                        <div class="sb-sidenav-menu-heading pb-0 mb-0 text_orange">supervisor op</div>
                        <a class="nav-link pb-0 mb-0" href="index.html">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                            Logsheet
                        </a>
                        <a class="nav-link pb-0 mb-0" href="index.html">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                            Make Notice
                        </a>
                    <?php endif; ?>

                    <!-- operator -->
                    <?php if (in_groups('admin') || in_groups('supervisor operasi shift a') || in_groups('supervisor operasi shift b') || in_groups('supervisor operasi shift c') || in_groups('supervisor operasi shift d') || in_groups('operasi shift a') || in_groups('operasi shift b') || in_groups('operasi shift c') || in_groups('operasi shift d')) : ?>
                        <div class="sb-sidenav-menu-heading pb-0 mb-0 text_orange">operator</div>
                        <a class="nav-link pb-0 mb-0" href="/bacasopik">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-chart-area"></i></div>
                            Baca SOP IK
                        </a>
                        <a class="nav-link pb-0 mb-0" href="/checklist">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-table"></i></div>
                            Checklist SOP IK
                        </a>
                        <a class="nav-link pb-0 mb-0" href="/servicerequest/cm">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-chart-area"></i></div>
                            SR CM
                        </a>
                        <a class="nav-link pb-0 mb-0" href="/servicerequest/flm">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-table"></i></div>
                            SR FLM
                        </a>
                        <a class="nav-link pb-0 mb-0" href="/limas">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-chart-area"></i></div>
                            Form 5S
                        </a>
                        <a class="nav-link pb-0 mb-0" href="/">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-chart-area"></i></div>
                            Logsheet
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?= user()->fullname; ?>
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
                    <div class="text-muted">Copyright &copy; Simokit 2021</div>
                    <div>
                        <a href="/">Privacy Policy</a>
                        &middot;
                        <a href="/">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>