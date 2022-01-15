@extends('layout.main')
@section('seo-meta')
<title>DocTrack - rescieved docs</title>
@stop
@section('main')
 <!-- header -->
@include('layout.header')
<style>
  ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
    /* gonz */
    margin-top: 22px;
}

</style>
<main class="container mt-4">
<!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalTable">test</button> -->
  <table id="dataTble" class="table table-striped table-bordered" style="width:100%"></table>

  <!-- modal -->
  <div class="modal" id="modalTable">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h6 class="docId text-secondary">Document ID - JRB1640778440539</h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" id="reciverForm">
            <!-- Modal body -->
            <div class="modal-body">
                <ul class="timeline"></ul>
                <div class="form-row">
                  <div class="clearfix"></div>
                  <hr>
                  <div class="form-group col-md-12 d-none">
                    <label for="inputDocId">DocId</label>
                    <input id="inputDocId" class="form-control" name="docId" />
                  </div>
                  <div class="form-group col-md-12">
                    <label for="inputDept">Forward To</label>
                    <select id="inputDept" class="form-control" name="to">
                        @if(!empty($depts))
                          @foreach($depts as $dept)
                          <option value="{{$dept->deptId}}">{{$dept->deptName}}</option>
                          @endforeach
                        @endif
                    </select>
                  </div>
                  <div class="form-group col-lg-12">
                    <label for="exampleFormControlFile1">Attache File</label>
                    <input type="file" name="attachment" class="form-control-file" id="attachFile">
                  </div>
                  <div class="form-group col-12">
                    <label for="inputRemarks" >Remarks</label>
                    <textarea name="remarks" class="form-control" cols="10" rows="5" id="inputRemarks"></textarea>
                  </div>
                </div>
            </div>
            <!-- {{ csrf_field() }} -->
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="confirmed">Confirmed</button>
              <button type="button" class="btn btn-primary" id="forwarded">Forward</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</main>
@stop

