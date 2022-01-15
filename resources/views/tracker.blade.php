@extends('layout.main')
@section('seo-meta')
<title>DocTrack - home</title>
@stop
@section('main')
 <!-- header -->
 @include('layout.header')
<style>
  .card{
    border: 2px dashed #007bff;
    outline: 6px solid aliceblue;
  }
  .card-body::before{
    content: "";
    width: 25px;
    height: 25px;
    background: #fff;
    position: absolute;
    border-radius: 50%;
    left: -14px;
    top: 50%;
    transform: translateY(-50%);
    box-shadow: rgb(0 0 0 / 19%) 2px 1px 0px;
}
  }

  .card-body::after{
    content: "";
    width: 28px;
    height: 28px;
    background: #fff;
    position: absolute;
    border-radius: 50%;
    right: -10px;
    top: 50%;
    transform: translateY(-50%);
  }
</style>
<main class="container">
   <div class="row mt-5">
     <div id="capture-container" class="col-md-6 col-sm-12 col-lg-4 mx-auto">
          <div id="capture" class="card text-white mb-3">
            <!-- <div class="card-header bg-primary">Tracker Number</div> -->
              <div class="card-body" style="background: #eef5ff;">
                <div class="text-center text-primary">
                    <b style="color: orange">Tracker Number</b><br/>
                    <!-- <b style="font-size: 1.4em;">JRB1640778440539</b> -->
                    <b style="font-size: 1.4em;">{{Request::route('tracknum')}}</b>
                    <!-- <br>array_shift
                    <br>array_shift
                    <br>array_shift
                    <br>array_shift
                    <br>array_shift
                     -->
                </div>
              </div>
        </div>
     </div>
   </div>
</main>
@stop

@push('scripts')
    <script>   
      console.log(window.location);
      // @{!! json_encode($sites->toArray()) !!};
 
      $(function(){
        activeNav(window.location.origin+'/doctrack/docs');

        function downloadURI(uri, name) {

            $("#capture-container").append('<a href="'+uri+'" class="btn btn-primary w-100" download="'+name+'" >Download</>');

            // var link = document.createElement("a");
            // link.innerHTML = "CLICK ME";
            // link.download = name;
            // link.href = uri;
            // document.body.appendChild(link);
            // // link.click();
            // clearDynamicLink(link); 
        }

        html2canvas(document.querySelector("#capture")).then(canvas => {
            // document.body.appendChild(canvas)
            var myImage = canvas.toDataURL();
            downloadURI(myImage, "capture.png");
        });
      });
    </script>
@endpush  
