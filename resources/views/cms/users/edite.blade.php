@extends('cms.parent')

@section('title','users')
@section('page-lg','users')
@section('main-pg-md','Create')
@section('page-md','users')

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
                        <h3 class="card-title">{{__('cms.edit_users')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    {{-- enctype="multipart/form-data" --}}
                    <form id="create-form">

                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{__('cms.user')}}</label>
                                <select class="form-control" id="scope_id" >
                                    @foreach ($scopes as $scope)
                                    <option value="{{$scope->id}}" @if($user->scope_id == $scope->id) selected
                                        @endif>{{$scope->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name" >{{__('cms.name')}}</label>
                                <input type="text" class="form-control" value="{{$user->name}}" id="name" placeholder="name">
                            </div>

                            <div class="form-group">
                                <label for="email">{{__('cms.email')}}</label>
                                <input type="email" class="form-control" value="{{$user->email}}" id="email" placeholder="email">
                            </div>
                            
                            <div class="form-group">
                                <label for="address">{{__('cms.address')}}</label>
                                <input type="text" class="form-control" value="{{$user->address}}" id="address" placeholder="address">
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
        axios.post('/cms/admin/users', {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            address: document.getElementById('address').value,
            scope_id: document.getElementById('scope_id').value,
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/users/admins';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>


@endsection