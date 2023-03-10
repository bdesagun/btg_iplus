<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="home">
                <img src="<?php echo base_url(); ?>assets/img/brand/btg.png" class="navbar-brand-img" alt="...">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="home">
                            <i class="ni ni-shop text-black"></i>
                            <span class="nav-link-text" style="<?php echo ($_SESSION["activepage"] == "HOME") ? "font-weight: bold; text-decoration:underline;" : "" ?>">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboards"  style="<?php echo ($_SESSION["activepage"] == "DASHBOARDS") ? "font-weight: bold; text-decoration:underline;" : "" ?>">
                            <i class="ni ni-chart-pie-35 text-black"></i>
                            <span class="nav-link-text">Dashboards</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="workflow"  style="<?php echo ($_SESSION["activepage"] == "WORKFLOW") ? "font-weight: bold; text-decoration:underline;" : "" ?>">
                            <i class="ni ni-single-copy-04 text-black"></i>
                            <span class="nav-link-text">Workflow</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-history" data-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-history">
                            <i class="ni ni-ungroup text-black"></i>
                            <span class="nav-link-text">History</span>
                        </a>
                        <div class="collapse" id="navbar-history">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Lodged BASs</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">BAS Reports</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Source Data</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="filezone" style="<?php echo ($_SESSION["activepage"] == "FILEZONE") ? "font-weight: bold; text-decoration:underline;" : "" ?>">
                            <i class="ni ni-archive-2 text-black"></i>
                            <span class="nav-link-text">FileZone</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="ni ni-chat-round text-black"></i>
                            <span class="nav-link-text">FAQ</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>