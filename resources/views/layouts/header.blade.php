  {{-- header section start from here  --}}
  <section class="top-header-main">
      <div class="container ed-container-expand">
          <div class="top-header-flex">
              <div class="logo-box">
                  <a href="{{ url('/') }}">
                      <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo">
                  </a>
              </div>

              <div class="topheader-search-box">
                  <div class="category-select-box">
                      <select class="category-select wide">
                          <option value="0">All Categories</option>
                          <option value="1">Business</option>
                          <option value="2">Marketing</option>
                          <option value="3">Design</option>
                          <option value="4">Finance</option>
                          <option value="5">Lifestyle</option>
                          <option value="6">Development</option>
                          <option value="7">Photography</option>
                      </select>

                  </div>
                  <div class="topsearch-box">
                      <form action="">
                          <input type="text" placeholder="Search your courses">
                          <button class="header-search-btn">search <i class="fa-light fa-magnifying-glass"></i></button>
                      </form>
                  </div>
              </div>
              <div class="topbar-info">
                  <div class="topbar-social-link">
                      <ul>
                          <li>
                              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                          </li>
                          <li>
                              <a href="#"><i class="fa-brands fa-twitter"></i></a>
                          </li>
                          <li>
                              <a href="#"><i class="fa-brands fa-instagram"></i></a>
                          </li>
                          <li>
                              <a href="#"><i class="fa-brands fa-youtube"></i></a>
                          </li>
                      </ul>
                  </div>
                  <div class="topbar-buttons">
                      <button type="button" class="register-btn">Register</button>
                      <button type="button" class="login-btn">Log In</button>
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
                          <li>
                              <a href="#">class 6-12 <i class="fa-regular fa-chevron-down"></i></a>
                              <ul class="sub-menu">
                                  <li><a href="#">Home One</a></li>
                                  <li><a href="#">Home Two</a></li>
                              </ul>
                          </li>
                          <li>
                              <a href="#">skills <i class="fa-regular fa-chevron-down"></i></a>
                              <ul class="sub-menu">
                                  <li><a href="#">Skill one</a></li>
                                  <li><a href="#">Skill Two</a></li>
                              </ul>
                          </li>
                          <li>
                              <a href="#">admission</a>
                          </li>
                          <li>
                              <a href="#">online batch <i class="fa-regular fa-chevron-down"></i></a>
                              <ul class="sub-menu">
                                  <li><a href="#">batch one</a></li>
                                  <li><a href="#">batch Two</a></li>
                              </ul>
                          </li>
                      </ul>
                  </div>
                  <div class="right-box">
                      <ul>
                          <li>
                              <a href="#">notices</a>
                          </li>
                          <li>
                              <a href="#">Book store</a>
                          </li>
                          <li>
                              <a href="#">contact</a>
                          </li>

                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </header>
  {{-- header section ends here --}}
