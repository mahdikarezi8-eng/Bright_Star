@extends('Admin.master')
@section('content')
    <div class='card mt-3 mr-3 ml-3'>
        <div class="card-body">
            <h4 class="card-title">Edit Role</h4>
            <form class="form-sample mt-3" action="{{ route('role_update',$role->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Role Name</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$role->name}}" class="form-control" name="name">
                              @error('name')
                                   <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div> 
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Save</button>
            </form>
        </div>
    </div>
@endsection
