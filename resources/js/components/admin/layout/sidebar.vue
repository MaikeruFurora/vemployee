<template>
    <div>
        <aside class="app-navbar">
            <!-- begin sidebar-nav -->
            <div class="sidebar-nav scrollbar scroll_light">
                <ul class="metismenu" id="sidebarNav">
                    <li class="nav-static-title">Personal</li>
                    <li><router-link to="/dashboard" replace><i class="nav-icon ti ti-layout-grid2"></i><span class="nav-title">Dashboard</span></router-link></li>
                    <li><router-link to="/teachers" replace><i class="nav-icon ti ti-user"></i><span class="nav-title">Teachers</span></router-link></li>
                    <li><router-link to="/lawop" replace><i class="nav-icon ti ti-files"></i><span class="nav-title">LAWOP</span></router-link></li>
                    <li><a @click="logout"><i class="nav-icon ti ti-power-off"></i><span class="nav-title">Logout</span></a></li>
                </ul>
            </div>
            <!-- end sidebar-nav -->
        </aside>
    </div>
</template>