@extends('main')
@section('main_section')
    <!--*******************
                Preloader start
            ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
                Preloader end
            ********************-->
    <!--**********************************
                    Content body start
                ***********************************-->
    <div class="content-body">

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="container">
                    <div>
                        <div class="float-start">
                            <h4 class="pb-3">Edit Task <span class="badge bg-info">{{$task->title}}</span></h4>
                        </div>
                        <div style="float: right;">
                            <a href="{{ route('task.index') }}" class="btn btn-info">All Task</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="card card-body bg-light p-4">
                        <form action="{{route('task.update',$task->id)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="projact">Projact Name</label>
                                <select class="form-control" id="projact"  name="projact">
                                    <option value="">Select Projact</option>
                                    @foreach ($projact as $projacts)
                                    <option value="{{$projacts->proj_id}}">{{$projacts->proj_name}}</option>
                                    @endforeach
                                </select>
                              </div>
                            <div class="form-group">
                              <label for="title">Title</label>
                              <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter email" name="title" value="{{$task->title}}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" id="description" aria-describedby="description" placeholder="Enter email" name="description" rows="5">{{$task->description}} </textarea>
                              </div>
                              <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                   @if ($task->status === "unopen")
                                   <option value="unopen">unopen</option>
                                   <option value="working">working</option>
                                    <option value="done">done</option>
                                    @elseif ($task->status === "working")
                                    <option value="working">working</option>
                                   <option value="unopen">unopen</option>
                                    <option value="done">done</option>
                                    @else
                                    <option value="done">done</option>
                                    <option value="working">working</option>
                                   <option value="unopen">unopen</option>
                                   @endif

                                </select>

                                   </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
