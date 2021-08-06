@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="" style="display: flex; justify-content: space-between;"><h3 >PILOT</h3>
                </div>
                    
                </div>
                <!-- /.card-header -->
                
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover table-sm" >
                    <?php 
                        if(!Auth::user()->isAdmin()){
                        echo "<col><col><col><col><col><col><col><col><col style='visibility:collapse;'><col><col><col><col style='visibility:collapse;'><col>";
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
                            <th>TF</th>
                            <th>Payment</th>
                            <th>Ref</th>
                            <th>Payment Method</th>
                            <th>Profit</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="myTable">
                    <?php foreach ($pilots as $pilot){?>
                        <tr>
                            <td>{{ $pilot->date }}</td>
                            <td>{{ $pilot->request_by }}</td>
                            <td>{{ $pilot->name }}</td>
                            <td>{{ $pilot->initial_rank }}</td>
                            <td>{{ $pilot->target_rank }}</td>
                            <td style="
                            <?php 
                                if($pilot->status == 'Pending'){echo 'background-color: #ff0000; color: white;';}
                                if($pilot->status == 'Done'){echo 'background-color: green; color: white;';}
                                if($pilot->status == 'Cancel'){echo 'background-color: black; color: white;';}
                            ?>">{{ $pilot->status }}</td>
                            <td>{{ $pilot->user_req }}</td>
                            <td>{{ $pilot->handler }}</td>
                            <td>{{ $pilot->tf }}</td>
                            <td>{{ $pilot->payment }}</td>
                            <td>{{ $pilot->ref }}</td>
                            <td>{{ $pilot->payment_method }}</td>
                            <td>{{ $pilot->profit }}</td>
                            <td style="background-color: white"><a href="/pilot/<?= $pilot->id?>" class="btn btn-primary ">Edit</a></td>
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
                                <form  action="{{ route('pilot.store') }}" method="post" id="orderForm">
                                @csrf
                                        <label for="exampleInputBorderWidth2">Name</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="name" id="Name"  placeholder="e.g: John Doe">
                                        <span class="text-danger error-text" id="name_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Initial Rank</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="initial_rank" id="initial_rank" placeholder="ex: Bronze">
                                        <span class="text-danger error-text" id="initial_rank_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Target Rank</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="target_rank" id="target_rank" placeholder="ex: Mythical Glory">
                                        <span class="text-danger error-text" id="target_rank_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Request</label>
                                            <textarea class="form-control" rows="2" placeholder="Type your request" name="user_req" id="user_req" style="margin-top: 0px; margin-bottom: 0px; height: 100px;"></textarea>
                                        <span class="text-danger error-text " id="user_req_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">handler</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="handler" id="handler" placeholder="">
                                        <span class="text-danger error-text " id="handler_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">tf</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="tf" id="tf" placeholder="ex: 150">
                                        <span class="text-danger error-text " id="tf_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">payment</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="payment" id="payment" placeholder="ex: 12345">
                                        <span class="text-danger error-text " id="payment_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Reference</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="ref" id="ref" placeholder="Reference">
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
    
    
    $('#orderForm').on('submit', function(e) {
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
            url: "/pilot",
            dataType: "json",
            type: "POST",
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