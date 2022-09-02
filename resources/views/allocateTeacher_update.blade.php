
@extends('main')
@section('main_section')

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="form-valide" action="{{$url}}" method="post">
                                        @csrf
                                        @foreach ($Allocate as $val)
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="Tacher-Name">Tacher Name <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select name="Tacher_Name" id="Tacher-Name" class="form-control">
                                                    @foreach ($val->getTeacher as $value )
                                                    <option value="{{$value->teacher_id}}">{{$value->teacher_name}}</option>
                                                    @foreach ($teacher as $valu )
                                                    @if ($valu->teacher_id != $value->teacher_id)
                                                    <option value="{{$valu->teacher_id}}">{{$valu->teacher_name}}</option>
                                                    @endif
                                                    @endforeach
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                                    @error('Tacher_Name')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                                {{-- <input type="text" class="form-control" id="Tacher-Name" name="val-Tacher-Name" placeholder="Teacher Name"> --}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="Tacher-Department">Student Name <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select name="student_name" id="Tacher-Department" class="form-control">
                                                    @foreach ($val->getStudent as $val )
                                                    <option value="{{$val->std_id}}">{{$val->std_name}}</option>
                                                    @foreach ($std as $value )
                                                    @if($value->std_id != $val->std_id)
                                                    <option value="{{$value->std_id}}">{{$value->std_name}}</option>
                                                    @endif
                                                    @endforeach
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                                    @error('student_name')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                                {{-- <input type="text" class="form-control" id="Tacher-Department" name="val-Tacher-Department" placeholder="Tacher Departmente"> --}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        @endsection
