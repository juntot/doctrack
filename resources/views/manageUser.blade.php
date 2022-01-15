@extends('layout.main')
@section('seo-meta')
<title>DocTrack - Manage Users</title>
@stop
@section('main')
 <!-- header -->
@include('layout.header')
<style>
    /* helpers */
    .cursor-pointer{
      cursor: pointer;
    }
    /* helpers */
    /* flex */
    .grow-1{
      flex-grow: 1;
    }
    /* end flex */

    
    
    /* end */
    .table-data{
      overflow-x: scroll;
    }
    table tr td img{
      width: 100%;
      max-width: 100px;
      min-width: 100px;
      height: auto;
    }

    #qrcode {
      width:100%;
      height:160px;
      margin-top:15px;
      overflow: auto;
      display: none;
    }
    #qrcode img{
      margin: 0 auto;
    }

    #qrcodeUpdate {
      width:100%;
      height:160px;
      margin-top:15px;
      overflow: auto;
      display: none;
    }
    #qrcodeUpdate img{
      margin: 0 auto;
    }
    .body-image{
      width: 45%;
      object-fit: cover;
      position: fixed;
      left: 50%;
      transform: translate(-50%, 8%);
      z-index: -1;
      filter: grayscale(100%);
      opacity: .04;
    }
</style>
    
