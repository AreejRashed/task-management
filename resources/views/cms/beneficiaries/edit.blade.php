@extends('cms.parent')

@section('title','Beneficiaries')
@section('page-lg','Beneficiaries')
@section('main-pg-md','Edit')
@section('page-md','Beneficiaries')

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
                        <h3 class="card-title">{{__('cms.edit_beneficiary')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body">


                            <div class="form-group">
                                <label>{{__('cms.scope')}}</label>
                                <select class="select2" id="scope_id" name="scope_id"  data-placeholder="{{__('cms.select')}}" style="width: 100%;">
                                    @foreach ($scopes as $scope)
                                    <option value="{{$scope->id}}" @if($beneficiary->scope_id == $scope->id) selected
                                        @endif>{{$scope->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" value="{{$beneficiary->name}}"
                                    placeholder="name">
                            </div>

                            <div class="form-group">
                                <label for="age">{{__('cms.age')}}</label>
                                <input type="number" class="form-control" id="age" value="{{$beneficiary->age}}"
                                    placeholder="age">
                            </div>

                            
                            <div class="form-group">
                                <label for="address">{{__('cms.address')}}</label>
                                <input type="text" class="form-control" id="address" value="{{$beneficiary->address}}"
                                    placeholder="address">
                            </div>

                        </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performUpdate('{{$beneficiary->id}}')"
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


<script>
    function performUpdate(id) {
        axios.put('/cms/admin/beneficiaries/{{$beneficiary->id}}', {
            name: document.getElementById('name').value,
            age: document.getElementById('age').value,
            address: document.getElementById('address').value,
            scope_id: document.getElementById('scope_id').value,
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/admin/beneficiaries';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>

<script src="{{ asset('cms/plugins/select2/js/select2.full.min.js') }}"></script>
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