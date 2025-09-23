
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar <?= SIDEBAR_COLOR ?> elevation-4">
                <!-- Brand Logo -->
                <a href="<?= base_url(); ?>" class="brand-link">
                    <img src="<?= file_url('assets/images/icon.png') ?>" alt="<?= PROJECT_NAME ?> Logo" class="brand-image bg-white img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light"><?= PROJECT_NAME ?></span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="<?=file_url('includes/dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"><?= $this->session->name; ?></a>
                        </div>
                    </div>

                    <!-- SidebarSearch Form -->
                    <div class="form-inline d-none">
                        <div class="input-group" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar nav-compact flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="<?= base_url('home/'); ?>" class="nav-link <?= activate_menu('home'); ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Home</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview <?= activate_dropdown('masterkey'); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('masterkey','a'); ?>">
                                    <i class="nav-icon fas fa-key"></i>
                                    <p>Master Key <i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('masterkey/category/'); ?>" class="nav-link <?= activate_menu('masterkey/category'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Category</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('masterkey/bank/'); ?>" class="nav-link <?= activate_menu('masterkey/bank'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Banks</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview <?= activate_dropdown('settings'); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('settings','a'); ?>">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>Settings<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('settings/'); ?>" class="nav-link <?= activate_menu('settings'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>General</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item <?= activate_dropdown('customize'); ?>">
                                <a href="#" class="nav-link <?= activate_dropdown('customize','a'); ?>">
                                    <i class="nav-icon fas fa-wrench"></i>
                                    <p>
                                        Customize
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('customize/'); ?>" class="nav-link <?= activate_menu('customize'); ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Banner Images</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
