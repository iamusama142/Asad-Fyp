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
                            <h4 class="pb-3">Create Task</h4>
                        </div>
                        <div style="float: right;">
                            <a href="{{ route('task.index') }}" class="btn btn-info">All Task</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="card card-body bg-light p-4">
                        {{-- <div class="card-header">
                            First Task
                            <span class="badge rounded-pill bg-warning text-dark">
                                Time
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <div class="float-start">
                                    hd jhds lknl sdl kkdi lkdfkjsd kdfjj lkdf;l ds;fllnjusd f,jklioifs jdfk dsfkjjd
                                <br>
                                <span class="badge rounded-pill bg-info text-white">working</span>
                                <small>Last updated -</small>
                                </div>
                                <div style="float: right;">
                                        <a href="{{ route('task.edit',1) }}" class="btn btn-success">Edit</a>

                                        <a href="{{ route('task.destroy',1) }}" class="btn btn-danger">Delete</a>
                                    </div>
                                <div class="clearfix"></div>

                            </div>
                        </div> --}}
                        <form action="{{route('task.store')}}" method="post">
                            @csrf
                            {{-- {{ App\Models\registration::getUserNameByID($value->user_id)}} --}}
                            <div class="form-group">
                                <label for="projact">Projact Name</label>
                                <select class="form-control" id="projact"  name="projact">
                                    <option value="">Select Projact</option>
                                    @foreach ($projact as $projacts)
                                    <option value="{{$projacts->proj_id}}">{{$projacts->proj_name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('projact')
                                        {{ $message }}
                                    @enderror
                                </span>
                              </div>
                            <div class="form-group">
                              <label for="title">Title</label>
                              <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter shadule title" name="title">
                              <span class="text-danger">
                                @error('title')
                                    {{ $message }}
                                @enderror
                            </span>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" id="description" aria-describedby="description" name="description" rows="5"> </textarea>
                                <span class="text-danger">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </span>  
                            </div>
                              <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="unopen">unopen</option>
                                    <option value="working">working</option>
                                    <option value="done">done</option>
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
