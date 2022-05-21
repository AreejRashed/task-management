@extends('cms.parent')

@section('title','Register')
@section('page-lg','Register')
@section('main-pg-md','CMS')
@section('page-md','Register')

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
                                <label>{{__('cms.project_name')}}</label>
                                <select class="select2" id="project_id" name="project_id"  data-placeholder="select" style="width: 100%;">
                                    <option value= 0 > {{__('cms.select')}} </option>
                                    @foreach ($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label>{{__('cms.user')}}</label>
                                <select class="select2" id="user_id" name="user_id"  data-placeholder="select" style="width: 100%;">
                                    <option value= 0 >{{__('cms.select')}}</option>
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
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
        axios.post('/cms/admin/project-Beneficiary ', {
            user_id: document.getElementById('user_id').value,
            project_id: document.getElementById('project_id').value,
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create-form').reset();
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