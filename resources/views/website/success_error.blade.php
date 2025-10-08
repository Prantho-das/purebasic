@if(Session::has('error'))
    <section style="background: #fff;margin-top:80px">
    <div class="alert alert-danger text-center" role="alert">
      {{ session::get('error') }}
    </div>
    </section>
@endif

@if(Session::has('success'))

    <section style="background: #fff;margin-top:80px">
            <div class="alert alert-success text-center" role="alert">
                {{ session::get('success') }}</div>

    </section>
@endif
