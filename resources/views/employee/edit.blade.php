<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">



<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        <div class="card">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Add New Employee</span>
                </h3>
            </div>
            <div class="card-body py-3">
                {!! Form::model($employee, ['route' => ['employee.update', $employee->id], 'method' => 'put', 'files' => true]) !!}
                    @csrf
                    <div class="row mb-10 align-items-center">
                        <div class="col-md-2">
                            <label class="form-label required"> Name</label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                               {!! Form::text('name', $employee->name, ['class' => 'form-control form-control-lg form-control-solid','name'=>'name', 'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label required"> email</label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                {!! Form::text('email', $employee->email, ['class' => 'form-control form-control-lg form-control-solid', 'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label required"> password</label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                {!! Form::text('password', $employee->password, ['class' => 'form-control form-control-lg form-control-solid', 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label required"> Company</label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <select id='company' name='company' class="form-select" aria-label="Default select example">
                                <option value="">choose company</option>
                                @foreach($companies as $company)
                                    @if($employee->company==$company['id'])
                                    <option value="{{$company['id']}}" selected>{{$company['name']}}</option>
                                    @else
                                    <option value="{{$company['id']}}" >{{$company['name']}}</option>
                                    @endif
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label required"> image</label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                {!! Form::file('image', ['class' => 'form-control form-control-lg', 'accept' => 'image/*']) !!}
                            </div>
                        </div>

                        <div class="row mb-10">
                            <div class="col text-center mt-1">
                                <button class="btn btn-primary px-20 mt-1">Save </button>
                            </div>
                        </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
