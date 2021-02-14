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
            <h1 class="m-0 text-dark">My Class</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item"><a href="{{ route('home') }}">My Class</a></li>
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
        
      </div>

        <div class="card col-lg-12" style="margin-top: 20px;">

      <div class="card-header">
        <h3 class="card-title">Class List <div wire:target="searchKey,render" wire:loading="">
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
                  {{-- <th>Student ID</th> --}}
                  <th>Grade</th>
                  <th>Section</th>
                  <th>Subject</th>
                  <th>Status</th>
                  <th>Adviser</th>
                  <th>Available Seats</th>
               <th style="width: 10%;">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($classSetup as $key => $value)
                <tr>
                  <input type="hidden" id="field_id{{ $key+1 }}" value="{{ $value['id'] }}">
                  <td>{{ $value['getGrade']->grade_level }}</td>
                  <td>{{ $value['getSection']->section }}</td>
                  <td>{{ $value['status'] }}</td>
                  <td>{{ $value['subject'] }}</td>
                  <td>{{ $value['getAdviser']->f_name }} {{ $value['getAdviser']->m_name }} {{ $value['getAdviser']->l_name }}</td>
                  <td>{{ $value['capacity'] - sizeOf($value['getStudents']) }}</td>
                  <td>
                    <a class="btn btn-sm btn-primary" id="field_btn{{ $key+1 }}" style="color:white;" href="{{ route('my.class.setup.edit',['id' => $value['id']]) }}"><i class="fa fa-eye"></i></a>
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


    function deleteData(value)
    {
      let locator = value.substring(13);

      let user_id = document.getElementById('field_id'+locator).value;

      $.ajax({
          type: "get",
          url:"{{ route('class.setup.delete') }}",
          cache:false,
          data:{ user_id: user_id },
          success:function(data)
          {
              location.reload();

               Toast.fire({
                icon: 'success',
                title: 'Delete Success.'
              })
          }
      });
    }

  </script>

@endsection
