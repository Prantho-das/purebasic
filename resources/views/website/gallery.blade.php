@extends('layouts.website')
@push('theme')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
@endpush
@section('content')
<section class="gallery-block grid-gallery">
            <div class="container">
                <div class="heading">
                    <h2>Photo Gallery</h2>
                </div>
                <div class="row">
                    @foreach($allphotos as $data)
                    <div class="col-md-6 col-lg-4 item">
                        <a class="lightbox" href="{{asset('uploads/gallery/'.$data->photo)}}">
                            <img class="img-fluid image scale-on-hover" src="{{asset('uploads/gallery/'.$data->photo)}}" style="width: 370px;">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
@endsection
@push('cs_js')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
        <script>
            baguetteBox.run('.grid-gallery', { animation: 'slideIn'});
        </script>
@endpush
