@extends('layouts.app')

@section('header-assets')

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Generate Attendance</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Generate Attendance</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Generate Attendance</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{ route('generate.attendance.post') }}">
                @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Class</label>
                  <div class="col-sm-10">
                    <select name="class" id="" class="form-control" required>
                        <option value="" disabled selected >Select Class</option>
                        @foreach ($class->where('adviser',Auth::user()->id) as $key => $data )
                            <option value="{{ $data['id'] }}">{{ $data['grade'] }} - {{ $data['section'] }} - {{ $data['subject'] }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Date</label>
                  <div class="col-sm-10">
                    <input type="date" name="date" class="form-control" id="inputPassword3" placeholder="Password" required>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info">Generate</button>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
    </div>
    <!-- /.content -->
  </div>



@endsection


@section('footer-assets')

@endsection
