@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="" style="display: flex; justify-content: space-between;"><h3 >VIP DIAMONDS</h3>
                </div>
                    
                </div>
                <!-- /.card-header -->
                
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover table-sm" >
                    <?php 
                        if(!Auth::user()->isAdmin()){
                            echo "<col><col><col><col><col><col style='visibility:collapse;'><col><col><col><col><col><col style='visibility:collapse;'><col>";
                        }
                    ?>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Request By</th>
                            <th>Name</th>
                            <th>Order</th>
                            <th>Diamonds</th>
                            <th>Coins</th>
                            <th>ML ID</th>
                            <th>IGN</th>
                            <th>REF</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                            <th>Profit</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="myTable">
                    <?php foreach ($vips as $vip){?>
                    
                        <tr style="<?php 
                                // if($vip->status == "Pending"){echo "background-color: #ff0000; color: white;";}
                                // if($vip->status == "Done"){echo "background-color: green; color: white;";}
                                // if($vip->status == "Cancel"){echo "background-color: black; color: white;";}
                            ?>">
                            
                            <td>{{ $vip->date }}</td>
                            <td>{{ $vip->request_by }}</td>
                            <td>{{ $vip->name }}</td>
                            <td>{{ $vip->order }}</td>
                            <td>{{ $vip->diamonds }}</td>
                            <td>{{ $vip->coins }}</td>
                            <td>{{ $vip->ml_id }}</td>
                            <td>{{ $vip->ign }}</td>
                            <td>{{ $vip->ref }}</td>
                            <td style="
                            <?php 
                                if($vip->status == 'Pending'){echo 'background-color: #ff0000; color: white;';}
                                if($vip->status == 'Done'){echo 'background-color: green; color: white;';}
                                if($vip->status == 'Cancel'){echo 'background-color: black; color: white;';}
                            ?>">
                                {{ $vip->status }}</td>
                            <td>{{ $vip->payment_method }}</td>
                            <td>{{ $vip->profit }}</td>
                            <td style="background-color: white"><a href="/vip_diamonds/<?= $vip->id?>" class="btn btn-primary ">Edit</a></td>
                        </tr>
                    <?php }?>

                    </tbody>
                    </table>
                    
                </div>
                <!-- /.card-body -->
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
                                <form  action="{{ route('vip.store') }}" method="post" id="orderForm">
                                @csrf
                                        <label for="exampleInputBorderWidth2">Name</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="name" id="Name"  placeholder="e.g: John Doe">
                                        <span class="text-danger error-text" id="name_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Order</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="order" id="order" placeholder="ex: 100">
                                        <span class="text-danger error-text" id="order_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">ML ID</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="ml_id" id="ml_id" placeholder="ex: 123456789(1234)">
                                        <span class="text-danger error-text " id="ml_id_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">IGN</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="ign" id="ign" placeholder="e.g: jOhnD0e#123">
                                        <span class="text-danger error-text " id="ign_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Reference</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="ref" id="ref" placeholder="ex: Filter Dupli">
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
        $( '#order_error' ).html( "" );
        $( '#ml_id_error' ).html( "");
        $( '#ign_error' ).html("");
        $( '#ref_error' ).html("");
        $( '#payment_method_error' ).html( "");

        e.preventDefault();

        $.ajax({
            url: "/vip_diamonds",
            dataType: "json",
            type: "POST",
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