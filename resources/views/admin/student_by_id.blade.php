@extends('layouts.admin')
@section('content')


    <div class="container">
    
            <div class="row" style="margin:3rem 1rem;">
                


                    <form action="{{url('/admin/findUserById/')}}" method="post">
                        @csrf
                    

                        
                        <div>
                            <label for="id">Find By Pure Basic Id : </label>
                            <input style="margin: 1.5rem 0rem;" name="id" type="number">
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

