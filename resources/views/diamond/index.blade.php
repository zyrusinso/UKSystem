@extends('layouts.admin')

@section('content')

<section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="" style="display: flex; justify-content: space-between;"><h3 >DIAMONDS</h3>
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
                    @foreach ($diamonds as $diamond)
                        <tr data-toggle="modal" data-id="{{ $diamond->id }}" data-target="#orderModal">
                        
                            <td>{{ $diamond->date }}</td>
                            <td>{{ $diamond->request_by }}</td>
                            <td>{{ $diamond->name }}</td>
                            <td>{{ $diamond->order_value }}</td>
                            <td>{{ $diamond->diamonds_value }}</td>
                            <td>{{ $diamond->coins_value }}</td>
                            <td>{{ $diamond->ml_id }}</td>
                            <td>{{ $diamond->ign }}</td>
                            <td>{{ $diamond->ref }}</td>
                            <td>{{ $diamond->status }}</td>
                            <td>{{ $diamond->payment_method }}</td>
                            <td>{{ $diamond->profit_value }}</td>
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
                                <h1>History</h1>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="mediumBody">
                            <div class="form-group">
                                <form  action="{{ route('diamond.store') }}" method="post" id="orderForm"></form>
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
$(function(){
    $('#addSubmitBTN').on('click', function(e) {
        var formData = signupForm.serialize();

        e.preventDefault();
        $.ajax({
            url: "/diamond",
            type: "POST",
            data: formData,
            success: function(data){
                alert(data.query.name);
            }
        }); 
        
    })
});


 
    
</script>
@endsection