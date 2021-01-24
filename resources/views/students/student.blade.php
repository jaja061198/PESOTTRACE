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
            <h1 class="m-0 text-dark">Students</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Masterfile Setup</li>
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Student List</a></li>
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
        <a href="{{ route('student.insert') }}" class="btn btn-block btn-success btn-sm"><i class="fa fa-plus"></i> Add Students </a>
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
            <table class="table table-hover text-nowrap table-bordered" id="userstbl">
              <thead>
                <tr>
                  <th style="width: 1%;">ID</th>
                  {{-- <th>Student ID</th> --}}
                  <th>Full Name</th>
                  <th>Gender</th>
                  <th>Unique ID</th>
               <th style="width: 10%;">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($students as $key => $value)
                <tr>
                  <input type="hidden" id="field_id{{ $key+1 }}" value="{{ $value['id'] }}">
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $value['f_name'] }} {{ $value['m_name'] }} {{ $value['l_name'] }}</td>
                  <td>{{ ($value['gender'] == 'M' ? 'Male' : 'Female') }}</td>
                  <td>{{ $value['qr_image'] }}</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-primary" id="field_btn{{ $key+1 }}"  onclick="showEditModal(this.id)"><i class="fa fa-edit"></i></button>
                    &nbsp;
                    <button type="button" class="btn btn-sm btn-danger" style="border-radius: 50%;"  id="field_btn_del{{ $key+1 }}"  onclick="deleteData(this.id)"><i class="fa fa-trash"></i></button> 
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
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
