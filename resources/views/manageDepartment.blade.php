@extends('layout.main')
@section('seo-meta')
<title>DocTrack - Manage Department</title>
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
                  <div class="table-data">
                  <table class="table table-hover">
                    <thead>
                        <tr>
                          <th>Action</th>
                          <th>Department Name</th>
                          <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                      <!-- foreach -->
                     @foreach($depts as $dept)
                     <tr>
                        <td>
                          <span id="{{ $dept->deptId }}" class="dept-update cursor-pointer"><i class="fas fa-edit text-primary"></i></span >
                        </td>
                        <td>{{ $dept->deptName }}</td>
                        <td>{{ $dept->status ? 'Active': 'Inactive' }}</td>
                      </tr>
                     @endforeach
                    </tbody>
                  </table>
                  </div>
              </div>
              
          </section>
          <!-- The Modal -->
          <div class="modal" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Add New Department</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="save-department">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                      <div class="form-group col-md-12 col-lg-12">
                        <label for="deptName">Department Name:</label>
                        <input type="text" class="form-control" name="deptName" id="deptName">
                      </div>
                      <div class="form-group col-md-12 col-lg-12">
                        <label for="status">Status:</label>
                        <select class="form-control" name="status" id="status">
                          <option value="1">Active</option>
                          <option value="0">In-active</option>
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
                  <h4 class="modal-title">Update Department</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="update-department">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                      <div class="form-group col-md-12 col-lg-12 d-none">
                        <label for="deptId">Department Name:</label>
                        <input type="text" class="form-control" name="deptId" id="deptId" disbled>
                      </div>
                      <div class="form-group col-md-12 col-lg-12">
                        <label for="UpdatedeptName">Department Name:</label>
                        <input type="text" class="form-control" name="deptName" id="UpdatedeptName">
                      </div>
                      <div class="form-group col-md-12 col-lg-12">
                        <label for="Updatestatus">Status:</label>
                        <select class="form-control" name="status" id="Updatestatus">
                          <option value="1">Active</option>
                          <option value="0">In-active</option>
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
  $(function(){
    $('tbody tr td .dept-update').on('click', async function(){
        
        id = $(this).attr('id');
        let result = await axios.post('get-department', {id :id})
        if(!result)
        return result;

        result = await result.data[0];
        await $('#deptId').val(result.deptId),
        await $('#UpdatedeptName').val(result.deptName),
        await $('#Updatestatus').val(result.status)

        $("#myModalUpdate").modal('show');

    });
  });
</script>
@endpush