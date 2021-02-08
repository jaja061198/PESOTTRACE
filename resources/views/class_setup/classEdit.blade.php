@extends('layouts.app')

@section('header-assets')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Masterfile Setup</li>
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Edit Student</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
      <div class="col-lg=12">
        <a href="{{ route('student.index') }}" class="btn btn-block btn-success btn-sm"><i class="fa fa-list"></i> Student List </a>
      </div>

        <div class="card col-lg-12" style="margin-top: 20px;">

      <div class="card-header">
        <h3 class="card-title">Section List <div wire:target="searchKey,render" wire:loading="">
              <div class="la-ball-scale-pulse la-dark la-sm">
                <div></div>
              </div>
            </div>
        </h3>

      </div>

       
      <!-- /.card-header -->
          <div class="card-body table-responsive p-0" style="margin-top: 10px;">
              <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('student.update') }}">
                @csrf
                <div class="card-body">
                  <input type="hidden" name="student_id" value="{{ $info->id }}">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><font style="color:red;">* </font>First Name</label>
                    <input type="text" class="form-control" placeholder="Enter Firstname" name="fname" required value="{{ $info->f_name }}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1"><font style="color:red;"> </font>Middle Name</label>
                    <input type="text" class="form-control" placeholder="Enter Middle Name" name="mname" value="{{ $info->m_name }}">
                  </div>

                  <div class="form-group">
                       <label for="exampleInputEmail1"><font style="color:red;">* </font>Last Name</label>
                      <input type="text" class="form-control" placeholder="Enter Middle Name" name="lname" required value="{{ $info->l_name }}">
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-6">
                         <label for="exampleInputEmail1"><font style="color:red;">* </font>Gender</label>
                         <select class="form-control" id="gender" name="gender" required>
                            <option value="" selected disabled>Select Gender</option>
                            <option value="M" @if($info->gender == 'M') selected @endif>Male</option>
                            <option value="F" @if($info->gender == 'F') selected @endif>Female</option>
                          </select>
                      </div>

                       <div class="col-lg-6"> 
                      <label for="exampleInputEmail1"><font style="color:red;">* </font>Birthday</label>
                      <input type="date" class="form-control" name="b_day" required value="{{ $info->b_day }}">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Photo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" name="">Upload</span>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.card-body -->
        </div>

              <!-- ./col -->
            </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>



@endsection


@section('footer-assets')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script>

    $(function () {
      $("#userstbl").DataTable({
        "responsive": false,
        "autoWidth": false,
      })
    });

  </script>

@endsection
