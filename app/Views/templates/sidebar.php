<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light bg_birulaut0" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <!-- operator -->
                    <?php if (in_groups('admin') || in_groups('manager bagian operasi') || in_groups('supervisor operasi shift a') || in_groups('supervisor operasi shift b') || in_groups('supervisor operasi shift c') || in_groups('supervisor operasi shift d')) : ?>
                        <div class="sb-sidenav-menu-heading pb-0 mb-0 text_orange">dashboard</div>
                        <a class="nav-link pb-0 mb-0" href="/db_home">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-database"></i></div>
                            Databases
                        </a>
                        <a class="nav-link pb-0 mb-0" href="<?= base_url('/make_notice'); ?>">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-bullhorn"></i></div>
                            Make Notice
                        </a>
                        <a class="nav-link pb-0 mb-0" href="/input_co">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-calendar-plus"></i></div>
                            Input Schedule C/O
                        </a>
                        <a class="nav-link pb-0 mb-0" href="input_limas">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-calendar-plus"></i></div>
                            Input Schedule 5S
                        </a>
                        <a class="nav-link pb-0 mb-0" href="">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-eye"></i></div>
                            KPI Monitoring
                        </a>
                    <?php endif; ?>

                    <!-- operator -->
                    <?php if (in_groups('admin') || in_groups('supervisor operasi shift a') || in_groups('supervisor operasi shift b') || in_groups('supervisor operasi shift c') || in_groups('supervisor operasi shift d') || in_groups('operasi shift a') || in_groups('operasi shift b') || in_groups('operasi shift c') || in_groups('operasi shift d')) : ?>
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
                        <a class="nav-link pb-0 mb-0" href="/">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-keyboard"></i></div>
                            Input Logsheet
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
                </div>
            </div>
        </footer>
    </div>
</div>