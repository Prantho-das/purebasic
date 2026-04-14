{{-- header section start from here --}}
<section class="top-header-main">
    <div class="container ed-container-expand">
        <div class="top-header-flex">


            <div class="logo-box">
                <a href="{{ url('/') }}">


                    @php
                    $logo = get_business_setting('site_logo');
                    @endphp
                    @if ($logo)
                    <img src="{{ asset('storage/' . $logo) }}" alt="logo">
                    @else
                    <img src="{{ asset('assets/images/logo-light.png') }}" alt="logo">
                    @endif
                    {{-- <img src="{{ asset('assets/images/logo.svg') }}" alt="logo"> --}}
                    {{-- @php
                        $logo = get_business_setting('site_logo');
                    @endphp
                    @if ($logo)
                        <img src="{{ asset('storage/' . $logo) }}" alt="logo">
                    @else
                        <img src="{{ asset('assets/images/logo-light.png') }}" alt="logo">
                    @endif --}}
                </a>
            </div>
            @php
                $batchCategory = App\BatchCategory::all();
            @endphp

            <form action="{{ route('web.search') }}">
                <div class="topheader-search-box">
                    <div class="category-select-box">
                        <select name="batch_category" class="category-select wide">
                            <option value="0" selected disabled>All Categories</option>
                            @foreach ($batchCategory as $bcategory)
                                <option value="{{ $bcategory->id }}">{{ $bcategory->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="topsearch-box">
                        {{-- <form action="{{route('web.search')}}"> --}}
                        <input name="search" type="text" placeholder="Search your courses">
                        <button class="header-search-btn">search <i class="fa-light fa-magnifying-glass"></i></button>
                        {{-- </form> --}}
                    </div>
                </div>
            </form>
            <div class="topbar-info">
                <div class="topbar-social-link">
                    @php
                        $row = \DB::table('business_settings')
                            ->where('type', 'social_media_links')
                            ->first(['value']);
                        $socialTypes = ['facebook', 'twitter', 'instagram', 'youtube'];
                        if ($row) {
                            $settingsArray = json_decode($row->value, true) ?? [];
                        } else {
                            $settingsArray = [];
                        }

                        // Build assoc array from the array of objects (link_type as key)
                        $settings = [];
                        foreach ($settingsArray as $item) {
                            if (isset($item['link_type'])) {
                                $settings[$item['link_type']] = $item['link'] ?? '';
                            }
                        }

                        // Merge defaults (ensure all types exist, even if empty)
                        foreach ($socialTypes as $type) {
                            if (!isset($settings[$type])) {
                                $settings[$type] = '';
                            }
                        }
                        $iconMap = [
                            'facebook' => 'fa-facebook-f',
                            'twitter' => 'fa-twitter',
                            'instagram' => 'fa-instagram',
                            'youtube' => 'fa-youtube',
                        ];
                    @endphp
                    <ul class="social-links">
                        @foreach ($socialTypes as $type)
                            @if (!empty($settings[$type] ?? ''))
                                <li>
                                    <a href="{{ $settings[$type] }}" target="_blank" rel="noopener noreferrer">
                                        <i class="fa-brands {{ $iconMap[$type] ?? 'fa-' . $type }}"></i>
                                    </a>
                                </li>
                            @else
                                {{-- Optional: Show inactive with # href or skip entirely --}}
                                <li>
                                    <a href="#">
                                        <i class="fa-brands {{ $iconMap[$type] ?? 'fa-' . $type }}"></i>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>


                </div>
                <div class="topbar-buttons">

                    @php
                        $sessionId = Session::get('id');
                        $headerStudent = $sessionId ? App\Student::where('id', $sessionId)->first() : null;
                    @endphp

                    @if ($headerStudent)
                        {{-- Logged-in: avatar dropdown --}}
                        <div class="header-user-dropdown">
                            <button class="header-user-btn" id="headerUserBtn" type="button">
                                <img src="{{ $headerStudent->photo }}" alt="{{ $headerStudent->name }}" class="header-user-avatar">
                                <span class="header-user-name">{{ \Illuminate\Support\Str::words($headerStudent->name, 1, '') }}</span>
                                <i class="fa-regular fa-chevron-down header-user-chevron"></i>
                            </button>
                            <div class="header-user-menu" id="headerUserMenu">
                                <div class="header-user-info">
                                    <img src="{{ $headerStudent->photo }}" alt="{{ $headerStudent->name }}" class="header-user-menu-avatar">
                                    <div>
                                        <p class="header-user-menu-name">{{ $headerStudent->name }}</p>
                                        <p class="header-user-menu-email">{{ $headerStudent->email }}</p>
                                    </div>
                                </div>
                                <div class="header-user-menu-divider"></div>
                                <a href="{{ url('/student/profile/' . $headerStudent->id) }}" class="header-user-menu-item">
                                    <i class="fa-regular fa-gauge-high"></i> Dashboard
                                </a>
                                <a href="{{ url('/student/profile/' . $headerStudent->id) }}#editPanel" class="header-user-menu-item">
                                    <i class="fa-regular fa-user-pen"></i> Edit Profile
                                </a>
                                <div class="header-user-menu-divider"></div>
                                <a href="{{ url('/student/logout') }}" class="header-user-menu-item header-user-logout">
                                    <i class="fa-regular fa-arrow-right-from-bracket"></i> Logout
                                </a>
                            </div>
                        </div>
                    @else
                        {{-- Guest: register + login --}}
                        <a href="{{ route('student.register') }}" class="register-btn">Register</a>
                        <a href="{{ url('student/login') }}" class="btn login-btn">Log In</a>
                    @endif
                </div>

            </div>
            <div class="header-bar">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</section>



<header>
    <div class="main-header" id="main-header">
        <div class="container ed-container-expand">
            <div class="header-flex">
                <div class="left-box">
                    <ul>
                        @foreach (\App\Menu::ofType('header')->root()->active()->orderBy('sort_order')->with('children')->get() as $headerMenu)
                            <li>
                                <a href="{{ $headerMenu->url ?? '#' }}">{{ $headerMenu->name ?? 'Menu Item' }}
                                    @if (count($headerMenu->children))
                                        <i class="fa-regular fa-chevron-down"></i>
                                    @endif

                                </a>

                                @if (count($headerMenu->children))
                                    <ul class="sub-menu">
                                        @foreach ($headerMenu->children ?? [] as $child)
                                            <li><a
                                                    href="{{ $child->url ?? '#' }}">{{ $child->name ?? 'Sub Item' }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="right-box">
                    <ul>
                        @foreach (\App\Menu::ofType('other')->root()->active()->orderBy('sort_order')->with('children')->get() as $headerMenu)
                            <li>
                                <a href="{{ $headerMenu->url ?? '#' }}">{{ $headerMenu->name ?? 'Menu Item' }}
                                    @if (count($headerMenu->children))
                                        <i class="fa-regular fa-chevron-down"></i>
                                    @endif

                                </a>

                                @if (count($headerMenu->children))
                                    <ul class="sub-menu">
                                        @foreach ($headerMenu->children ?? [] as $child)
                                            <li><a
                                                    href="{{ $child->url ?? '#' }}">{{ $child->name ?? 'Sub Item' }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach

                    </ul>

                </div>
            </div>
        </div>
    </div>
</header>
{{-- header section ends here --}}

<!-- Sidebar area start here -->
<div id="targetElement" class="sidebar-area" style="display: none;">
    <ul>
        @foreach (\App\Menu::ofType('header')->root()->active()->orderBy('sort_order')->with('children')->get() as $headerMenu)
            <li>
                <a href="{{ $headerMenu->url ?? '#' }}">{{ $headerMenu->name ?? 'Menu Item' }}
                    @if (count($headerMenu->children))
                        <i class="fa-regular fa-chevron-down"></i>
                    @endif

                </a>

                @if (count($headerMenu->children))
                    <ul class="sub-menu">
                        @foreach ($headerMenu->children ?? [] as $child)
                            <li><a href="{{ $child->url ?? '#' }}">{{ $child->name ?? 'Sub Item' }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
        @foreach (\App\Menu::ofType('other')->root()->active()->orderBy('sort_order')->with('children')->get() as $headerMenu)
            <li>
                <a href="{{ $headerMenu->url ?? '#' }}">{{ $headerMenu->name ?? 'Menu Item' }}
                    @if (count($headerMenu->children))
                        <i class="fa-regular fa-chevron-down"></i>
                    @endif

                </a>

                @if (count($headerMenu->children))
                    <ul class="sub-menu">
                        @foreach ($headerMenu->children ?? [] as $child)
                            <li><a href="{{ $child->url ?? '#' }}">{{ $child->name ?? 'Sub Item' }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
    {{-- Mobile auth area --}}
    <div class="sidebar-auth">
        @if ($headerStudent ?? null)
            <div class="sidebar-user-info">
                <img src="{{ $headerStudent->photo }}" alt="{{ $headerStudent->name }}" class="sidebar-user-avatar">
                <div>
                    <p class="sidebar-user-name">{{ $headerStudent->name }}</p>
                    <p class="sidebar-user-email">{{ $headerStudent->email }}</p>
                </div>
            </div>
            <a href="{{ url('/student/profile/' . $headerStudent->id) }}" class="sidebar-auth-btn sidebar-dashboard-btn">
                <i class="fa-regular fa-gauge-high"></i> Dashboard
            </a>
            <a href="{{ url('/student/logout') }}" class="sidebar-auth-btn sidebar-logout-btn">
                <i class="fa-regular fa-arrow-right-from-bracket"></i> Logout
            </a>
        @else
            <a href="{{ route('student.register') }}" class="sidebar-auth-btn sidebar-register-btn">Register</a>
            <a href="{{ url('student/login') }}" class="sidebar-auth-btn sidebar-login-btn">Log In</a>
        @endif
    </div>
</div>
<!-- Sidebar area end here -->

<script>
(function () {
    // ── Header user dropdown toggle
    var dropBtn  = document.getElementById('headerUserBtn');
    var dropWrap = dropBtn ? dropBtn.closest('.header-user-dropdown') : null;

    if (dropBtn && dropWrap) {
        dropBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            dropWrap.classList.toggle('open');
        });

        // Close when clicking outside
        document.addEventListener('click', function () {
            dropWrap.classList.remove('open');
        });

        // Prevent menu click from closing dropdown
        var menu = document.getElementById('headerUserMenu');
        if (menu) {
            menu.addEventListener('click', function (e) { e.stopPropagation(); });
        }
    }
})();
</script>
