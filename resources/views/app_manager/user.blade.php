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
            <h1 class="m-0 text-dark">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Application Manager</li>
              <li class="breadcrumb-item"><a href="{{ route('home') }}">User List</a></li>
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
        <button type="button" class="btn btn-block btn-success btn-sm" onclick="openAddModal()"><i class="fa fa-plus"></i> Add User</button>
      </div>

        <div class="card col-lg-12" style="margin-top: 20px;">

      <div class="card-header">
        <h3 class="card-title">User List <div wire:target="searchKey,render" wire:loading="">
              <div class="la-ball-scale-pulse la-dark la-sm">
                <div></div>
              </div>
            </div>
        </h3>

      </div>

       
      <!-- /.card-header -->
          <div class="card-body table-responsive p-0" style="margin-top: 10px;">
            <table class="table table-hover table-bordered" id="userstbl">
              <thead>
                <tr>
                  <th>User Id</th>
               <th>Name</th>
               <th>User level</th>
               <th style="width: 10%;">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $key => $value)
                <tr>
                  <input type="hidden" id="field_id{{ $key+1 }}" value="{{ $value['user_id'] }}">
                  
                  <td>{{ $value['user_id'] }}</td>
                  <td>{{ $value['f_name'] }} {{ $value['m_name'] }} {{ $value['l_name'] }}</td>
                  <td>{{ $value['user_level'] }}</td>
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
            <p> Add User </p>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <div class="form-group row">
            <label for="add_fname" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="f_name_add" name="fname" placeholder="First Name" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="add_mname" class="col-sm-2 col-form-label">Middle Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="m_name_add" name="mname" placeholder="Middle Name" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="add_lname" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="l_name_add" name="lname" placeholder="Last Name" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="user_id_add" class="col-sm-2 col-form-label">User Id</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="user_id_add" name="user_id_add" placeholder="Username" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="password_add" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password_add" name="lname" placeholder="Password" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="user_level_add" class="col-sm-2 col-form-label">User Level</label>
            <div class="col-sm-4">
             <select class="form-control" id="user_level_add">
                <option value="" selected disabled>Select User Level</option>
                <option value="0">0 - Admin</option>
                <option value="1">1 - Teacher</option>
             </select>
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
            <p> Edit User </p>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <div class="form-group row">
            <label for="add_fname" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="f_name_edit" name="fname" placeholder="First Name" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="add_mname" class="col-sm-2 col-form-label">Middle Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="m_name_edit" name="mname" placeholder="Middle Name" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="add_lname" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="l_name_edit" name="lname" placeholder="Last Name" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="user_id_add" class="col-sm-2 col-form-label">User Id</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="user_id_edit" name="user_id_add" placeholder="Username" required readonly>
            </div>
          </div>

          <div class="form-group row">
            <label for="password_add" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password_edit" name="lname" placeholder="Password" required readonly>
            </div>
          </div>

          <div class="form-group row">
            <label for="user_level_add" class="col-sm-2 col-form-label">User Level</label>
            <div class="col-sm-4">
             <select class="form-control" id="user_level_edit">
                <option value="" selected disabled>Select User Level</option>
                <option value="0">0 - Admin</option>
                <option value="1">1 - Teacher</option>
             </select>
            </div>
          </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-primary" id="edit" onclick="updateData()">Save changes</button>

        <button type="button" class="btn btn-warning" id="reset" onclick="passwordReset()">Password Reset</button>
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
        "autoWidth": true,
      })
    });


    function insertUser()
    {

      let f_name = document.getElementById('f_name_add').value;
      let m_name = document.getElementById('m_name_add').value;
      let l_name = document.getElementById('l_name_add').value;
      let user_level = document.getElementById('user_level_add').value;
      let password = document.getElementById('password_add').value;
      let user_id = document.getElementById('user_id_add').value;
      if(f_name == '' || m_name == '' || l_name == '' || user_level == '' || password == '' || user_id == '')
      {
        Toast.fire({
          icon: 'error',
          title: 'Please fill al lthe required field.'
        })

        return false;
      }

      $.ajax({
          type: "get",
          url:"{{ route('users.insert') }}",
          cache:false,
          data:{ f_name: f_name, m_name:m_name,l_name:l_name,user_level:user_level,password:password,user_id:user_id },
          success:function(data)
          {

             // location.reload();
             if(data.status == "0")
             {
              Toast.fire({
                icon: 'error',
                title: 'User Id already exist.'
              })

              return false;
             }

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

      let user_id = document.getElementById('field_id'+locator).value;

      $.ajax({
          type: "get",
          url:"{{ route('users.edit') }}",
          cache:false,
          data:{ user_id: user_id },
          success:function(data)
          {

            document.getElementById('f_name_edit').value = data.f_name;
            document.getElementById('m_name_edit').value = data.m_name;
            document.getElementById('l_name_edit').value = data.l_name;
            document.getElementById('user_id_edit').value = data.user_id;
            document.getElementById('password_edit').value = data.password;
            document.getElementById('user_level_edit').value = data.user_level;
          }
      });


    }


    function updateData()
    {
        let f_name = document.getElementById('f_name_edit').value;
        let m_name = document.getElementById('m_name_edit').value;
        let l_name = document.getElementById('l_name_edit').value;
        let user_level = document.getElementById('user_level_edit').value;
        let password = document.getElementById('password_edit').value;
        let user_id = document.getElementById('user_id_edit').value;
        if(f_name == '' || m_name == '' || l_name == '' || user_level == '' || password == '' || user_id == '')
        {
          Toast.fire({
            icon: 'error',
            title: 'Please fill al lthe required field.'
          })

          return false;
        }

        $.ajax({
            type: "get",
            url:"{{ route('users.update') }}",
            cache:false,
            data:{ f_name: f_name, m_name:m_name,l_name:l_name,user_level:user_level,password:password,user_id:user_id },
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
          url:"{{ route('users.delete') }}",
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
