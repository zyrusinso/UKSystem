@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="" style="display: flex; justify-content: space-between;"><h3 >EDIT ORDER REQUEST</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4"> 
                        <form  action="/normal_gifting/{{ $normalData->id }}" method="post" id="updateForm">
                        @csrf
                        @method('PATCH')
                        <div>
                        
                            <label for="exampleInputBorderWidth2">Name</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="name" id="name" value="{{ $normalData->name }}" placeholder="e.g: John Doe">
                            <span class="text-danger error-text" id="name_error"></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">Name of Skin</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="name_of_skin" id="name_of_skin"value="{{ $normalData->name_of_skin }}" placeholder="ex: 100">
                            <span class="text-danger error-text" id="name_of_skin_error"></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">Type of Skin</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="type_of_skin" id="type_of_skin" value="{{ $normalData->type_of_skin }}" placeholder="ex: 100">
                            <span class="text-danger error-text" id="type_of_skin_error"></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-6">
                                <label for="exampleInputBorderWidth2">Status</label>
                                
                            </div>
                            <div class="col-6">
                                <label for="exampleInputBorderWidth2">Follow Status</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                    <select class="btn btn-default dropdown-toggle" name="status">
                                        <div class="dropdown-menu">
                                            <?php 
                                                echo '<option class="dropdown-item" value="Done"'.(($normalData->status == "Done") ? "selected" : ""). '>Done</option>';
                                                echo '<option class="dropdown-item" value="Pending"'.(($normalData->status == "Pending") ? "selected" : ""). '>Pending</option>';
                                                echo '<option class="dropdown-item" value="Cancel"'.(($normalData->status == "Cancel") ? "selected" : ""). '>Cancel</option>';
                                            ?>
                                        </div>
                                    </select>   
                            </div>
                            <div class="col-6">
                                <select class="btn btn-default dropdown-toggle" name="follow_status">
                                    <div class="dropdown-menu">
                                        <?php 
                                            echo '<option class="dropdown-item" value="Done"'.(($normalData->follow_status == "Done") ? "selected" : ""). '>Done</option>';
                                            echo '<option class="dropdown-item" value="Pending"'.(($normalData->follow_status == "Pending") ? "selected" : ""). '>Pending</option>';
                                            echo '<option class="dropdown-item" value="Cancel"'.(($normalData->follow_status == "Cancel") ? "selected" : ""). '>Cancel</option>';
                                        ?>
                                    </div>
                                </select>   
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">ML to Follow</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="ml_to_follow" id="ml_to_follow" value="{{ $normalData->ml_to_follow }}" placeholder="ex: 123456789(1234)">
                            <span class="text-danger error-text " id="ml_to_follow_error"></span>
                        </div>
                    </div>
                    
                    <div class="col-4">     
                        
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">Schedule</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="schedule" id="schedule" value="{{ $normalData->schedule }}" placeholder="e.g: jOhnD0e#123">
                            <span class="text-danger error-text " id="schedule_error"></span>
                        </div>
                    </div>
                    <div class="col-4">     
                        
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">Payment</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="payment" id="payment" value="{{ $normalData->payment }}" placeholder="e.g: jOhnD0e#123">
                            <span class="text-danger error-text " id="payment_error"></span>
                        </div>
                    </div>

                    <div class="col-4"> 
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">Reference</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="ref" id="ref" value="{{ $normalData->ref }}" placeholder="ex: Filter Dupli">
                            <span class="text-danger error-text " id="ref_error"></span>
                        </div>
                        
                    </div>

                    <div class="col-4"> 
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">Payment Method</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="payment_method" id="payment_method" value="{{ $normalData->payment_method }}" placeholder="ex: Drop Down">
                            <span class="text-danger error-text " id="payment_method_error"></span>
                        </div>
                    
                    </div>
                    <div class="col-4 ">
                    
                </div>
            </div>
                <div class="text-center mb-2 mt-2">
                    <input type="submit" value="submit" id="addSubmitBTN" class="btn btn-lg btn-success py-0" style=" width: 94px;">
                </div>
            </form>
            
        </div>

        <div class="card">
            <div class="card-header">
                <div class="" style="display: flex; justify-content: space-between;"><h3 >HISTORY</h3>
            </div>
                
            </div>
            <!-- /.card-header -->
            
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover table-sm" >
                <?php 
                    if(!Auth::user()->isAdmin()){
                        echo "<col><col><col><col><col><col style='visibility:collapse;'><col><col><col><col><col><col style='visibility:collapse;'>";
                    }
                ?>
                <thead>
                    <tr >
                        <th>Date</th>
                        <th>Request By</th>
                        <th>Name</th>
                        <th>Name Of Skin</th>
                        <th>Type Of Skin</th>
                        <th>Status</th>
                        <th>ML to Follow</th>
                        <th>Follow Status</th>
                        <th>Schedule</th>
                        <th>Payment</th>
                        <th>Reference</th>
                        <th>Payment Method</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr>
                    @foreach($normalHistories as $normalHistory)
                        <td>{{ $normalHistory->created_at }}</td>
                        <td>{{ $normalHistory->request_by }}</td>
                        <td>{{ $normalHistory->name }}</td>
                        <td>{{ $normalHistory->name_of_skin }}</td>
                        <td>{{ $normalHistory->type_of_skin }}</td>
                        <td style="
                        <?php 
                            if($normalHistory->status == 'Pending'){echo 'background-color: #ff0000; color: white;';}
                            if($normalHistory->status == 'Done'){echo 'background-color: green; color: white;';}
                            if($normalHistory->status == 'Cancel'){echo 'background-color: black; color: white;';}
                        ?>">
                            {{ $normalHistory->status }}</td>
                        <td>{{ $normalHistory->ml_to_follow }}</td>
                        <td style="
                        <?php 
                            if($normalHistory->follow_status == 'Pending'){echo 'background-color: #ff0000; color: white;';}
                            if($normalHistory->follow_status == 'Done'){echo 'background-color: green; color: white;';}
                            if($normalHistory->follow_status == 'Cancel'){echo 'background-color: black; color: white;';}
                        ?>">
                            {{ $normalHistory->follow_status }}</td>
                        <td>{{ $normalHistory->schedule }}</td>
                        <td>{{ $normalHistory->payment }}</td>
                        <td>{{ $normalHistory->ref }}</td>
                        <td>{{ $normalHistory->payment_method }}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
                </table>
                
            </div>
            <!-- /.card-body -->
            
        </div>
                
            
    </div>
