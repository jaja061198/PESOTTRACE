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
        <a href="{{ route('my.class.setup.index') }}" class="btn btn-block btn-success btn-sm"><i class="fa fa-list"></i> Class List </a>
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
              <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('populate.class.setup.update') }}">
                @csrf
                <input type="hidden" name="class_id" value="{{ $info->id }}">
                 <div class="form-group">
                    <div class="row">
                      <div class="col-lg-6">
                         <label for="exampleInputEmail1"><font style="color:red;">* </font>Grade</label>
                         <select class="form-control" id="grade" name="grade" required disabled>
                            <option value="" selected disabled>Select Grade</option>
                            @foreach ($grade as $element)
                              <option value="{{ $element['id'] }}" @if($info->grade == $element['id']) selected @endif>{{ $element['grade_level'] }}</option>
                            @endforeach
                          </select>
                      </div>

                      <div class="col-lg-6">
                         <label for="exampleInputEmail1"><font style="color:red;">* </font>Section</label>
                         <select class="form-control" id="section" name="section" required disabled>
                            <option value="" selected disabled>Select Section</option>
                            @foreach ($section as $element)
                              <option value="{{ $element['id'] }}" @if($info->section == $element['id']) selected @endif>{{ $element['section'] }}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="exampleInputEmail1"><font style="color:red;">* </font>Adviser</label>
                     <select class="form-control" id="adviser" name="adviser" required disabled>
                        <option value="" selected disabled>Select Adviser</option>
                        @foreach ($user as $element)
                          <option value="{{ $element['id'] }}" @if($info->adviser == $element['id']) selected @endif>{{ $element['f_name'].' '.$element['m_name'].' '.$element['l_name'] }}</option>
                        @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1"><font style="color:red;">*</font>Subject</label>
                    <input type="text" class="form-control" placeholder="Enter Subject" name="subject" value="{{ $info->subject }}" disabled>
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1"><font style="color:red;">*</font>Time Start</label>
                    <input type="time" class="form-control"name="time_start" value="{{ $info->time_start }}" disabled>
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1"><font style="color:red;">*</font>Time End</label>
                    <input type="time" class="form-control"name="time_end" value="{{ $info->time_end }}" disabled>
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1"><font style="color:red;">*</font>Capacity</label>
                    <input type="number" class="form-control"name="capacity" value="{{ $info->capacity }}" disabled>
                  </div>


                  <div class="form-group">
                    <table class="table table-bordered table-striped">
                      <tr>
                        <th>Student</th>
                        <th style="width: 5px;"><i class="fa fa-times" style="color:red;"></i></th>
                      </tr>

                      <tbody id="studentTbl">
                        @foreach ($info->getStudents as $key => $element)
                          <tr>
                            {{-- <td><select class="form-control" value="{{ $element['student_id'] }}" disabled @if($element['student_id'] == $element['studentDetail']->id) selected @endif>{{ $element['studentDetail']->f_name }} {{ $element['studentDetail']->m_name }} {{ $element['studentDetail']->l_name }}</select></td> --}}
                            <td>
                              <input type="text" class="form-control" name="" value="{{ $element['studentDetail']->qr_image }} - {{ $element['studentDetail']->f_name }} {{ $element['studentDetail']->m_name }} {{ $element['studentDetail']->l_name }}" disabled>
                             </td>

                             <td>
                               {{-- <button type="button" class="btn btn-danger students"><i class="fa fa-times"></i></button> --}}
                             </td>
                          </tr>
                        @endforeach
                      </tbody>

                      <tr>
                        <td colspan="100%" align="right">
                          {{-- <button type="button" class="btn btn-x btn-success" onclick="addRow()"><i class="fa fa-plus"></i> Add Student</button> --}}
                        </td>
                      </tr>
                    </table>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  {{-- <button type="submit" class="btn btn-primary" onmouseover="validateData()">Submit</button> --}}
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


    function addRow()
    {
      $row = '<tr>'
        +'<td><select class="form-control" name="student_add[]" required>'
        @foreach ($student as $element)
          +'<option value="{{ $element['id'] }}">{{ $element['qr_image'] }} -{{ $element['f_name'] }} {{ $element['m_name'] }} {{ $element['l_name'] }}</option>'
        @endforeach
        +'</td>'
        +'<td>'
        +'<button type="button" class="btn btn-danger students" onclick="deleteRow(this)"><i class="fa fa-times"></i></button>'
        +'</td>'
        +'</tr>'
      $('#studentTbl').append($row);
    }

    function deleteRow(btn)
    {
      var row = btn.parentNode.parentNode;
      row.parentNode.removeChild(row);
    }

    function validateData()
    {
      var tbody = document.getElementById("studentTbl");
      var totalRowCount = tbody.rows.length; // 5

      if(totalRowCount < 1)
      {
        alert("Please add a student");
        return false;
      }

    }

  </script>

@endsection
