<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li>
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            @isset(Auth::user()->photo)
                            <img src="{{Auth::user()->photo->getUrl('thumb')}}" class="img-circle elevation-2"
                                alt="User Image">
                            @endisset
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{Auth::user()->name}}</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                <li
                    class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }} {{ request()->is("admin/user-alerts*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-users">

                        </i>
                        <p>
                            {{ trans('cruds.userManagement.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('permission_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.permissions.index") }}"
                                class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-unlock-alt">

                                </i>
                                <p>
                                    {{ trans('cruds.permission.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('role_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.roles.index") }}"
                                class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-briefcase">

                                </i>
                                <p>
                                    {{ trans('cruds.role.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('user_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.users.index") }}"
                                class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-user">

                                </i>
                                <p>
                                    {{ trans('cruds.user.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('audit_log_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}"
                                class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-file-alt">

                                </i>
                                <p>
                                    {{ trans('cruds.auditLog.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('user_alert_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.user-alerts.index") }}"
                                class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-bell">

                                </i>
                                <p>
                                    {{ trans('cruds.userAlert.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('referensi_access')
                <li
                    class="nav-item has-treeview {{ request()->is("admin/jenis-plastiks*") ? "menu-open" : "" }} {{ request()->is("admin/kategori-plastiks*") ? "menu-open" : "" }} {{ request()->is("admin/jenis-usahas*") ? "menu-open" : "" }} {{ request()->is("admin/sumber-sampahs*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-bars">

                        </i>
                        <p>
                            {{ trans('cruds.referensi.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('jenis_plastik_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.jenis-plastiks.index") }}"
                                class="nav-link {{ request()->is("admin/jenis-plastiks") || request()->is("admin/jenis-plastiks/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-leaf">

                                </i>
                                <p>
                                    {{ trans('cruds.jenisPlastik.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('kategori_plastik_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.kategori-plastiks.index") }}"
                                class="nav-link {{ request()->is("admin/kategori-plastiks") || request()->is("admin/kategori-plastiks/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fab fa-accusoft">

                                </i>
                                <p>
                                    {{ trans('cruds.kategoriPlastik.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('jenis_usaha_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.jenis-usahas.index") }}"
                                class="nav-link {{ request()->is("admin/jenis-usahas") || request()->is("admin/jenis-usahas/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fab fa-audible">

                                </i>
                                <p>
                                    {{ trans('cruds.jenisUsaha.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('sumber_sampah_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.sumber-sampahs.index") }}"
                                class="nav-link {{ request()->is("admin/sumber-sampahs") || request()->is("admin/sumber-sampahs/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon far fa-trash-alt">

                                </i>
                                <p>
                                    {{ trans('cruds.sumberSampah.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('setup_access')
                <li
                    class="nav-item has-treeview {{ request()->is("admin/suppliers*") ? "menu-open" : "" }} {{ request()->is("admin/buyers*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-cogs">

                        </i>
                        <p>
                            {{ trans('cruds.setup.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('supplier_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.suppliers.index") }}"
                                class="nav-link {{ request()->is("admin/suppliers") || request()->is("admin/suppliers/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon far fa-address-card">

                                </i>
                                <p>
                                    {{ trans('cruds.supplier.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('buyer_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.buyers.index") }}"
                                class="nav-link {{ request()->is("admin/buyers") || request()->is("admin/buyers/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-chalkboard-teacher">

                                </i>
                                <p>
                                    {{ trans('cruds.buyer.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('mitra-only')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/data-mitra') || request()->is('admin/data-mitra/*') ? 'active' : '' }}"
                                href="{{ route('admin.data-mitra.index') }}">
                                <i class="fa-fw fas fa-database nav-icon">
                                </i>
                                <p>
                                    Data Mitra
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('transaksi_access')
                <li
                    class="nav-item has-treeview {{ request()->is("admin/pembelians*") ? "menu-open" : "" }} {{ request()->is("admin/penjualans*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-luggage-cart">

                        </i>
                        <p>
                            {{ trans('cruds.transaksi.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('pembelian_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.pembelians.index") }}"
                                class="nav-link {{ request()->is("admin/pembelians") || request()->is("admin/pembelians/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-box">

                                </i>
                                <p>
                                    {{ trans('cruds.pembelian.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('penjualan_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.penjualans.index") }}"
                                class="nav-link {{ request()->is("admin/penjualans") || request()->is("admin/penjualans/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-box-open">

                                </i>
                                <p>
                                    {{ trans('cruds.penjualan.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('mitra-only')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/kemitraan') || request()->is('admin/kemitraan/*') ? 'active' : '' }}"
                                href="{{ route('admin.kemitraan.index') }}">
                                <i class="fa-fw fas fa-credit-card nav-icon">
                                </i>
                                <p>
                                    Kemitraan
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <li
                    class="nav-item has-treeview {{ request()->is("admin/baseline-targets*") ? "menu-open" : "" }} {{ request()->is("admin/baseline-targets*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-book">

                        </i>
                        <p>
                            Laporan
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('admin-only')
                        <li class="nav-item">
                            <a href="{{ route("admin.baseline-targets.index") }}"
                                class="nav-link {{ request()->is("admin/baseline-targets") || request()->is("admin/baseline-targets/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-shopping-basket">

                                </i>
                                <p>
                                    {{ trans('cruds.baselineTarget.title') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.baseline-targets.laporan") }}"
                                class="nav-link {{ request()->is("admin/baseline/laporan") || request()->is("admin/baseline/laporan/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-book">

                                </i>
                                <p>
                                    Monitoring
                                </p>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{ route("admin.pembelians.laporan") }}"
                                class="nav-link {{ request()->is("admin/laporan-pembelians") || request()->is("admin/laporan-pembelians/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-box">

                                </i>
                                <p>
                                    Laporan Pembelian
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.penjualans.laporan") }}"
                                class="nav-link {{ request()->is("admin/laporan-penjualans") || request()->is("admin/laporan-penjualans/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-box-open">

                                </i>
                                <p>
                                    Laporan Penjualan
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>


                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}"
                        href="{{ route('admin.users.show', Auth::id()) }}">
                        <i class="fa-fw fas fa-pen nav-icon">
                        </i>
                        <p>
                            {{ trans('global.my_profile') }}
                        </p>
                    </a>
                </li>
                @endif


                @can('super-admin')
                <li
                    class="nav-item has-treeview {{ request()->is("imports*") ? "menu-open" : "" }} {{ request()->is("imports*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-book">
                        </i>
                        <p>
                            Import Transaksi
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('imports/pembelian-import') || request()->is('pembelian-import/*') ? 'active' : '' }}"
                                href="{{ route('admin.imports.pembelian-create') }}">
                                <i class="fa-fw fas fa-up nav-icon">
                                </i>
                                <p>
                                    Import Pembelian
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                <li class="nav-item">
                    <a href="#" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>