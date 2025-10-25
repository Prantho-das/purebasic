    {{-- footer section start from here --}}
    <footer>

        <div class="main-footer">
            <div class="footer-shape-style-one">
                <img src="{{ asset('assets/images/icons/2-light.png') }}" alt="author-1.webp">
            </div>
            <div class="container ed-container-expand">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                        <div class="first-box-wrapper">
                            <div class="logo-box">
                                <a href="#">
                                    @php
                                    $logo=get_business_setting('site_logo');
                                    @endphp
                                    @if ($logo)
                                    <img src="{{ asset('storage/' . $logo) }}" alt="logo">
                                    @else
                                    <img src="{{ asset('assets/images/logo-light.png') }}" alt="logo">
                                    @endif

                                </a>
                            </div>
                            <div class="logo-description">
                                <p>
                                    {{ get_business_setting('site_description') }}
                                </p>
                            </div>
                            <div class="logo-contact">
                                <ul class="contact-list-two">
                                    @php
                                    $phone=get_business_setting('site_phone');
                                    $email=get_business_setting('site_email');
                                    @endphp


@if($phone)

                                    <li>
                                        <div class="icon">
                                            <i class="fa-light fa-phone"></i>
                                        </div>
                                        <div class="info">
                                            <h5><a href="tel:{{ $phone }}">{{ $phone }}</a></h5>
                                        </div>
                                    </li>
                                    @endif

                                    @if($email)
                                    <li>
                                        <div class="icon">
                                            <i class="fa-light fa-envelope"></i>
                                        </div>
                                        <div class="info">
                                            <h5>
                                                <a href="mailto:{{ $email }}">{{ $email }}</a>
                                            </h5>
                                        </div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                    </div>

                    @foreach(\App\Menu::ofType('footer')->root()->active()->orderBy('sort_order')->with('children')->get() as $headerMenu)
                    <div class="col-lg-2 col-md-6">
                        <div class="f-item link">
                            <h4 class="widget-title">{{ $headerMenu->name }}</h4>
                            @if(count($headerMenu->children))
                            <ul>
                                @foreach($headerMenu->children ?? [] as $child)
                                <li>
                                    <a href="{{ $child->url ?? '#' }}">{{ $child->name ?? 'Sub Item' }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="f-item newsletter">
                            <h4 class="widget-title">Join Our Newsletter</h4>
                            <p>
                                Join our subscribers list to get the latest <br> news and special offers.
                            </p>
                            <form action="#">
                                <input type="email" placeholder="Your Email" class="form-control" name="email">
                                <button type="submit">Subscribe</button>
                            </form>
                            <fieldset>
                                <input type="checkbox" id="privacy" name="privacy">
                                <label for="privacy">I agree to the Privacy Policy</label>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <p>© Copyright <span id="year"></span>. All Rights Reserved by <a
                                href="#">Purebasic.com.bd</a></p>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    {{-- footer section Ends here --}}
