
@extends('student.std_main')
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                               <form action="{{$url}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @php
                                $s=session()->get('profile_data');
                                @endphp
                                    <input type="hidden" name="senderid" value="{{$s[0]->id}}">
                                    <label for="supervisor">Supervisor</label>
                                    <select name="supervisor" id="supervisor" class="form-control">
                                        <option value="">Select the supervisor...</option>
                                        @foreach ($teacher as $tea)
                                        <option value="{{$tea->id}}">{{$tea->teacher_name}}</option>
                                        @endforeach
                                    </select>
                                   <textarea class="summernote" name="discription" id="" cols="20" rows="10">
                                   </textarea>
                                   <br>
                                   <button id="save" class="btn btn-success btn-rounded"  type="submit">Save</button>
                            </form>
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

