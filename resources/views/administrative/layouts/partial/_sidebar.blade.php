<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand"><img src="{{asset('assets/images/Logo.png')}}" width="40">
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="/" class="nav-link">
                    <i class="link-icon" data-feather="align-left"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>


            @can('User Menu')
                <li class="nav-item">
                    <a href="{{route('administrative.user')}}" class="nav-link">
                        <i class="link-icon" data-feather="user-check"></i>
                        <span class="link-title">Users</span>
                    </a>
                </li>
            @endcan
            @can('News Menu')
                <li class="nav-item">
                    <a href="{{route('administrative.news')}}" class="nav-link">
                        <i class="link-icon" data-feather="book-open"></i>
                        <span class="link-title">News</span>
                    </a>
                </li>
            @endcan
            @can('News Menu')
                <li class="nav-item">
                    <a href="{{route('administrative.application')}}" class="nav-link">
                        <i class="link-icon" data-feather="hard-drive"></i>
                        <span class="link-title">Applications</span>
                    </a>
                </li>
            @endcan
            <li class="nav-item nav-category">Settings</li>
            @can('Article Menu')
                <li class="nav-item">
                    <a href="{{route('administrative.article')}}" class="nav-link">
                        <i class="link-icon" data-feather="hard-drive"></i>
                        <span class="link-title">Article</span>
                    </a>
                </li>
            @endcan


            @can('Permission Menu')
            <li class="nav-item">
                <a href="{{route('administrative.role')}}" class="nav-link">
                    <i class="link-icon" data-feather="command"></i>
                    <span class="link-title">Role</span>
                </a>
            </li>
            @endcan
                        @can('Permission Menu')
                            <li class="nav-item">
                                <a href="{{route('administrative.permission')}}" class="nav-link">
                                    <i class="link-icon" data-feather="disc"></i>
                                    <span class="link-title">Permission</span>
                                </a>
                            </li>
                        @endcan
            @can('Permission Menu')
                <li class="nav-item">
                    <a href="{{route('administrative.jobstatus')}}" class="nav-link">
                        <i class="link-icon" data-feather="flag"></i>
                        <span class="link-title">Job Status</span>
                    </a>
                </li>
            @endcan
            @can('Permission Menu')
                <li class="nav-item">
                    <a href="{{route('administrative.subject')}}" class="nav-link">
                        <i class="link-icon" data-feather="key"></i>
                        <span class="link-title">Subject</span>
                    </a>
                </li>
            @endcan
            @can('Permission Menu')
                <li class="nav-item">
                    <a href="{{route('administrative.location')}}" class="nav-link">
                        <i class="link-icon" data-feather="navigation"></i>
                        <span class="link-title">Location</span>
                    </a>
                </li>
            @endcan
            @can('Permission Menu')
                <li class="nav-item">
                    <a href="{{route('administrative.university')}}" class="nav-link">
                        <i class="link-icon" data-feather="globe"></i>
                        <span class="link-title">University</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</nav>

