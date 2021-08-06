@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="" style="display: flex; justify-content: space-between;"><h3 >PRE ORDER SKIN</h3>
                </div>
                    
                </div>
                <!-- /.card-header -->
                
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover table-sm" >
                    <?php 
                        if(!Auth::user()->isAdmin()){
                            echo "<col><col><col><col><col><col><col><col><col><col><col><col style='visibility:collapse;'><col>";
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
                            <th>REF</th>
                            <th>Payment Method</th>
                            <th>Profit</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="myTable">
                    <?php foreach ($skins as $skin){?>
                        <tr>
                            <td>{{ $skin->date }}</td>
                            <td>{{ $skin->request_by }}</td>
                            <td>{{ $skin->name }}</td>
                            <td>{{ $skin->name_of_skin }}</td>
                            <td>{{ $skin->type_of_skin }}</td>
                            <td style="
                            <?php 
                                if($skin->status == 'Pending'){echo 'background-color: #ff0000; color: white;';}
                                if($skin->status == 'Done'){echo 'background-color: green; color: white;';}
                                if($skin->status == 'Cancel'){echo 'background-color: black; color: white;';}
                            ?>">
                                {{ $skin->status }}</td>
                            <td>{{ $skin->ml_to_follow }}</td>
                            <td style="
                            <?php 
                                if($skin->follow_status == 'Pending'){echo 'background-color: #ff0000; color: white;';}
                                if($skin->follow_status == 'Done'){echo 'background-color: green; color: white;';}
                                if($skin->follow_status == 'Cancel'){echo 'background-color: black; color: white;';}
                            ?>">
                                {{ $skin->follow_status }}</td>
                            <td>{{ $skin->Schedule }}</td>
                            <td>{{ $skin->payment }}</td>
                            <td>{{ $skin->ref }}</td>
                            <td>{{ $skin->payment_method }}</td>
                            <td>{{ $skin->profit }}</td>
                            <td style="background-color: white"><a href="/pre_order_skin/<?= $skin->id?>" class="btn btn-primary ">Edit</a></td>
                        </tr>
                    <?php }?>

                    </tbody>
                    </table>
                </div>
                <div><button class="btn btn-success " 
                style="height: 36px; width: 130px; float: right; margin: 0 10px 10px 0"
                data-toggle="modal" id="addForm" data-target="#mediumModal">
                    Order Form
                </button></div>

                <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1>Order Request</h1>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="mediumBody">
                            <div class="form-group">
                                <form  action="{{ route('skin.store') }}" method="post" id="orderForm">
                                @csrf
                                        <label for="exampleInputBorderWidth2">Name</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="name" id="name"  placeholder="e.g: John Doe">
                                        <span class="text-danger error-text" id="name_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Name Of Skin</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="name_of_skin" id="name_of_skin" placeholder="e.g: Viscount Alucard">
                                        <span class="text-danger error-text" id="name_of_skin_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Type Of Skin</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="type_of_skin" id="type_of_skin" placeholder="e.g: Epic">
                                        <span class="text-danger error-text" id="type_of_skin_error"></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">ML to Follow</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="ml_to_follow" id="ml_to_follow" placeholder="e.g: jOhnD0e#123">
                                        <span class="text-danger error-text " id="ml_to_follow_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Schedule</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="schedule" id="schedule" placeholder="">
                                        <span class="text-danger error-text " id="schedule_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Payment</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="payment" id="payment" placeholder="ex: 12345">
                                        <span class="text-danger error-text " id="payment_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Reference</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="ref" id="ref"  placeholder="">
                                        <span class="text-danger error-text " id="ref_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Payment Method</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="payment_method" id="payment_method" placeholder="ex: Drop Down">
                                        <span class="text-danger error-text " id="payment_method_error"></span>
                                    </div>
                                    <input type="submit" value="submit" id="addSubmitBTN" class="btn btn-lg btn-success py-0">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>

<script src="/admin-lte/plugins/sweetalert2\sweetalert2.all.min.js"></script>

<script>

$(function(){
    //DataTables
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": true,
      "responsive": false,
    });
    
    
    //Order Request
    $('#orderForm').on('submit', function(e) {
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
            url: "{{ route('skin.store') }}",
            dataType: "json",
            type: "POST",
            data: $form.serialize(),
            success: function(data){
                if(data.error){
                    if(data.error.name){
                        $( '#name_error' ).html( data.error.name[0] );
                    }
                    if(data.error.name_of_skin){
                        $( '#name_of_skin_error' ).html( data.error.name_of_skin[0] );
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
                        'Order Request Successfuly Added',
                        'success'
                    ).then(function() {
                        window.location = window.location.pathname;
                    });
                }
            },
        }); 
    });
});
   
</script>
@endsection