<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <!--<li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/dashboard/') ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                </li> -->
                <?php if ($this->session->userdata['loginData']['Level'] == "admin") { ?>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/user/') ?>" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Kelola User</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/kategori/') ?>" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Kelola Rumpun</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/kelola/') ?>" aria-expanded="false"><i class="mdi mdi-book"></i><span class="hide-menu">Kelola Dokumen</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/pasal/') ?>" aria-expanded="false"><i class="mdi mdi-book"></i><span class="hide-menu">Kelola Pasal</span></a></li>

                <?php } ?>
                <?php if ($this->session->userdata['loginData']['Level'] == "verifikator") { ?>

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/pasal/') ?>" aria-expanded="false"><i class="mdi mdi-information"></i><span class="hide-menu">Detail Peraturan UU</span></a></li>

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/status/') ?>" aria-expanded="false"><i class="mdi mdi-information"></i><span class="hide-menu">Status Peraturan</span></a></li>

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/rekomendasi/') ?>" aria-expanded="false"><i class="mdi mdi-format-list-bulleted"></i><span class="hide-menu">Peraturan Berlaku</span></a></li>

                    <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="<?php echo base_url('admin/drafting') ?>" aria-expanded="false"><i
                            class="mdi mdi-format-list-bulleted"></i><span class="hide-menu">Drafting UU</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="<?php echo base_url('admin/harmonisasi') ?>" aria-expanded="false"><i
                            class="mdi mdi-format-list-bulleted"></i><span class="hide-menu">Harmonisasi UU</span></a>
                </li> -->
                <?php } ?>

                <?php if ($this->session->userdata['loginData']['Level'] == "user") { ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/dashboard/') ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Home</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/Kelola/') ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Arsip</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/dashboard/') ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Check Dokumen</span></a>
                    </li>

                <?php } ?>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>