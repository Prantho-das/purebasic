@extends('layouts.website')
@section('content')

    <!-- Post Section Start -->
    <div class="post-section section pt-30">
        <div class="container">
          <!-- Row post1 Start -->
            <div class="row">
                <!-- Col-9 Start -->
                <div class="col-lg-8 co-md-8 col-12 mb-30"> 
                    <div class="signup_area p-3 bg-white">
                      <div class="signup-top">
                      <div class="signup-row">
                        <div class="signup-left">
                          <div class="signup-content text-center">
                            <h2>Signup Here!</h2>
                          </div>
                        </div>
                        
                      </div>
                      <!-- <div class="signup-header-text text-center mb-30">
                        <p>Signup with social media!</p>
                      </div> -->
                    </div><!-- End signup-top-->
                    <div class="signup-wrap">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12 mb-30">
                               <div class="signup-area">
                                  <div id="wrapper">
                                        <br>
                                        <div class="progres-bar-top mb-20">
                                            <div class="form-progress">
                                            <span class='baricon'>1</span>
                                            <span id="bar1" class='progress_bar'></span>
                                            <span class='baricon'>2</span>
                                            <span id="bar2" class='progress_bar'></span>
                                            <span class='baricon'>3</span>
                                          </div>
                                          <div class="form-progress-info">
                                            <span class="single-col-name pos-1">Basic Info</span>
                                            <span class="single-col-name pos-2">Basic Info</span>
                                            <span class="single-col-name pos-3">Basic Info</span>
                                          </div>
                                        </div>
                                        <div class="log-with-social">
                                          <div class="d-flex justify-content-between p-5 m-padding">
                
                                          </div>
                                        </div>
                                        <form method="post" action="{{url('visitor/bio/submit')}}" enctype="multipart/form-data">
                                          @csrf
                                          <div id="account_details">
                                              <input type="hidden" name="id" value="{{$user->id}}"> 

                                              <div class="post-comment-form row mb-15">
                                                  <div class="col-md-1 col-sm-1 col-m1{{ $errors->has('fullname') ? ' is-invalid' : '' }}">
                                                      <div class="inline-left">
                                                          <label for="fullname"><i class="fa fa-user"></i></label>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-11 col-sm-11 col-m11">
                                                      <input type="text" name="fullname" placeholder="Full Name" value="{{old('fullname')}}"> 
                                                      @if ($errors->has('fullname'))
                                                      <span class="invalid-feedback" role="alert" style="display: initial;">
                                                        <strong>{{ $errors->first('fullname') }}</strong>
                                                     </span> 
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="post-comment-form row mb-15">
                                                  <div class="col-md-1 col-sm-1 col-m1">
                                                      <div class="inline-left">
                                                          <label for="hometown"><i class="fa fa-home"></i></label>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-11 col-sm-11 col-m11">
                                                      <input type="text" name="hometown" placeholder="Home Town"> 
                                                  </div>
                                              </div>

                                              <div class="post-comment-form row mb-15">
                                                  <div class="col-md-1 col-sm-1 col-m1{{ $errors->has('shortbio') ? ' is-invalid' : '' }}">
                                                      <div class="inline-left">
                                                          <label for="shortbio"><i class="fa fa-pencil"></i></label>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-11 col-sm-11 col-m11">
                                                      <input type="text" name="shortbio" placeholder="Short Bio" value="{{old('shortbio')}}"> 
                                                      @if ($errors->has('shortbio'))
                                                      <span class="invalid-feedback" role="alert" style="display: initial;">
                                                        <strong>{{ $errors->first('shortbio') }}</strong>
                                                     </span> 
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="post-comment-form row mb-15">
                                                  <div class="col-md-1 col-sm-1 col-m1{{ $errors->has('cell') ? ' is-invalid' : '' }}">
                                                      <div class="inline-left">
                                                          <label for="cell"><i class="fa fa-phone"></i></label>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-11 col-sm-11 col-m11">
                                                      <input type="text" name="cell" placeholder="Cell (Bkash)" value="{{old('cell')}}"> 
                                                      @if ($errors->has('cell'))
                                                      <span class="invalid-feedback" role="alert" style="display: initial;">
                                                        <strong>{{ $errors->first('cell') }}</strong>
                                                     </span> 
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="post-comment-form row mb-15">
                                                  <div class="col-md-1 col-sm-1 col-m1{{ $errors->has('photo') ? ' is-invalid' : '' }}">
                                                      <div class="inline-left">
                                                          <label for="photo"><i class="fa fa-picture-o"></i></label>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-11 col-sm-11 col-m11">
                                                      <input type="file" name="photo" value="photo"> 
                                                      @if ($errors->has('photo'))
                                                      <span class="invalid-feedback" role="alert" style="display: initial;">
                                                        <strong>{{ $errors->first('photo') }}</strong>
                                                     </span> 
                                                      @endif
                                                  </div>
                                              </div>


                                              <button type="submit" class="btn btn-primary">Submit</button>
                                          </div>
                                      </form>
                                </div><!-- End Wrapper -->
                               </div><!-- Signup End -->

                                
                            </div><!-- Col-6 End -->
                        </div><!-- Row End -->
                    </div><!-- Writers End -->
                    </div><!--end signup-area -->
                </div><!-- Col-9 End -->

                <!-- Col-3 Start -->
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="right-bar signup-accordian p-3 bg-white">
                      
                       <div id="accordion" class="accordion">
                       <div class="faq-head mb-10 text-center">
                        <h3>কেন সাইন আপ করবেন?</h3>
                      </div>
                          <div class="acc-body">
                              <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
                                  <a class="card-title">
                                      Why Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry?
                                  </a>
                              </div>
                              <div id="collapseOne" class="card-body collapse" data-parent="#accordion" >
                                  <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                      aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                      craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                  </p>
                              </div>
                              <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                  <a class="card-title">
                                    Are you Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry?
                                  </a>
                              </div>
                              <div id="collapseTwo" class="card-body collapse" data-parent="#accordion" >
                                  <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                      aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                      craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                  </p>
                              </div>
                              <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                  <a class="card-title">
                                    Are you Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry?
                                  </a>
                              </div>
                              <div id="collapseThree" class="collapse" data-parent="#accordion" >
                                  <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                      aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS.
                                  </div>
                              </div>
                          </div>
                      </div>

                    </div><!-- Signup Accordin End -->
                    
                </div> <!-- Col-lg-3 End -->
                
            </div><!--Row post1 End-->
        </div><!-- Container End -->
    </div><!-- Post Section End -->


@endsection



