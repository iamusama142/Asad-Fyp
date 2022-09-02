
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
                                    <input type="hidden" name="senderid" value="{{$task->id}}">
                                    <input type="hidden" name="projactid" value="{{$task->proj_id}}">
                                    <div class="form-group">
                                        <label for="status">Supervisor</label>
                                        <select class="form-control" id="status" name="supervisor">
                                           <option >Select your Supervisor..</option>
                                            @foreach ($received as $super)
                                            <option value="{{$super->id}}">{{$super->teacher_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('supervisor')
                                                {{ $message }}
                                            @enderror
                                        </span>

                                           </div>
                                    <label for="supervisor">Title : {{$task->title}}</label>
                                    <input type="text" name="task" id="supervisor" class="form-control" readonly value="{{$task->description}}">

                                   <textarea class="summernote" name="discription" id="" cols="20" rows="10">
                                   </textarea>
                                   <span class="text-danger">
                                    @error('discription')
                                        {{ $message }}
                                    @enderror
                                </span>
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

