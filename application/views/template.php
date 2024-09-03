<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Perpustakaan Digital</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/img/kaiadmin/favicon.ico" type="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>image/x-icon" />

    <!-- Fonts and icons -->
    <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/css/plugins.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/css/demo.css" />
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="index.html" class="logo">
                        <img src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item active">
                            <a data-bs-toggle="collapse" href="<?= base_url('home') ?>" class="collapsed" aria-expanded="false">
                            <i class="fa fa-address-card"></i>
                                <p>Dashboard</p>
                            </a>

                            <div class="sidebar-content">
                                <ul class="nav nav-secondary">

                                    <li class="nav-section">
                                        <span class="sidebar-mini-icon">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </span>
                                        <h4 class="text-section"><?= $this->session->userdata('level'); ?></h4>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('user') ?>">
                                            <i class="fa-solid fa-user fa-fw"></i>
                                            <p>Data User</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('kategori') ?>">
                                            <i class="fas fa-layer-group"></i>
                                            <p>Kategori Buku</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('buku') ?>">
                                            <i class="fas fa-layer-group"></i>
                                            <p> Buku</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('dashboard/peminjaman') ?>">
                                            <i class="fas fa-layer-group"></i>
                                            <p>Peminjaman Buku</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('siswa') ?>">
                                            <i class="fas fa-layer-group"></i>
                                            <p>Siswa</p>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pe-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input type="text" placeholder="Search ..." class="form-control" />
                            </div>
                        </nav>

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search ..." class="form-control" />
                                        </div>
                                    </form>
                                </ul>
                            </li>


                            <h6><?= $judul_halaman; ?></h6>
                            <br>

                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold"><?= $this->session->userdata('nama'); ?></span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/img/profile.jpg" alt="image profile" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4><?= $this->session->userdata('nama'); ?></h4>
                                                    <p class="text-muted">hello@example.com</p>
                                                    <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">My Profile</a>
                                            <a class="dropdown-item" href="#">My Balance</a>
                                            <a class="dropdown-item" href="#">Inbox</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Account Setting</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">
                    <?= $contents; ?>

                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">

                    <div class="copyright">
                        2024, made with <i class="fa fa-heart heart text-danger"></i> by
                        <a href="http://www.themekita.com">ThemeKita</a>
                    </div>

                </div>
            </footer>
        </div>


    </div>
    <!--   Core JS Files   -->
    <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/core/popper.min.js"></script>
    <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/setting-demo.js"></script>
    <!-- <script src="<?= base_url('assets/kaiadmin-lite-1.2.0/'); ?>assets/js/demo.js"></script> -->
    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>
</body>

</html>