<main >
    <img class="body-image" src="{{URL::to('/public/img/icdi-logo.png')}}" alt="" srcset="">
    <article class="container">
      <section class="mt-5">
          <div class="row">
            <div class="col-12 text-right">
              <!-- Button to Open the Modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Add New
              </button>
            </div>
          </div>
          <div class="content py-3">
              <table id="dataTble" class="table table-striped table-bordered" style="width:100%"></table>
              <!-- <div class="table-data">
              <table class="table table-hover">
                <thead>
                    <tr>
                      <th>Action</th>
                      <th>Email</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Department</th>
                      <th>Role</th>
                      <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td>
                      <span id="{{ $user->email }}" class="user-update cursor-pointer"><i class="fas fa-edit text-primary"></i></span >
                      <span id="{{ $user->email }}" class="user-reset-pass cursor-pointer"><i class="fas fa-unlock-alt text-danger"></i></span >
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->firstName }}</td>
                    <td>{{ $user->lastName }}</td>
                    <td>{{ $user->deptName }}</td>
                    <td>{{ $user->type}}</td>
                    <td>{{ $user->status ? 'Active': 'Inactive' }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </div> -->
          </div>
          
      </section>
      <!-- The Modal -->
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Add New User</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" action="save-users">
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                  <div class="form-group col-md-12 col-lg-12">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                  </div>
                  <div class="form-group col-md-12 col-lg-12">
                    <label for="firstName">First Name:</label>
                    <input type="text" class="form-control" name="firstName" id="firstName" required>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="lastName">Last Name:</label>
                    <input type="text" class="form-control" name="lastName" id="lastName" required/>
                  </div>
                  <div class="form-group col-md-12 col-lg-12">
                    <label for="deptId">Department:</label>
                    <select class="form-control" name="deptId_" id="deptId">
                      @foreach($depts as $dept)
                      <option value="{{$dept->deptId}}">{{$dept->deptName}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-12 col-lg-12">
                    <label for="type">Role:</label>
                    <select class="form-control" name="type" id="type">
                      <option value="user">User</option>
                      <option value="staff">Staff</option>
                      <option value="admin">Admin</option>
                    </select>
                  </div>
                </div>
                {{ csrf_field() }}
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" value="Save" />
              <!-- <button type="button" class="btn btn-primary download-qr" >Download</button> -->
            </div>
            </form>
          </div>
        </div>
      </div>

      <!-- The Modal UPDATE-->
      <div class="modal" id="myModalUpdate">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Update User</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" action="update-users">
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                  <div class="form-group col-md-12 col-lg-12">
                    <label for="Updateemail">Email:</label>
                    <input type="email" class="form-control" name="email" id="Updateemail" readonly>
                  </div>
                  <div class="form-group col-md-12 col-lg-12">
                    <label for="UpdatefirstName">First Name:</label>
                    <input type="text" class="form-control" name="firstName" id="UpdatefirstName">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="UpdatelastName">Last Name:</label>
                    <input type="text" class="form-control" name="lastName" id="UpdatelastName" />
                  </div>
                  <div class="form-group col-md-12 col-lg-12">
                    <label for="UpdatedeptId">Department:</label>
                    <select class="form-control" name="deptId_" id="UpdatedeptId">
                      @foreach($depts as $dept)
                      <option value="{{$dept->deptId}}">{{$dept->deptName}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-12 col-lg-12">
                    <label for="Updatetype">Role:</label>
                    <select class="form-control" name="type" id="Updatetype">
                      <option value="user">User</option>
                      <option value="staff">Staff</option>
                      <option value="admin">Admin</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12 col-lg-12">
                    <label for="Updatestatus">Status:</label>
                    <select class="form-control" name="status" id="Updatestatus">
                      <option value="0">In-Active</option>
                      <option value="1">Active</option>
                    </select>
                  </div>
                </div>
                {{ csrf_field() }}
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" value="Update" />
              <!-- <button type="button" class="btn btn-primary download-qr" >Download</button> -->
            </div>
            </form>
          </div>
        </div>
      </div>
    </article>  
</main>
@stop    

@push('scripts')  
<script>
    let columnDefs = [
        {
            title: "Action", data: 'email', orderable: false, render: function(data, row){
              return `<span id="${data}" class="user-update cursor-pointer"><i class="fas fa-edit text-primary"></i></span >
              <span id="${data}" class="user-reset-pass cursor-pointer"><i class="fas fa-unlock-alt text-danger"></i></span >`;
            },
        },
        {
            title: "Email", data: 'email',
        },{
            title: "First Name", data: 'firstName'
        },{
            title: "Last Name", data: 'lastName'
        },{
            title: "Department", data: 'deptName',
        },{
            title: "Role", data: 'type',
        },{
            title: "Status", data: 'status', render: function(data){
              return data > 0 ? 'Active': 'In-Active';
            }
        }
    ];
      $(function(){

        let dataTable = $('#dataTble').DataTable({
          pageLength: 40,
          // sPaginationType: "simple_numbers",
          data: {!! json_encode($users) !!},
          columns: columnDefs,
          sPaginationType: "simple_numbers",
          dom: '<"top with-margin-bottom"f>rt<"mdl-grid"<"mdl-cell mdl-cell--4-col"i><"mdl-cell mdl-cell--8-col"p>><"clear">',
          scrollX: true,
          order: [[ 0, "desc" ]],
          // rowCallback: function(row, data, index) {
          //     }
        });
        $('tbody tr td .user-update').on('click', async function(e){
            // e.stopPropaganation();
            email = $(this).attr('id');
            let result = await axios.post('get-users', {email :email})
            if(!result)
            return result;

            result = await result.data[0];
            await $('#Updateemail').val(result.email);
            await $('#UpdatefirstName').val(result.firstName);
            await $('#UpdatelastName').val(result.lastName);
            await $('#Updatetype').val(result.type);
            await $('#Updatestatus').val(result.status);
            await $('#UpdatedeptId').val(result.deptId_);
            $("#myModalUpdate").modal('show');

        });

        $('tbody tr td .user-reset-pass').on('click', async function(){
            const isConfirm = confirm('Are you sure you want to reset the password?');
            if(!isConfirm)
            return;
            
            email = $(this).attr('id');
            let result = await axios.post('reset-pass', {email :email})
            if(!result)
            return result;

            // reload page
            window.location.reload();
            $("#myModalUpdate").modal('hide');

        });
      });
</script>
@endpush