@extends('cms.parent')

@section('title','project')
@section('page-lg','project')
@section('main-pg-md','Create')
@section('page-md','project')

@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css') }}">
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.create_project')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    {{-- enctype="multipart/form-data" --}}
                    <form id="create-form">

                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{__('cms.scope')}}</label>
                                <select class="select2" id="scope_id" name="scope_id"  data-placeholder="{{__('cms.select')}}" style="width: 100%;">
                                    @foreach ($scopes as $scope)
                                    <option value="{{$scope->id}}">{{$scope->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label>{{__('cms.category')}}</label>
                                <select class="select2" id="category_id" name="category_id"  data-placeholder="{{__('cms.select')}}" style="width: 100%;">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            
                            <div class="form-group">
                                <label>{{__('cms.donor')}}</label>
                                <select class="select2" id="donor_id" name="donor_id"  data-placeholder="{{__('cms.select')}}" style="width: 100%;">
                                    @foreach ($donors as $donor)
                                    <option value="{{$donor->id}}">{{$donor->name}}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="form-group">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" placeholder="name">
                            </div>


                            <div class="form-group">
                                <label for="start">{{__('cms.start')}}</label>
                                <input type="text" class="form-control" id="start" placeholder="start">
                            </div>

                            <div class="form-group">
                                <label for="end">{{__('cms.end')}}</label>
                                <input type="text" class="form-control" id="end" placeholder="end">
                            </div>

                            <div class="form-group">
                                <label for="amount">{{__('cms.amount')}}</label>
                                <input type="text" class="form-control" id="amount" placeholder="amount">
                            </div>


                            
                   
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performStore()"
                                class="btn btn-primary">{{__('cms.save')}}</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script src="{{ asset('cms/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    function performStore() {
        axios.post('/cms/admin/projects ', {
            name: document.getElementById('name').value,
            start: document.getElementById('start').value,
            end: document.getElementById('end').value,
            amount: document.getElementById('amount').value,
            category_id: document.getElementById('category_id').value,
            scope_id: document.getElementById('scope_id').value,
            donor_id: document.getElementById('donor_id').value,
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/admin/projects';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });

    }
</script>


<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        //Timepicker
        {{-- $('#timepicker').datetimepicker({
            format: 'LT'
        }) --}}

        //Bootstrap Duallistbox
        {{-- $('.duallistbox').bootstrapDualListbox() --}}

        //Colorpicker
        {{-- $('.my-colorpicker1').colorpicker() --}}
        //color picker with addon
        {{-- $('.my-colorpicker2').colorpicker() --}}
    })

</script>
@endsection