@push('scripts')
<script>
  // var sites = @@{!! json_encode($sites->toArray()) !!};
  let thisRow = '';
  let columnDefs = [
        {
            title: "Doc ID", data: 'docId',
        },
        {
            title: "Date Submitted", data: 'datesubmitted',
            render: function(data){
              return moment(data).format('YYYY-MM-DD')
            }
        },{
            title: "From", data: 'from'
        },{
            title: "Forwarded To", data: 'deptName'
        },{
            title: "Remarks", data: 'remarks', className: "row-limit"
        },
        // {
        //     title: "Status", data: 'status'
        // }
    ];


    async function renderTimeLineList(row){
      let timelineList = row.history.map((data, index) => {
        
      return `<li>
                    <div class="p-3" style="box-shadow: 0 1px 6px rgb(0 0 0 / 18%);">
                        <a href="#">${ index > 0? 'Recieved': 'From'}: ${data.from}</a>
                        <small class="float-right"><em class="text-primary">${moment(data.datesubmitted).format('DD, MMM - YYYY')}</em></small>
                        <p>${data.remarks || ''}</p>
                        
                        ${data.file && 
                          `<div>
                            <small class="text">
                              <em>Attachment:</em>
                            </small><br/>
                            <a href="storage/app/${data.file}" target="_blank">${data.file}</a>
                          </div>`
                        }
                    </div>
                </li>`;
       });

      if(row.status != 1){
        timelineList.push(
        `<li>
            <div class="p-3 bg-warning" style="box-shadow: 0 1px 6px rgb(0 0 0 / 18%);">
                <span class="text">Forwarded To: ${row.deptName}</span>
                <small class="float-right"><em class="text-primary"></em></small>
            </div>
        </li>`);
      }
      return timelineList;
    }

    async function getSelectedRow(row, dtSelectedRow){
      console.log(row)
      let docId = row.docId;
      thisRow = dtSelectedRow;
      $('#inputDocId').val(docId);
      $('.modal-header .docId').text('Document ID - '+docId);


      if(typeof row.history == 'string')
      row['history'] = await JSON.parse(row.history);

      let timeline =await renderTimeLineList(row);
      
      await $('.timeline li').remove();
      await $('.timeline').append(timeline);
      $('#modalTable').modal('show');
      
    }
    
    async function post($URL, $data) {
      // new Promise(resolved, reject) {
        await axios.post($URL, $data);
      // }
    }

    function resetForm(){
      console.log('reset form');
    }

    function deleteRow(table, remove){
      // table.clear();
      // // table.rows.add(this.state.data);
      // table.draw();
      table
      .row( thisRow )
      .remove()
      .draw();
    }
    $(function(){
      // global Vars =============================
      var tempFiles = [];

      // TABLE ====================================
      let dataTable = $('#dataTble').DataTable({
      pageLength: 40,
      // sPaginationType: "simple_numbers",
      data: {!! json_encode($docs) !!},
      columns: columnDefs,
      sPaginationType: "simple_numbers",
      dom: '<"top with-margin-bottom"f>rt<"mdl-grid"<"mdl-cell mdl-cell--4-col"i><"mdl-cell mdl-cell--8-col"p>><"clear">',
      scrollX: true,
      order: [[ 0, "desc" ]],
      // rowCallback: function(row, data, index) {
      //     }
      });

      $('#dataTble tbody').on('click', 'tr', function(){
          if(dataTable.row(this).data())
          getSelectedRow(dataTable.row(this).data(), $(this));
      });

      // ATTACHMENT ==========================
      async function validateFile(){
        if(document.querySelector('#attachFile').value != '') {
          
            let file = document.querySelector('#attachFile').files[0]; //sames as here

            let type = file['type'];
            const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
            if (!validImageTypes.includes(type)) {
              alert('Invalid Image type');
              return false;
          }
          if(file.size >= 2000000)
          {
            alert('Filesize exceed 2MB');
            return false;
          }

          if (file) {
                // document.querySelector('#file-label').innerHTML = file.name;
                // document.querySelector('#file-label2').innerHTML = file.name;
              return file;
          }
        }else{
          return null;
        }
      }
      $('#attachFile').on('change', async function(e){
        // alert('sd');
        const file = await validateFile();
        
        if(file){
          // const formData = new FormData();
          // formData.append('attachment[]', file );

          // axios.post('file/add-file', formData)
          // .then((response)=>{
          //   tempFiles = response.data
          //   console.log(response.data)
          // }).catch((err)=>{console.log(err);});
        }
      });



      // BTN =================================
      $('#confirmed').click(async function(){
        deleteRow(dataTable);
        // let data = $('#reciverForm').serialize();
        let data =  new FormData();
        const file = await validateFile();
        
        data.append('docId', $('#inputDocId').val());
        data.append('to', $('#inputDept').val() || '');
        data.append('remarks', $('#inputRemarks').val() || '');

        if(file)
        data.append('attachment[]', file );

        let res = await post('docs-confirmed', data);
        $('#modalTable').modal('hide');
      });


      $('#forwarded').click(async function(){
        deleteRow(dataTable);
        // let data = $('#reciverForm').serialize().split("=");
        let data =  new FormData();
        const file = await validateFile();
        
        data.append('docId', $('#inputDocId').val());
        data.append('to', $('#inputDept').val() || '');
        data.append('remarks', $('#inputRemarks').val() || '');

        if(file)
        data.append('attachment[]', file );

        let res = await post('docs-forwarded', data);
        $('#modalTable').modal('hide');
      });

      // delete row datatable
      // $('#example tbody').on( 'click', 'img.icon-delete', function () {
      // table
      //         .row( $(this).parents('tr') )
      //         .remove()
      //         .draw();
      // } );
        
      // modal hide
      $('#modalTable').on('hidden.bs.modal', resetForm);
    });
</script>
@endpush