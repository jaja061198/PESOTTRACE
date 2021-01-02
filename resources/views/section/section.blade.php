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
            <h1 class="m-0 text-dark">Section</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Masterfile Setup</li>
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Section List</a></li>
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
        <button type="button" class="btn btn-block btn-success btn-sm" onclick="openAddModal()"><i class="fa fa-plus"></i> Add Section Level </button>
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
                  <th style="width: 1%;">Id</th>
                  <th>Section</th>
                  <th>Grade</th>
               <th style="width: 10%;">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($sections as $key => $value)
                <tr>
                  <input type="hidden" id="field_id{{ $key+1 }}" value="{{ $value['id'] }}">
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $value['section'] }}</td>
                  <td>{{ $value['getGrade']->grade_level}}</td>
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



{{-- ADD MODAL  --}}
 <div class="modal fade" id="modal-lg-add" wire:ignore.self data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
            <p> Add Section </p>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <div class="form-group row">
            <label for="add_fname" class="col-sm-2 col-form-label">Grade Level</label>
            <div class="col-sm-10">
              <select class="form-control" id="grade_add">
                <option value="" selected disabled>Select Grade</option>
                @foreach ($grades as $key => $value)
                  <option value="{{ $value['id'] }}">{{ $value['grade_level'] }}</option>
                @endforeach
              </select>
              <input type="hidden" name="" id="grade_id">
            </div>
          </div>

           <div class="form-group row">
            <label for="add_lname" class="col-sm-2 col-form-label">Section</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="section_add" name="lname" placeholder="Section" required>
            </div>
          </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-primary" id="add" onclick="insertUser()">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>




{{-- EDIT MODAL  --}}
 <div class="modal fade" id="modal-lg-edit" wire:ignore.self data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
            <p> Edit Section </p>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <div class="form-group row">
            <label for="add_fname" class="col-sm-2 col-form-label">Grade Level</label>
            <div class="col-sm-10">
              <select class="form-control" id="grade_edit">
                <option value="" selected disabled>Select Grade</option>
                @foreach ($grades as $key => $value)
                  <option value="{{ $value['id'] }}">{{ $value['grade_level'] }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="add_lname" class="col-sm-2 col-form-label">Section</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="section_edit" name="lname" placeholder="Section" required>
            </div>
          </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-primary" id="edit" onclick="updateData()">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    window.addEventListener('openEditModal', event => {
      $('#modal-lg').modal('show');
      // Toast.fire({
      //   icon: 'success',
      //   title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      // })

    });

    // window.addEventListener('closeEditModal', event => {
    //   $('#modal-lg').modal('hide');
    // });

    // window.addEventListener('openAddModal', event => {
    //   $('#modal-lg-add').modal('show');
    // });

    // window.addEventListener('closeAddModal', event => {
    //   $('#modal-lg-add').modal('hide');
    // });


    // window.addEventListener('successToastInsert', event => {
    //   Toast.fire({
    //     icon: 'success',
    //     title: 'Insert Success.'
    //   })
    // })

    // window.addEventListener('successToastUpdate', event => {
    //   Toast.fire({
    //     icon: 'success',
    //     title: 'Update Success.'
    //   })
    // })


    function openAddModal()
    {
      $('#modal-lg-add').modal('show');
    }

    $(function () {
      $("#userstbl").DataTable({
        "responsive": false,
        "autoWidth": false,
      })
    });


    function insertUser()
    {

      let grade = document.getElementById('grade_add').value;
      let section = document.getElementById('section_add').value;
      if(grade == '' || section == '')
      {
        Toast.fire({
          icon: 'error',
          title: 'Please fill all the required field.'
        })

        return false;
      }

      $.ajax({
          type: "get",
          url:"{{ route('section.insert') }}",
          cache:false,
          data:{ grade: grade,section : section },
          success:function(data)
          {

             // location.reload()
             location.reload();

             Toast.fire({
              icon: 'success',
              title: 'Insert Success.'
            })
          }
      });
       
    }

    //Edit Modal
    

    function showEditModal(value)
    {
      $('#modal-lg-edit').modal('show');
      let locator = value.substring(9);

      let section_id = document.getElementById('field_id'+locator).value;

      $.ajax({
          type: "get",
          url:"{{ route('section.edit') }}",
          cache:false,
          data:{ section_id: section_id },
          success:function(data)
          {
            document.getElementById('section_edit').value = data.section;
            document.getElementById('grade_edit').value = data.grade_level;
            document.getElementById('grade_id').value = data.section_id;
          }
      });


    }


    function updateData()
    {
        let grade_level = document.getElementById('grade_edit').value;
        let grade_id = document.getElementById('grade_id').value;
        let section = document.getElementById('section_edit').value;
        if(grade_level == '' || section == '' )
        {
          Toast.fire({
            icon: 'error',
            title: 'Please fill all the required field.'
          })

          return false;
        }

        $.ajax({
            type: "get",
            url:"{{ route('section.update') }}",
            cache:false,
            data:{ grade_level: grade_level,grade_id: grade_id,section : section },
            success:function(data)
            {

               location.reload();

               Toast.fire({
                icon: 'success',
                title: 'Update Success.'
              })
            }
        });
    }

    function deleteData(value)
    {
      let locator = value.substring(13);

      let user_id = document.getElementById('field_id'+locator).value;

      $.ajax({
          type: "get",
          url:"{{ route('section.delete') }}",
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
