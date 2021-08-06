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
                        <form  action="/pilot/{{ $pilotData->id }}" method="post" id="updateForm">
                        
                        @csrf
                        @method('PATCH')
                            
                        
                            <label for="exampleInputBorderWidth2">Name</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="name" id="name" value="{{ old('name') ?? $pilotData->name }}"  placeholder="e.g: John Doe">
                            <span class="text-danger error-text" id="name_error"></span>
                    </div>
                    <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">Initial Rank</label>
                                <input type="text" class="form-control form-control-border border-width-2" name="initial_rank" id="initial_rank" value="{{ old('initial_rank') ?? $pilotData->initial_rank }}" placeholder="ex: 100">
                                <span class="text-danger error-text" id="initial_rank_error"></span>
                            </div>
                    </div>
                    <div class="col-4">

                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">Target Rank</label>
                                <input type="text" class="form-control form-control-border border-width-2" name="target_rank" id="target_rank" value="{{ old('target_rank') ?? $pilotData->target_rank }}" placeholder="ex: 100">
                                <span class="text-danger error-text" id="target_rank_error"></span>
                            </div>
                    </div>
                    <div class="col-4">

                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">Request</label>
                                <textarea class="form-control" rows="2" placeholder="Request field" style="margin-top: 0px; margin-bottom: 0px; height: 100px;" name="user_req" id="user_req">{{ old('user_req') ?? $pilotData->user_req }}</textarea>
                                <span class="text-danger error-text " id="user_req_error"></span>
                            </div>
                    </div>
                    <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">handler</label>
                                <input type="text" class="form-control form-control-border border-width-2" name="handler" id="handler" value="{{ old('handler') ?? $pilotData->handler }}" placeholder="e.g: jOhnD0e#123">
                                <span class="text-danger error-text " id="handler_error"></span>
                            </div>
                    </div>
                    <div class="col-4">
                            
                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">tf</label>
                                <input type="text" class="form-control form-control-border border-width-2" name="tf" id="tf" value="{{ old('tf') ?? $pilotData->tf }}" placeholder="e.g: jOhnD0e#123">
                                <span class="text-danger error-text " id="tf_error"></span>
                            </div>
                    </div>
                    <div class="col-4">

                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">payment</label>
                                <input type="text" class="form-control form-control-border border-width-2" name="payment" id="payment" value="{{ old('payment') ?? $pilotData->payment }}" placeholder="e.g: jOhnD0e#123">
                                <span class="text-danger error-text " id="payment_error"></span>
                            </div>
                    </div>
                    <div class="col-4">

                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">Reference</label>
                                <input type="text" class="form-control form-control-border border-width-2" name="ref" id="ref" value="{{ old('ref') ?? $pilotData->ref }}" placeholder="ex: Filter Dupli">
                                <span class="text-danger error-text " id="ref_error"></span>
                            </div>
                    </div>
                    <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">Payment Method</label>
                                <input type="text" class="form-control form-control-border border-width-2" name="payment_method" id="payment_method" value="{{ old('payment_method') ?? $pilotData->payment_method }}" placeholder="ex: Drop Down">
                                <span class="text-danger error-text " id="payment_method_error"></span>
                            </div>
                    </div>
                    <div class="col-4 ">
                    <label for="exampleInputBorderWidth2">Status</label>
                        <div class="btn-group ml-2">
                            <select class="btn btn-default dropdown-toggle" name="status">
                                <div class="dropdown-menu">
                                    <?php 
                                        echo '<option class="dropdown-item" value="Done"'.(($pilotData->status == "Done") ? "selected" : ""). '>Done</option>';
                                        echo '<option class="dropdown-item" value="Pending"'.(($pilotData->status == "Pending") ? "selected" : ""). '>Pending</option>';
                                        echo '<option class="dropdown-item" value="Cancel"'.(($pilotData->status == "Cancel") ? "selected" : ""). '>Cancel</option>';
                                    ?>
                                </div>
                            </select>   
                        </div>
                    </div>
                    
                </div>
                <div class="text-center mb-2 mt-2">
                        <input type="submit" value="submit" id="addSubmitBTN" class="btn btn-lg btn-success py-0">
                        </form>
                </div>
            </div>
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
                        echo "<col><col><col><col><col><col><col><col><col style='visibility:collapse;'><col><col><col><col style='visibility:collapse;'>";
                    }
                ?>
                <thead>
                        <tr >
                            <th>Date</th>
                            <th>Request By</th>
                            <th>Name</th>
                            <th>Initial Rank</th>
                            <th>Target Rank</th>
                            <th>Status</th>
                            <th>Request</th>
                            <th>Handler</th>
                            <th>Payment</th>
                            <th>Ref</th>
                            <th>Payment Method</th>
                        </tr>
                </thead>
                <tbody id="myTable">
                    <tr>
                    @foreach($pilotHistories as $pilotHistory)
                        <td>{{ $pilotHistory->created_at }}</td>
                        <td>{{ $pilotHistory->request_by }}</td>
                        <td>{{ $pilotHistory->name }}</td>
                        <td>{{ $pilotHistory->initial_rank }}</td>
                        <td>{{ $pilotHistory->target_rank }}</td>
                        <td style="
                        <?php 
                            if($pilotHistory->status == 'Pending'){echo 'background-color: #ff0000; color: white;';}
                            if($pilotHistory->status == 'Done'){echo 'background-color: green; color: white;';}
                            if($pilotHistory->status == 'Cancel'){echo 'background-color: black; color: white;';}
                        ?>">
                            {{ $pilotHistory->status }}</td>
                        <td>{{ $pilotHistory->user_req }}</td>
                        <td>{{ $pilotHistory->handler }}</td>
                        <td>{{ $pilotHistory->payment }}</td>
                        <td>{{ $pilotHistory->ref }}</td>
                        <td>{{ $pilotHistory->payment_method }}</td>
                        
                    
                    </tr>
                    @endforeach
                </tbody>
                </table>
                
            </div>
            <!-- /.card-body -->
            
        </div>
                
            
    </div>
</section>

<script src="/admin-lte/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
$(function(){
    
    $('#updateForm').on('submit', function(e) {
        var $form = $( this );
        
        $( '#name_error' ).html( "" );
        $( '#initial_rank_error' ).html( "" );
        $( '#target_rank_error' ).html( "" );
        $( '#handler_error' ).html( "");
        $( '#tf_error' ).html("");
        $( '#payment_error' ).html("");
        $( '#ref_error' ).html("");
        $( '#payment_method_error' ).html( "");

        e.preventDefault();

        $.ajax({
            url: "/pilot/<?=$pilotData->id?>",
            dataType: "json",
            type: "PATCH",
            data: $form.serialize(),
            success: function(data){
                if(data.error){
                    if(data.error.name){
                        $( '#name_error' ).html( data.error.name[0] );
                    }
                    if(data.error.initial_rank){
                        $( '#initial_rank_error' ).html( data.error.initial_rank[0] );
                    }
                    if(data.error.target_rank){
                        $( '#target_rank_error' ).html( data.error.target_rank[0] );
                    }
                    if(data.error.handler){
                        $( '#handler_error' ).html( data.error.handler[0] );
                    }
                    if(data.error.tf){
                        $( '#tf_error' ).html( data.error.tf[0] );
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