<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}
    </a>
</li>

<!-- Main menu -->
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('category') }}">
        <i class="la la-folder nav-icon"></i>
        {{ trans('custom.category_title') }}
    </a>
</li>

<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('item') }}'>
        <i class='nav-icon la la-cookie'></i>
        {{ trans('custom.item_title') }}
    </a>
</li>

<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('option') }}'>
        <i class='nav-icon la la-filter'></i>
        {{ trans('custom.option_title') }}
    </a>
</li>


<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon la la-plus"></i>
        Дополнения к товару
    </a>

    <ul class="nav-dropdown-items">
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('addition') }}">
                <i class="nav-icon la la-user"></i>
                <span>Дополнения</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('addition_value') }}">
                <i class="nav-icon la la-id-badge"></i>
                <span>Варианты дополнений</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('permission') }}">
                <i class="nav-icon la la-key"></i>
                <span>{{ trans('backpack::permissionmanager.permissions') }}</span>
            </a>
        </li>
    </ul>
</li>



<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('income') }}'>
        <i class='nav-icon la la-money'></i>
        {{ trans('custom.income_title') }}
    </a>
</li>

<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('setting') }}'>
        <i class='nav-icon la la-cog'></i>
        {{ trans('backpack::settings.title') }}
    </a>
</li>

<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon la la-users"></i>
        {{ trans('backpack::permissionmanager.user_plural') }}
    </a>

    <ul class="nav-dropdown-items">
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('user') }}">
                <i class="nav-icon la la-user"></i>
                <span>{{ trans('backpack::permissionmanager.user') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('role') }}">
                <i class="nav-icon la la-id-badge"></i>
                <span>{{ trans('backpack::permissionmanager.roles') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('permission') }}">
                <i class="nav-icon la la-key"></i>
                <span>{{ trans('backpack::permissionmanager.permissions') }}</span>
            </a>
        </li>
    </ul>
</li>

