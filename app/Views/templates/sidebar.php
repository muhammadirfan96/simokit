<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light bg_birulaut0" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <!-- operator -->
                    <?php if (in_groups('admin') || in_groups('manager bagian operasi') || in_groups('supervisor operasi shift a') || in_groups('supervisor operasi shift b') || in_groups('supervisor operasi shift c') || in_groups('supervisor operasi shift d')) : ?>
                        <div class="sb-sidenav-menu-heading pb-0 mb-0 text_orange">dashboard</div>
                        <?php if (!in_groups('manager bagian operasi')) : ?>
                            <a class="nav-link pb-0 mb-0" href="/db_home">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-database"></i></div>
                                Databases
                            </a>
                            <a class="nav-link pb-0 mb-0" href="/input_co">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-calendar-plus"></i></div>
                                Input Schedule C/O
                            </a>
                            <a class="nav-link pb-0 mb-0" href="input_limas">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-calendar-plus"></i></div>
                                Input Schedule 5S
                            </a>
                            <a class="nav-link pb-0 mb-0" href="/kpi_monitoring">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-eye"></i></div>
                                KPI Monitoring
                            </a>
                            <a class="nav-link pb-0 mb-0" href="/input_absensi">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-pen"></i></div>
                                Input Absensi
                            </a>
                        <?php endif; ?>
                        <a class="nav-link pb-0 mb-0" href="<?= base_url('/make_notice'); ?>">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-bullhorn"></i></div>
                            Make Notice
                        </a>
                        <a class="nav-link pb-0 mb-0" href="/admin">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-desktop"></i></div>
                            Admin Monitoring
                        </a>
                    <?php endif; ?>


                    <?php if (!in_groups('manager bagian operasi')) : ?>
                        <!-- operator -->
                        <div class="sb-sidenav-menu-heading pb-0 mb-0 text_orange">operator</div>
                        <a class="nav-link pb-0 mb-0" href="/bacasopik">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-book-reader"></i></div>
                            Read SOP IK
                        </a>
                        <a class="nav-link pb-0 mb-0" href="/checklist">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-tasks"></i></div>
                            Checklist SOP IK
                        </a>
                        <a class="nav-link pb-0 mb-0" href="/servicerequest/cm">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-pen"></i></div>
                            Make SR CM
                        </a>
                        <a class="nav-link pb-0 mb-0" href="/servicerequest/flm">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-pen"></i></div>
                            Make SR FLM
                        </a>
                        <a class="nav-link pb-0 mb-0" href="/limas">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-pen"></i></div>
                            Make Form 5S
                        </a>
                        <a class="nav-link pb-0 mb-0" href="/input_kwh">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-keyboard"></i></div>
                            Input Kwh
                        </a>

                        <?php if (in_groups('operator shift a') || in_groups('operator shift b') || in_groups('operator shift c') || in_groups('operator shift d')) : ?>
                            <a class="nav-link pb-0 mb-0" href="/approved_home">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-check-double"></i></div>
                                Approved
                            </a>
                            <a class="nav-link pb-0 mb-0" href="/kpi">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-eye"></i></div>
                                KPI
                            </a>
                        <?php endif; ?>
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
        <footer class="py-4 bg-light mt-2">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Simokit 2021</div>
                </div>
            </div>
        </footer>
    </div>
</div>