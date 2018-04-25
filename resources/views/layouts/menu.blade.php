<!-- Main navigation -->
<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">

            <!-- Main -->
            <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
            <li class="{{ Request::is('/produk')  ? 'active' : '' }}">
                <a href="#"><i class="icon-stack2"></i> <span>Master Produk</span></a>
                <ul>
                    <li class="{{ Request::is('/produk') ? 'active' : '' }}"><a href="{{ url('/produk') }}">Produk</a></li>
                </ul>
            </li>
            <li class="{{ Request::is('/karyawan')  ? 'active' : '' }}">
                <a href="#"><i class="icon-stack2"></i> <span>Master Karyawan</span></a>
                <ul>
                    <li class="{{ Request::is('/karyawan') ? 'active' : '' }}"><a href="{{ url('/karyawan') }}">Karyawan</a></li>
                </ul>
            </li>
            <li class="{{ Request::is('/pelanggan')  ? 'active' : '' }}">
                <a href="#"><i class="icon-stack2"></i> <span>Master Pelanggan</span></a>
                <ul>
                    <li class="{{ Request::is('/pelanggan') ? 'active' : '' }}"><a href="{{ url('/pelanggan') }}">Pelanggan</a></li>
                </ul>
            </li>
            <li class="{{ Request::is('/penjualan')  ? 'active' : '' }}">
                <a href="#"><i class="icon-stack2"></i> <span>Master Penjualan</span></a>
                <ul>
                    <li class="{{ Request::is('/penjualan') ? 'active' : '' }}"><a href="{{ url('/penjualan') }}">Penjualan</a></li>
                </ul>
            </li>
            <li class="{{ Request::is('/pembayaran')  ? 'active' : '' }}">
                <a href="#"><i class="icon-stack2"></i> <span>Master Pembayaran</span></a>
                <ul>
                    <li class="{{ Request::is('/pembayaran') ? 'active' : '' }}"><a href="{{ url('/pembayaran') }}">Pembayaran</a></li>
                </ul>
            </li>
            <!--li class="{{ Request::is('/usertype') || Request::is('/statususer') || Request::is('/statusprocess') || Request::is('/statusbranch')  ? 'active' : '' }}">
                <a href="#"><i class="icon-stack2"></i> <span>Configuration</span></a>
                <ul>
                    <li class="{{ Request::is('/usertype') ? 'active' : '' }}"><a href="{{ url('/usertype') }}">User Type</a></li>
                    <li class="{{ Request::is('/statususer') ? 'active' : '' }}"><a href="{{ url('/statususer') }}">Status User</a></li>
                    <li class="{{ Request::is('/statusprocess') ? 'active' : '' }}"><a href="{{ url('/statusprocess') }}">Status Process</a></li>
                    <li class="{{ Request::is('/statusbranch') ? 'active' : '' }}"><a href="{{ url('/statusbranch') }}">Status Branch</a></li>
                </ul>
            </li-->
            <!-- /main -->

        </ul>
    </div>
</div>
<!-- /main navigation -->
