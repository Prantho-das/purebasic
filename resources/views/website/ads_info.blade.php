@extends('layouts.website')
@section('content')
<!-- Post Section Start -->
<div class="post-section section pt-30">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="ads_info">
               <h2 class="text-left">আপনি কি এডস দিতে চান</h2>

               <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
               <ul>
                  <li>1 day - 500</li>
                  <li>1 day - 500</li>
                  <li>1 day - 500</li>
                  <li>1 day - 500</li>
                  <li>1 day - 500</li>
                  <li>1 day - 500</li>
                  <li>1 day - 500</li>
                  <li>1 day - 500</li>
                  <li>1 day - 500</li>
               </ul>

               @php
                $id = Session:: get('id');
                $visitor = App\Visitor:: where('id',$id)->first();
              @endphp
              @if($visitor)
               <a href="{{url('create-ads')}}" class="btn btn-primary">বিজ্ঞাপন দিন</a>
               @else
               <a href="{{url('user/login')}}" class="btn btn-primary">Login First</a>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
@endsection