</section>

<script src="/admin-lte/plugins/sweetalert2\sweetalert2.all.min.js"></script>
<script>
$(function(){
    
    
    
    $('#updateForm').on('submit', function(e) {
        var $form = $( this );
        
        $( '#name_error' ).html( "" );
        $( '#name_of_skin_error' ).html( "" );
        $( '#type_of_skin_error' ).html( "");
        $( '#ml_to_follow_error' ).html("");
        $( '#schedule_error' ).html("");
        $( '#payment_error' ).html("");
        $( '#ref_error' ).html("");
        $( '#payment_method_error' ).html("");

        e.preventDefault();

        $.ajax({
            url: "/normal_gifting/<?=$normalData->id?>",
            dataType: "json",
            type: "PATCH",
            data: $form.serialize(),
            success: function(data){
                if(data.error){
                    if(data.error.name){
                        $( '#name_error' ).html( data.error.name[0] );
                    }
                    if(data.error.name_of_skin){
                        $( '#name_of_skin_error' ).html( data.error.order[0] );
                    }
                    if(data.error.type_of_skin){
                        $( '#type_of_skin_error' ).html( data.error.type_of_skin[0] );
                    }
                    if(data.error.ml_to_follow){
                        $( '#ml_to_follow_error' ).html( data.error.ml_to_follow[0] );
                    }
                    if(data.error.schedule){
                        $( '#schedule_error' ).html( data.error.schedule[0] );
                    }
                    if(data.error.payment){
                        $( '#payment_error' ).html( data.error.payment[0] );
                    }
                    if(data.error.ref){
                        $( '#ref_error' ).html( data.error.ref[0] );
                    }
                    if(data.error.payment_method){
                        $( '#payment_method_error' ).html( data.error.payment_method[0] );
                    }
                }
                    
                if(data.success){
                    $('#mediumModal').modal('hide');
                    Swal.fire(
                        'Good job!',
                        'Order Request Successfuly Updated',
                        'success'
                    ).then(function() {
                        window.location = window.location.pathname;
                    });
                }
            },
        }); 
    });
})
</script>
@endsection