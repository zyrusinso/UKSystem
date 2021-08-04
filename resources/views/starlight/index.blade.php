@extends('layouts.admin')

@section('content')

<section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="" style="display: flex; justify-content: space-between;"><h3 >PRE-ORDER STARLIGHT</h3>
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
                            <th>Coins</th>
                            <th>ML ID</th>
                            <th>IGN</th>
                            <th>REF</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                            <th>Profit</th>
                        </tr>
                    </thead>
                    <form action="" method="post" id="tableForm"></form>
                    <tbody>
                    @foreach ($starlights as $starlight)
                        <tr >
                        
                            <td>{{ $starlight->date }}</td>
                            <td>{{ $starlight->request_by }}</td>
                            <td>{{ $starlight->name }}</td>
                            <td>{{ $starlight->order }}</td>
                            <td>{{ $starlight->diamonds }}</td>
                            <td>{{ $starlight->coins }}</td>
                            <td>{{ $starlight->ml_id }}</td>
                            <td>{{ $starlight->ign }}</td>
                            <td>{{ $starlight->ref }}</td>
                            <td>{{ $starlight->status }}</td>
                            <td>{{ $starlight->payment_method }}</td>
                            <td>{{ $starlight->profit }}</td>
                        </tr>
                        
                        <div class="modal fade" id="orderModal" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1>Order Request</h1>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="mediumBody">
                                        <div id="oderDetails"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        @endforeach

                    </form>
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
                                <form  action="{{ route('diamond.store') }}" method="post"></form>
                                @csrf
                                        <label for="exampleInputBorderWidth2">Name</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="Name" id="Name"  placeholder="e.g: John Doe">
                                        <span class="text-danger error-text Name_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Order</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="order" id="order" placeholder="ex: 100">
                                        <span class="text-danger error-text order_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">ML ID</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="ml_id" id="ml_id" placeholder="ex: 123456789(1234)">
                                        <span class="text-danger error-text ml_id_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">IGN</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="ign" id="ign" placeholder="e.g: jOhnD0e#123">
                                        <span class="text-danger error-text ign_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Reference</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="ref" id="ref" placeholder="ex: Filter Dupli">
                                        <span class="text-danger error-text ref_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Payment Method</label>
                                        <input type="text" class="form-control form-control-border border-width-2" name="payment_method" id="payment_method" placeholder="ex: Drop Down">
                                        <span class="text-danger error-text payment_method_error"></span>
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


<script>
$('#addSubmitBTN').on('click', function(e) {
    e.preventDefault();
    var Name = $('#Name').val();
    var order = $('#order').val();
    var ml_id = $('#ml_id').val();
    var ign = $('#ign').val();
    var ref = $('#ref').val();
    var payment_method = $('#payment_method').val();
    $.ajax({
        url: '/diamond',
        method: "POST",
        data: {
            name: this.Name,
            order: order,
            ml_id: ml_id,
            ign: ign,
            ref: ref,
            payment_method: payment_method,
        },
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function(){
            $(document).find('span.error-text').text('');
        },
        success: function(data){
            if(data.status == 0){
                $.each(data.error, function(prefix, val){
                    $('span.'+prefix+'_error').text(val[0]);
                })
            }else{
                $('#main_form')[0].reset();
                alert(data.message);
            }
        }
    })
})


 
    
</script>
@endsection