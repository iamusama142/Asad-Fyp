
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
                                    <form class="form-valide" action="{{ $url }}" method="post">
                                        @csrf
                                        @foreach ($Program as $valu )

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="Program-Name">Program Name <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="Program-Name" name="val_username" placeholder="Enter Your Program-Name" value="{{$valu->prog_name}}">
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-skill"> Program Department <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="val-skill" name="dptProgram" >
                                                    <option value="{{ $valu->dept_id }}">Please select</option>
                                                    @foreach ($department as $value )
                                                    @if ($value->dept_status == 1)
                                                    <option value="{{$value->dept_id }}">{{ $value->dep_name }}</option>
                                                    @endif
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="start_date">Program Status <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                @if( $valu->prog_status == '1')
                                                        <input type="radio" name="optradio"  id="radio" checked value="1"><label for="radio" >Active</label>
                                                        <input type="radio" name="optradio" id="radio1" value="0" ><label for="radio1">In-Active</label>
                                                        @else
                                                        <input type="radio" name="optradio" id="radio" value="1" ><label for="radio">Active</label>
                                                        <input type="radio" name="optradio" checked  id="radio1" value="0"><label for="radio1">In-Active</label>
                                                        @endif
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
