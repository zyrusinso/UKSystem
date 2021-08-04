@extends('layouts.admin')

@section('content')
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-8 offset-2">
            
            <div class="card">
                <form>
                    <div class="card-header">
                        <h3 class="card-title">Add Request</h3>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8 offset-2">
                               
                                <div class="form-group">
                                    <label for="exampleInputBorderWidth2">Name</label>
                                    <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputBorderWidth2">Order Value</label>
                                    <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputBorderWidth2">Diamonds Value</label>
                                    <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputBorderWidth2">Coins Value</label>
                                    <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputBorderWidth2">Coins Value</label>
                                    <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="">
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection