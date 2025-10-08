@extends('layouts.admin')
@section('content')


    <div class="container">
    
            <div class="row" style="margin:3rem 1rem;">
                

                <div>
                    
                    <form action="{{url('/admin/findUserByName/')}}" method="post">
                        @csrf
                    

                        
                        <div>
                            <label for="name">Find By Name : </label>
                            <input style="margin: 1.5rem 0rem;" name="name" type="text">
                        </div>
                        
                        
                        <button type="submit" class="submitButton">
                            Search
                        </button>
                        
                    </form>
                    

                </div>
                
                


            <div>


    </div>
    


</script>
                

@endsection

