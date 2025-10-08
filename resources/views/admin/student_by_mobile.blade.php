@extends('layouts.admin')
@section('content')


    <div class="container">
    
            <div class="row" style="margin:3rem 1rem;">
                

                <div>
                    
                    <form name="searchForm" id="searchForm" action="{{url('/admin/findUserByMobile/')}}" method="post">
                        @csrf
                    

                        
                        <div>
                            <label for="mobile">Find By Mobile Number : </label>
                            <input name="mobile" id="mobile" type="text" style="margin: 1.5rem 0rem;">
                        </div>
                        
                        
                        <button type="submit" class="submitButton">
                            Search
                        </button>
                        
                    </form>
                    

                </div>
                
                


            <div>


    </div>
    

<script>

    var searchForm = document.getElementById('searchForm');
    searchForm.onsubmit = function(){
        let mobile = document.getElementById('mobile');
        let newValue = mobile.value.replace(/\D/g,'');
        newValue = newValue.replace(/^(880)/,"");
        newValue = parseInt(newValue);
        mobile.value = newValue;
        searchForm.submit();
    };

</script>
                

@endsection

