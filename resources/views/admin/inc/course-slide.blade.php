@foreach($batchpackages as $batchPackage)
<div class="swiper-slide">
    <div class="single-slide">
        <a href="{{url('batch_details').'/'.$batchPackage->id}}"></a>
        <div class="image-box">
            <img src="{{ asset('assets/images/home/hsc.jpeg') }}" alt="icon">
        </div>
        <div class="title">{{$batchPackage->title}}</div>
        {{-- <p>Farabi Hafiz</p> --}}
        <div class="see-more">
            see details <i class="fa-classic fa-regular fa-arrow-right"></i>
        </div>
    </div>
</div>
@endforeach