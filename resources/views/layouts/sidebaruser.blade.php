<!-- User menu -->
<div class="sidebar-user-material">
    <div class="category-content">
        <div class="sidebar-user-material-content">
            <a href="#"><img src="{{ URL::asset('../limitless/assets/images/placeholder.jpg') }}" class="img-circle img-responsive" alt=""></a>
            <h6>@yield('loginuser')</h6>
            <span class="text-size-small">@yield('jabatan')</span>
        </div>

        <div class="sidebar-user-material-menu">
            <a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
        </div>
    </div>

    <div class="navigation-wrapper collapse" id="user-nav">
        <ul class="navigation">
            <li><a href="#"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
            <li><a href="#"><i class="icon-switch2"></i> <span>Logout</span></a></li>
        </ul>
    </div>
</div>
<!-- /user menu -->