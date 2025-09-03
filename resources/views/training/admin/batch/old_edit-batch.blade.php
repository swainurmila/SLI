@extends('training.admin.layouts.page-layouts.main')

@section('content')
    
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title-left">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">Training</li>
                            <li class="breadcrumb-item active text-custom-primary">Create New Training</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <h4 class="card-title mb-4">Add New Training</h4>
                            <a href="{{URL::previous()}}" class="btn ms-auto btn-sm btn-dark"><i class="fas fa-arrow-left" style="margin-right: 9px;margin-top:10px"></i>Back</a>
                        </div>
                        
                <form action="{{ route('training.editTrainingstore', ['id' => $training_datas->id]) }}" method="POST" id="book_save" enctype="multipart/form-data">
                    {{ csrf_field() }}
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="">Training Name</label>
                                        <input type="text" class="form-control form-valid" name="name" id="name" value="{{$training_datas->name}}" placeholder="">
                                    </div>
                                </div>
                               
                                
                                
                                                                                            
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Training Category</label>
                                        <select class="form-select form-valid" name="training_category_id" id="training_category_id">
                                            <option value="">Select</option>
                                            
                                            @foreach($tr_categores as $tr_category)

                                            <option <?php if($training_datas->training_category_id == $tr_category->id ){echo "selected"; }?>  value="{{$tr_category->id}}">{{$tr_category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="">Training Place</label>
                                        <select class="form-select form-valid" name="training_place_id" id="training_place_id">
                                            <option value="">Select</option>
                                            @foreach($tr_training_places as $tr_train_place)

                                            <option <?php if($training_datas->training_place_id == $tr_train_place->id ){echo "selected"; }?> value="{{$tr_train_place->id}}">{{$tr_train_place->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="">Training Duration Type</label>
                                            <select class="form-select form-valid" name="training_duration_type" id="training_duration_type">
                                                <option   value="">Select</option>
                                                <option <?php if($training_datas->training_duration_type == 'Day' ){echo "selected"; }?>  value="Day">Day</option>
                                                <option <?php if($training_datas->training_duration_type == 'Week' ){echo "selected"; }?>  value="Week">Week</option>
                                                <option <?php if($training_datas->training_duration_type == 'Month' ){echo "selected"; }?>  value="Month">Month</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                                <label class="form-label" for="">Training Duration</label>
                                                <input type="text" class="form-control form-valid number-validation" value="{{$training_datas->training_duration}}" name="training_duration" id="training_duration" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                 
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Payment Type</label>
                                                <select class="form-select form-valid" name="payment_type" id="payment_type">
                                                    <option value="">Select</option>
                                                    <option <?php if($training_datas->payment_type == '0' ){echo "selected"; }?>  value="0">Free</option>
                                                    <option <?php if($training_datas->payment_type == '1' ){echo "selected"; }?>  value="1">Paid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 training_price">
                                                <label class="form-label" for="">Training Price</label>
                                                <input type="text" class="form-control form-valid price-validation" value="{{$training_datas->price}}" name="price" id="price" placeholder="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Training Type</label>
                                        <select class="form-select form-valid" name="training_type" id="training_type">
                                            <option value="">Select</option>
                                            <option <?php if($training_datas->training_type == '0' ){echo "selected"; }?>  value="0">Training with Certificate</option>
                                            <option <?php if($training_datas->training_type == '1' ){echo "selected"; }?>  value="1"> Training without Certificate</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                
                                
                                
                                
                                
                                

                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Language</label>
                                        <select class="form-select form-valid" name="language_id" id="language_id">
                                            <option value="">Select</option>
                                            @foreach($languages as $lan)
                                            <option <?php if($training_datas->language_id == $lan->id ){echo "selected"; }?>  value="{{$lan->id}}">{{$lan->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input class="form-control form-valid"  type="file" name="book_image[]" value="" multiple>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="">Training Description</label>
                                        <textarea class="form-control form-valid" name="description" id="description" name="" id="" cols="20" rows="10">{{$training_datas->description}}</textarea>
                                    </div>
                                </div> 
                                
                                
                            </div>
                            
                            <input class="form-control" type="hidden" value="0" id="total_id">
                            <div id="add_mul_loc">
                            <div class="mb-3 row mt-5" id="" >
                                <h5 class=" text-custom-primary">Create Batch</h5>
                                <div class="col-sm-12 col-lg-2">
                                    <label for="" class="col-form-label">Batch Name</label>
                                    <input class="form-control" type="text" value="" name="batch_name" id="batch_name">
                                </div>
                                <div class="col-sm-12 col-lg-2">
                                    <label for="" class="col-form-label">Start Time</label>
                                    <input class="form-control" type="time" value="" name="start_time" id="start_time">
                                </div>
                                <div class="col-sm-12 col-lg-2">
                                    <label for="" class="col-form-label">End Time</label>
                                    <input class="form-control" type="time" value="" id="end_time" name="end_time">
                                </div>
                                <div class="col-sm-12 col-lg-2">
                                    <label for="" class="col-form-label">Max Student</label>
                                    <input class="form-control check_res number-validation"  type="text" value="" id="max_student" name="max_student0">
                                </div>
                                <div class="col-sm-12 col-lg-2">
                                    <label for="" class="col-form-label">Total Class</label>
                                    <input class="form-control check_res number-validation"  type="text" value="" id="total_class" name="total_class0">
                                </div>
                                <div class="col-sm-12 col-lg-2">
                                    <div class="text-center pt-4 mt-3"> 
                                        <a  class="btn custom-btn btn-sm" id="add_reg" >Add Batch<span><i class="uil-plus-circle ms-2"></i></span></a>
                                                    
                                    </div>
                                </div>
                            </div> 
                            
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <table class="table table-sm m-0 table-bordered">
                                        <thead class="">
                                            <tr class="table-heading text-center">
                                                <th>Batch Name</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Max Student</th>
                                                <th>Total Class</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php 
                                        $i=0;
                                        ?>
                                        <tbody class="addmedIsssue" id="addmedIsssue">
                                             @foreach($batch_datas as $batch_data)
                                             
                                            <tr class="table-heading text-center" id="clild_id{{$i}}">
                                                <td>
                                                    <input class="form-control form-valid" type="hidden" value="{{$batch_data->id}}" name="batch_id[]" id="batch_id{{$i}}">

                                                    <input class="form-control form-valid" type="text" value="{{$batch_data->batch_name}}" name="batch_name[]" id="batch_name{{$i}}"></td>
                                                <td>
                                                    <input class="form-control form-valid" type="text" value="{{$batch_data->start_time}}" name="start_time[]" id="start_time{{$i}}"></td><td><input class="form-control form-valid" type="text" value="{{$batch_data->end_time}}" name="end_time[]" id="end_time{{$i}}"></td>
                                                    <td><input class="form-control form-valid check_res" type="text" value="{{$batch_data->max_student}}" name="max_student[]" id="max_student{{$i}}"></td>
                                                    <td><input class="form-control form-valid check_res" type="text" value="{{$batch_data->total_class}}" name="total_class[]" id="total_class{{$i}}"></td>
                                                    <td>
                                                        <?php
                                                        // $count_data
                                                        
                                                        $count_data =App\Models\Training\TrTrainingOrder::where("batch_id",$batch_data->id)->count() ;
                                                        ?>
                                                        @if($count_data == 0)
                                                        <a onclick="removeDataLocation(0,{{$i}})" class="btn btn-danger btn-sm mt-1">Remove Batch<span><i class="uil-times-circle ms-2"></i></span></a>
                                                        @endif
                                                    
                                                    </td></tr>
                                                    <?php
                                             $i++; 
                                             ?>
                                                    @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <button type="button" onclick="saveForm()" class="btn custom-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
     </div>  
</div>
 
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>

        $(document).ready(function(){

            
            if($('#payment_type').val() != '0'){
                $(".training_price").show();
            }else{
                $(".training_price").hide();
            }
            


            $('#payment_type').change(function(){
                let payment_type = $(this).val();
                if(payment_type === '0'){
                    $(".training_price").hide();
                }else{
                    $(".training_price").show();
                }
            })
        });
        function saveForm() {
            var errcount = 0;
            $(".error-span").remove();

            $("span").remove();



            $('.form-valid').each(function() {
                if ($(this).val() == '') {
                    
                    errcount++;
                    $(this).addClass('error-text');
                    $(this).removeClass('success-text');
                    $(this).after('<span style="color:red">This field is required</span>');

                    if($('#payment_type').val() == '0'){
                        errcount--;
                    }
                } else {
                    $(this).removeClass('error-text');
                    $(this).addClass('success-text');
                }
            });
            // alert(errcount);
            if (errcount == 0) {
                // $.blockUI({ message: '<h1> Loading...</h1>' });

                $('#book_save').submit();
                // $.unblockUI();         
            } else {
                return false;
            }
        }
        function checkRegAjax(val){
            //alert(123);
            var state_id = this.value;
            //alert(state_id);
            
            $.ajax({
                    type: 'post',
                    url: "{{ route('book.bookRegCheck') }}",
                    data: {
                        max_student: val,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        
                        console.log(result);
                        console.log(result.location_count);
                        if(result.location_count == 1){
                            errcount++;
                            alert("inside")
                        }
                         
                    }
                });
                return result.location_count;

        }
        function ckeckreg(val){
            
            var errcount = 0;
            
            $('.check_res').each(function() {
                if ($(this).val() == val) {
                    errcount++;
                    
                     
                }
                
            });
            // var result_ajax = checkRegAjax(val);
            // alert(result_ajax);


            // alert("outside")
            if (errcount > 1) {
                alert("alredy exiting");
                $(this).val('')
            }
        }
        function saveFormedit(e) {
            var errcount = 0;
            $(".error-span" + e).remove();

            $("span" + e).remove();
            $('.form-valid' + e).each(function() {
                if ($(this).val() == '') {
                    errcount++;
                    $(this).addClass('error-text' + e);
                    $(this).removeClass('success-text' + e);
                    $(this).after('<span style="color:red">This field is required</span>');
                } else {
                    $(this).removeClass('error-text' + e);
                    $(this).addClass('success-text' + e);
                }
            });
            // alert(errcount);
            if (errcount == 0) {
                // $.blockUI({ message: '<h1> Loading...</h1>' });

                $('#book_edit' + e).submit();
                // $.unblockUI();         
            } else {
                return false;
            }
        }
        $('.year').blur(function() {
            //   alert($(this).val());
            var yearInput = $(this).val();
            // $("#publish_year").val();
            var enteredYear = parseInt(yearInput, 10);

            // Get the current year
            var currentYear = new Date().getFullYear();

            // Check if the entered year is within the valid range
            if (enteredYear >= 1900 && enteredYear <= currentYear) {
                // Display a success message or take appropriate action
                console.log('Year is valid');
            } else {
                // Display an error message or take appropriate action
                alert('Please enter a valid year between 1900 and ' + currentYear);
                // $("#publish_year").val('')
                $(this).val('')
            }

        });
        $('.number-validation').blur(function() {
            var inputValue = $(this).val()
            var regex = /^[0-9]+$/;

            // Test the input against the regular expression
            if (regex.test(inputValue)) {

            } else {
                $(this).val('')
                alert('Please enter only numbers')
            }

        });

        $('.price-validation').blur(function() {
            var inputValue = $(this).val();
            // Use a regular expression to allow both integers and decimal numbers
            var regex = /^-?\d*\.?\d+$/;

            // Test the input against the regular expression
            if (regex.test(inputValue)) {
                // The input is a valid number or decimal
            } else {
                // Clear the input value
                $(this).val('');
                alert('Please enter only numbers or decimals');
            }
        });
        
        $("#add_reg").on("click", function () {
             
             // alert("fff");
             var counter = $('#total_id').val();
             var batch_name =  $('#batch_name').val();
             var start_time =  $('#start_time').val();
             var end_time =  $('#end_time').val();
 
             var max_student =  $('#max_student').val();

             var total_class =  $('#total_class').val();
              
             
             if(batch_name == '' || start_time =='' || end_time == '' || max_student == '' || total_class == ''){
                 alert('please fill the data')
                 return false
                 
             }
             
            
              var last_counter = parseInt(counter)+1;
              cols = '<tr class="table-heading text-center" id="clild_id'+counter+'"><td><input class="form-control form-valid" type="hidden" value="0" name="batch_id[]" id="batch_id'+counter+'"><input class="form-control form-valid" type="text" value="'+batch_name+'" name="batch_name[]" id="batch_name'+counter+'"></td><td><input class="form-control form-valid" type="text" value="'+start_time+'" name="start_time[]" id="start_time'+counter+'"></td><td><input class="form-control form-valid" type="text" value="'+end_time+'" name="end_time[]" id="end_time'+counter+'"></td><td><input class="form-control form-valid check_res"  type="text" value="'+max_student+'" name="max_student[]" id="max_student'+counter+'"></td><td><input class="form-control form-valid check_res"  type="text" value="'+total_class+'" name="total_class[]" id="total_class'+counter+'"></td><td><a onclick="removeDataLocation(0,'+counter+')" class="btn btn-danger btn-sm mt-1">Remove Batch<span><i class="uil-times-circle ms-2"></i></span></a></td></tr>';
             $("#addmedIsssue").append(cols);
              
             $('#total_id').val(parseInt(last_counter));
             
  
         });
         function removeDataLocation(id,model){
              var userConfirmation = confirm('Are you sure you want to delete?');
                
                if (userConfirmation) {
                    
               
		 				$("#clild_id"+model).remove();
                     } 
		  
	}

    
     </script>
@endsection
