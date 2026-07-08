@extends('Admin.master')
@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">
            <h4 class="card-title">Add Student New Document</h4>

            <form class="form-sample" action="{{ route('student_fees_save') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">student</label>
                            <div class="col-sm-9">
                                <select id="student_id" class="form-control form-select" name="student_id">
                                    <option disabled selected>Select Student</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">
                                            {{ $student->first_name }} {{ $student->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('student_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Fees Year</label>
                            <div class="col-sm-9">
                                <select name="fees_year" class="form-control form-select border-gray mt-2">
                                    <option disabled selected>Select Year</option>
                                    @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                                        <option value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                                @error('fees_year')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Fees Month</label>
                            <div class="col-sm-9">
                                <select name="fees_month" class="form-control form-select border-gray mt-2">
                                    <option disabled selected>Select Month</option>
                                    @for ($m = 1; $m <= 12; $m++)
                                        <option value="{{ $m }}">
                                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                        </option>
                                    @endfor
                                </select>
                                @error('fees_month')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Fess Amount</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input id="fees_amount" type="text" class="form-control" name="fees_amount">
                                    <span class="input-group-text">AFG</span>
                                </div>
                                @error('fees_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pay Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="fees_date">
                                @error('fees_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Class</label>
                            <div class="col-sm-9">

                                <input type="text" id="class_name" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Save</button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('student_id').addEventListener('change', function() {
            let studentId = this.value;
            if (!studentId) return;
            fetch("{{ url('/student-info') }}/" + studentId)
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    document.getElementById('fees_amount').value = data.fee ?? '';
                    document.getElementById('class_name').value = data.class_name ?? '';

                })
                .catch(err => console.log(err));
        });
    </script>
@endsection
