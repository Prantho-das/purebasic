{{-- header section start from here --}}
<section class="top-header-main">
    <div class="container ed-container-expand">
        <div class="top-header-flex">
            <div class="logo-box">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo">
                </a>
            </div>
            @php
            $batchCategory=App\BatchCategory::all();
            @endphp

            <div class="topheader-search-box">
                {{-- <form action="{{route('web.search')}}"> --}}
                <div class="category-select-box">
                    <select name="batch_category" class="category-select wide">
                        <option value="0" selected disabled>All Categories</option>
                        @foreach($batchCategory as $bcategory)
                        <option value="{{$bcategory->id}}">{{$bcategory->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="topsearch-box">
                    <form action="{{route('web.search')}}">
                        <input name="search" type="text" placeholder="Search your courses">
                        <button class="header-search-btn">search <i class="fa-light fa-magnifying-glass"></i></button>
                    </form>
                </div>
            {{-- </form> --}}
            </div>
            <div class="topbar-info">
                <div class="topbar-social-link">
                    @php
                    $row = \DB::table('business_settings')
                    ->where('type', 'social_media_links')
                    ->first(['value']);
                    $socialTypes=['facebook', 'twitter', 'instagram', 'youtube'];
                    if ($row) {
                    $settingsArray = json_decode($row->value, true) ?? [];
                    }else{
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
                        @foreach($socialTypes as $type)
                        @if(!empty($settings[$type] ?? ''))
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
                    <button type="button" class="register-btn">Register</button>
                    <a type="button" href={{url('student/login')}} class="btn login-btn">Log In</a>
                </div>

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
                        @foreach(\App\Menu::ofType('header')->root()->active()->orderBy('sort_order')->with('children')->get() as $headerMenu)
                        <li>
                            <a href="{{ $headerMenu->url ?? '#' }}">{{ $headerMenu->name ?? 'Menu Item' }}
                                @if(count($headerMenu->children))
                                <i
                                    class="fa-regular fa-chevron-down"></i>
                                @endif

                                </a>

                               @if(count($headerMenu->children))
                            <ul class="sub-menu">
                                @foreach($headerMenu->children ?? [] as $child)
                                <li><a href="{{ $child->url ?? '#' }}">{{ $child->name ?? 'Sub Item' }}</a></li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach

                    </ul>
                </div>
                <div class="right-box">
                    <ul>
                        @foreach(\App\Menu::ofType('other')->root()->active()->orderBy('sort_order')->with('children')->get() as $headerMenu)
                        <li>
                            <a href="{{ $headerMenu->url ?? '#' }}">{{ $headerMenu->name ?? 'Menu Item' }}
                                @if(count($headerMenu->children))
                                <i class="fa-regular fa-chevron-down"></i>
                                @endif

                            </a>

                            @if(count($headerMenu->children))
                            <ul class="sub-menu">
                                @foreach($headerMenu->children ?? [] as $child)
                                <li><a href="{{ $child->url ?? '#' }}">{{ $child->name ?? 'Sub Item' }}</a></li>
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
