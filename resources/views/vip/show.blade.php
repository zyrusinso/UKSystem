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
                        <form  action="/vip_diamonds/{{ $vipData->id }}" method="post" id="updateForm">
                        
                        @csrf
                        @method('PATCH')
                        <div>
                        
                            <label for="exampleInputBorderWidth2">Name</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="name" id="Name"  value="{{ $vipData->name }}" placeholder="e.g: John Doe">
                            <span class="text-danger error-text" id="name_error"></span>
                        </div>
                        
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">Order</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="order" id="order" value="{{ $vipData->order }}" placeholder="ex: 100">
                            <span class="text-danger error-text" id="order_error"></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">ML ID</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="ml_id" id="ml_id" value="{{ $vipData->ml_id }}" placeholder="ex: 123456789(1234)">
                            <span class="text-danger error-text " id="ml_id_error"></span>
                        </div>
                    </div>
                    <div class="col-4">     
                        
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">IGN</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="ign" id="ign" value="{{ $vipData->ign }}" placeholder="e.g: jOhnD0e#123">
                            <span class="text-danger error-text " id="ign_error"></span>
                        </div>
                    </div>

                    <div class="col-4"> 
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">Reference</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="ref" id="ref" value="{{ $vipData->ref }}" placeholder="ex: Filter Dupli">
                            <span class="text-danger error-text " id="ref_error"></span>
                        </div>
                        
                    </div>

                    <div class="col-4"> 
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">Payment Method</label>
                            <input type="text" class="form-control form-control-border border-width-2" name="payment_method" id="payment_method" value="{{ $vipData->payment_method }}" placeholder="ex: Drop Down">
                            <span class="text-danger error-text " id="payment_method_error"></span>
                        </div>
                    
                    </div>
                    <div class="col-4 ">
                    <label for="exampleInputBorderWidth2">Status</label>
                        <div class="btn-group ml-2">
                            <select class="btn btn-default dropdown-toggle" name="status">
                                <div class="dropdown-menu">
                                    <?php 
                                        echo '<option class="dropdown-item" value="Done"'.(($vipData->status == "Done") ? "selected" : ""). '>Done</option>';
                                        echo '<option class="dropdown-item" value="Pending"'.(($vipData->status == "Pending") ? "selected" : ""). '>Pending</option>';
                                        echo '<option class="dropdown-item" value="Cancel"'.(($vipData->status == "Cancel") ? "selected" : ""). '>Cancel</option>';
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
                    @foreach($vipHistories as $vipHistory)
                        <td>{{ $vipHistory->created_at }}</td>
                        <td>{{ $vipHistory->request_by }}</td>
                        <td>{{ $vipHistory->name }}</td>
                        <td>{{ $vipHistory->order_value }}</td>
                        <td>{{ $vipHistory->diamonds_value }}</td>
                        <td>{{ $vipHistory->ml_id }}</td>
                        <td>{{ $vipHistory->ign }}</td>
                        <td>{{ $vipHistory->ref }}</td>
                        <td style="
                        <?php 
                            if($vipHistory->status == 'Pending'){echo 'background-color: #ff0000; color: white;';}
                            if($vipHistory->status == 'Done'){echo 'background-color: green; color: white;';}
                            if($vipHistory->status == 'Cancel'){echo 'background-color: black; color: white;';}
                        ?>">
                            {{ $vipHistory->status }}</td>
                        <td>{{ $vipHistory->payment_method }}</td>
                        
                    
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
            url: "/vip_diamonds/<?=$vipData->id?>",
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