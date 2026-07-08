@extends('Admin.master')
@section('content')
    <div class='card mt-3 mr-3 ml-3'>
        <div class="card-body">
            <h4 class="card-title">Add Role</h4>
            <form class="form-sample mt-3" action="{{ route('role_save')}}" method="post">
                @csrf
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Role Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name">
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
