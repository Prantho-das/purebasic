@extends('layouts.register')
@section('content')

    
    <div class="row container">
        <div class="col-4">&nbsp</div>
        <div class="col-4">
    
            <form action="{{url('updateInfo/' . $userId . '/' . $type . '/' . $id)}}" method="post" enctype="multipart/form-data" class="submitForm">
                @csrf
                

                <div class="marginAbove marginBelow">
                    

                        @if (empty($student->name))
                            <div>
                                <label><b>Enter Your Name As Per NID OR BMDC OR Any Certificate : </b></label>
                                <input class="marginAbove marginBelow" type="text" name="name" placeholder="Name" required />
                            </div>
                        @endif
                
                        @if (empty($student->mobile))
                            <div>
                                <label><b>Enter Your Valid Phone Number : </b></label>
                                <input class="marginAbove marginBelow" type="number" name="phone_number" placeholder="Phone Number" required />
                            </div>
                        @endif
        
                        @if (empty($student->email))        
                            <div>
                                <label><b>Enter Your Valid E-mail Address : </b></label>
                                <input class="marginAbove marginBelow" type="email" name="email" placeholder="E-mail" required />
                            </div>
                        @endif
                        
                        @if (empty($student->password))        
                            <div>
                                <label><b>Enter A Password : </b></label>
                                <input class="marginAbove marginBelow" type="password" name="password" placeholder="Password" required />
                            </div>
                            
                            
                        @endif

                        @if ($type != "case" && $courier == 1)        
                            <div>
                                <label><b>Enter Address Of Your Nearest <span style="color:red";>Sundarban Courier Service </span> Counter Or Keep It Blank If You Do Not Want Lecture Notes..</b></label>
                                <input class="marginAbove marginBelow" type="text" name="address" placeholder="Address To Deliver Books If Needed" required />
                            </div>
                            
                            
                        @endif                        

                        <div>
                            <label><b>Enter Your WhatsApp Number & Click "Submit" button: </b></label>
                            <input class="marginAbove marginBelow" type="text" name="whatsapp_number" placeholder="WhatsApp Number" required />
                        </div>
                            
                            

                </div>
                
    

    
                <button type="submit" class="submitButton">
                    <h3>Submit</h3>
                </button>
            </form>
    
        </div>
    </div>

@endsection
