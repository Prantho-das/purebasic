@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="{{url('/admin/all/job')}}"></a>
                Questions</a>
              </div>
              <div class="col-md-2">
                <button class="btn btn-primary" id="add_question" style="margin-left: 50px"><i class="fas fa-plus"></i> Add Quesition</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            @if(session()->has('error'))
              <div class="p-3 mb-2 bg-danger text-white">{{session('error')}}</div>
            @endif
            @if(session()->has('success'))
              <div class="p-3 mb-2 bg-success text-white">{{session('success')}}</div>
            @endif
            @if($errors->any())
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
              </div>
            @endif
            <form action="{{url('/admin/addQuestionsToTest')}}" method="post" enctype="multipart/form-data">
              @csrf
              @php 
                $modelTestId = ($modelTest)?$modelTest->id:old('modeltest_id');
              @endphp
              <input type="hidden" name="modeltest_id" value="{{$modelTestId}}">
              
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Option 1</th>
                    <th>Option 2</th>
                    <th>Option 3</th>
                    <th>Option 4</th>
                    <th>Option 5</th>
                    <th>Right option</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="questions_table_body">
                  @if($modelTest && count($modelTest->questions)>0)
                    @foreach($modelTest->questions as $key => $ques)
                      <tr class="question_row" id="question_row_{{$key+1}}">
                        <input type="hidden" name="question_id[]" value="{{$ques->id}}">
                        <td class="first_column">{{$key+1}}</td>
                        <td><input type="text" name="question[]" class="form-control" value="{{$ques->question}}"></td>
                        <td><input type="text" name="option1[]" class="form-control" value="{{$ques->options[0]->option}}"></td>
                        <td><input type="text" name="option2[]" class="form-control" value="{{$ques->options[1]->option}}"></td>
                        <td><input type="text" name="option3[]" class="form-control" value="{{$ques->options[2]->option}}"></td>
                        <td><input type="text" name="option4[]" class="form-control" value="{{$ques->options[3]->option}}"></td>
                        <td><input type="text" name="option5[]" class="form-control" value="{{$ques->options[4]->option}}"></td>
                        <td>
                          
                          <select class="form-control" name="right_option[]">
                            <option value="1" {{ $ques->options[0]->correct_or_not == 1 ? 'selected' : ''}}>Option 1</option>
                            <option value="2" {{ $ques->options[1]->correct_or_not == 1 ? 'selected' : ''}}>Option 2</option>
                            <option value="3" {{ $ques->options[2]->correct_or_not == 1 ? 'selected' : ''}}>Option 3</option>
                            <option value="4" {{ $ques->options[3]->correct_or_not == 1 ? 'selected' : ''}}>Option 4</option>
                            <option value="5" {{ $ques->options[4]->correct_or_not == 1 ? 'selected' : ''}}>Option 5</option>
                          </select>
                        </td>
                        <td>
                          <button class="btn btn-primary remove_question" id="remove_question_'+row_number+'"><i class="fas fa-minus"></i></button>
                        </td>
                      </tr>                
                    @endforeach
                  @endif
                  @if(old('question') && count(old('question'))>0)
                    @foreach(old('question') as $key => $ques)
                      <tr class="question_row" id="question_row_{{$key+1}}">
                        <td class="first_column">{{$key+1}}</td>
                        <td><input type="text" name="question[]" class="form-control" value="{{old('question')[$key]}}"></td>
                        <td><input type="text" name="option1[]" class="form-control" value="{{old('option1')[$key]}}"></td>
                        <td><input type="text" name="option2[]" class="form-control" value="{{old('option2')[$key]}}"></td>
                        <td><input type="text" name="option3[]" class="form-control" value="{{old('option3')[$key]}}"></td>
                        <td><input type="text" name="option4[]" class="form-control" value="{{old('option4')[$key]}}"></td>
                        <td><input type="text" name="option5[]" class="form-control" value="{{old('option5')[$key]}}"></td>
                        <td>
                          @php
                            $right_option = old('right_option')[$key];
                          @endphp
                          <select class="form-control" name="right_option[]">
                            <option value="1" {{ $right_option == '1' ? 'selected' : ''}}>Option 1</option>
                            <option value="2" {{ $right_option == '2' ? 'selected' : ''}}>Option 2</option>
                            <option value="3" {{ $right_option == '3' ? 'selected' : ''}}>Option 3</option>
                            <option value="4" {{ $right_option == '4' ? 'selected' : ''}}>Option 4</option>
                            <option value="5" {{ $right_option == '5' ? 'selected' : ''}}>Option 4</option>
                          </select>
                        </td>
                        <td>
                          <button class="btn btn-primary remove_question" id="remove_question_'+row_number+'"><i class="fas fa-minus"></i></button>
                        </td>
                      </tr>                
                    @endforeach
                  @endif
                </tbody>
              </table>
              <input type="submit" name="submit" value="submit" class="btn btn-primary btn-sm">
            </form>
          </div>
          <div class="card-footer small text-muted"></div>
        </div>

      </div>

    </div>

  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<script type="text/javascript">
jQuery(document).ready(function() {
  $('#add_question').on('click',function(){
    var question_row = '';
    var row_number = $('#questions_table_body tr').length;
    row_number++;
    question_row += '<tr class="question_row" id="question_row_'+row_number+'">';
      question_row += '<td class="first_column">'+row_number+'</td>';
      question_row += '<td><input type="text" name="question[]" class="form-control"></td>';
      question_row += '<td><input type="text" name="option1[]" class="form-control"></td>';
      question_row += '<td><input type="text" name="option2[]" class="form-control"></td>';
      question_row += '<td><input type="text" name="option3[]" class="form-control"></td>';
      question_row += '<td><input type="text" name="option4[]" class="form-control"></td>';
      question_row += '<td><input type="text" name="option5[]" class="form-control"></td>';
      question_row += '<td>';
        question_row += '<select class="form-control" name="right_option[]">';
          question_row += '<option value="1">Option 1</option>';
          question_row += '<option value="2">Option 2</option>';
          question_row += '<option value="3">Option 3</option>';
          question_row += '<option value="4">Option 4</option>';
          question_row += '<option value="5">Option 5</option>';
        question_row += '</select>';
      question_row += '</td>';
      question_row += '<td>';
        question_row += '<button class="btn btn-primary remove_question" id="remove_question_'+row_number+'"><i class="fas fa-minus"></i></button>';
      question_row += '</td>';
    question_row += '</tr>';
    $('#questions_table_body').append(question_row);
  });
  $(document).on('click','.remove_question',function(){
    var row_number = $(this).attr('id').substr(16);
    $('#question_row_'+row_number).remove();
    var i = 1;
    $('.question_row').each(function(){
      $(this).attr('id','question_row_'+i);
      $(this).find('.first_column').html(i);
      $(this).find('.remove_question').attr('id','remove_question_'+i);
      i++;
    });
  });
  
  
});
  
</script>  

@endsection
  