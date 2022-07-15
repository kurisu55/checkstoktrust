<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: black;">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center mb-2 disabled" href="#">
            <div class="sidebar-brand-icon mt-1" style="background-color: white;">
                <img src="<?= base_url('assets/images/') ?>Toyota-Trust-1-1024x460.png" alt="Logo Toyota Trust" width="90" height="50">
            </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Query Menu -->
        <?php
        $role_id = $this->session->userdata('role_id');
        $queryMenu = "  SELECT `user_menu`.`id`, `menu`
                            FROM `user_menu` JOIN `user_access_menu` 
                            ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                            WHERE `user_access_menu`.`role_id` = $role_id
                            ORDER BY `user_access_menu`.`menu_id` ASC
                ";
        $menu = $this->db->query($queryMenu)->result_array();
        ?>

        <!-- Looping Menu -->
        <?php
        foreach ($menu as $m) : ?>
            <div class="sidebar-heading">
                <?= $m['menu']; ?>
            </div>

            <!-- Submenu pada Menu -->
            <?php
            $menuId = $m['id'];
            $querySubMenu = "   SELECT *
                                    FROM `user_submenu` INNER JOIN `user_menu` 
                                    ON `user_submenu`.`menu_id`     = `user_menu`.`id`
                                    WHERE `user_submenu`.`menu_id`  = $menuId
                                    AND `user_submenu`.`is_active`  =1

                ";
            $subMenu = $this->db->query($querySubMenu)->result_array();
            ?>
            <?php
            foreach ($subMenu as $sm) : ?>
                <?php if ($title == $sm['title']) : ?>
                    <!-- Nav Item --->
                    <li class="nav-item active">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                        <i class="<?= $sm['icon']; ?>"></i>
                        <span><?= $sm['title'] ?></span></a>
                    </li>
                <?php endforeach; ?>
                <!-- End Submenu pada Menu -->

                <hr class="sidebar-divider mt-3">

            <?php endforeach; ?>
            <!-- End Looping Menu -->

            <div class="sidebar-heading">Logout</div>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout') ?>"><i class="fas fa-fw fa-solid fa-arrow-right-from-bracket"></i><span>Logout</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

    </ul>
    <!-- End of Sidebar -->