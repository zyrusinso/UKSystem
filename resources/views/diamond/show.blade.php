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
                        <form  action="/diamond/{{ $diamondData->id }}" method="post" id="updateForm">
                        
                        @csrf
                        @method('PATCH')
                        <div>
                        
                            <label for="exampleInputBorderWidth2">Name</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="name" id="Name"  value="{{ $diamondData->name }}" placeholder="e.g: John Doe">
                            <span class="text-danger error-text" id="name_error"></span>
                        </div>
                        
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">Order</label>
                                <input type="text" class="form-control form-control-border border-width-2" name="order" id="order" value="{{ $diamondData->diamonds }}" placeholder="ex: 100" readonly="readonly">
                            <span class="text-danger error-text" id="order_error"></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">ML ID</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="ml_id" id="ml_id" value="{{ $diamondData->ml_id }}" placeholder="ex: 123456789(1234)">
                            <span class="text-danger error-text " id="ml_id_error"></span>
                        </div>
                    </div>
                    <div class="col-4">     
                        
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">IGN</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="ign" id="ign" value="{{ $diamondData->ign }}" placeholder="e.g: jOhnD0e#123">
                            <span class="text-danger error-text " id="ign_error"></span>
                        </div>
                    </div>

                    <div class="col-4"> 
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">Reference</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="ref" id="ref" value="{{ $diamondData->ref }}" placeholder="ex: Filter Dupli">
                            <span class="text-danger error-text " id="ref_error"></span>
                        </div>
                        
                    </div>

                    <div class="col-4"> 
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">Payment Method</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="payment_method" id="payment_method" value="{{ $diamondData->payment_method }}" placeholder="ex: Drop Down">
                            <span class="text-danger error-text " id="payment_method_error"></span>
                        </div>
                    
                    </div>
                    <div class="col-4 ">
                        <label for="exampleInputBorderWidth2">Status</label>
                        <div class="btn-group ml-2">
                            <select class="btn btn-default dropdown-toggle" name="status">
                                <div class="dropdown-menu">
                                    <?php 
                                        echo '<option class="dropdown-item" value="Done"'.(($diamondData->status == "Done") ? "selected" : ""). '>Done</option>';
                                        echo '<option class="dropdown-item" value="Pending"'.(($diamondData->status == "Pending") ? "selected" : ""). '>Pending</option>';
                                        echo '<option class="dropdown-item" value="Cancel"'.(($diamondData->status == "Cancel") ? "selected" : ""). '>Cancel</option>';
                                    ?>
                                </div>
                            </select>   
                        </div>
                    </div>
                        
                    
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
                        <th>Order</th>
                        <th>Diamonds</th>
                        <th>ML ID</th>
                        <th>IGN</th>
                        <th>REF</th>
                        <th>Status</th>
                        <th>Payment Method</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr>
                    @foreach($diamondHistories as $diamondHistory)
                        <td>{{ $diamondHistory->created_at }}</td>
                        <td>{{ $diamondHistory->request_by }}</td>
                        <td>{{ $diamondHistory->name }}</td>
                        <td>{{ $diamondHistory->order }}</td>
                        <td>{{ $diamondHistory->diamonds }}</td>
                        <td>{{ $diamondHistory->ml_id }}</td>
                        <td>{{ $diamondHistory->ign }}</td>
                        <td>{{ $diamondHistory->ref }}</td>
                        <td style="
                        <?php 
                            if($diamondHistory->status == 'Pending'){echo 'background-color: #ff0000; color: white;';}
                            if($diamondHistory->status == 'Done'){echo 'background-color: green; color: white;';}
                            if($diamondHistory->status == 'Cancel'){echo 'background-color: black; color: white;';}
                        ?>">
                            {{ $diamondHistory->status }}</td>
                        <td>{{ $diamondHistory->payment_method }}</td>
                        
                    
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
        $( '#order_error' ).html( "" );
        $( '#ml_id_error' ).html( "");
        $( '#ign_error' ).html("");
        $( '#ref_error' ).html("");
        $( '#payment_method_error' ).html("");

        e.preventDefault();

        $.ajax({
            url: "/diamond/<?=$diamondData->id?>",
            dataType: "json",
            type: "PATCH",
            data: $form.serialize(),
            success: function(data){
                if(data.error){
                    if(data.error.name){
                        $( '#name_error' ).html( data.error.name[0] );
                    }
                    if(data.error.order){
                        $( '#order_error' ).html( data.error.order[0] );
                    }
                    if(data.error.ml_id){
                        $( '#ml_id_error' ).html( data.error.ml_id[0] );
                    }
                    if(data.error.ign){
                        $( '#ign_error' ).html( data.error.ign[0] );
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