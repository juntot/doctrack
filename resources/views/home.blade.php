@extends('layout.main')
@section('seo-meta')
<title>DocTrack - home</title>
@stop
@section('main')
 <!-- header -->
 @include('layout.header')

<main class="container">
   <div class="row mt-5">
     <div class="col-md-6 col-sm-12 mx-auto">
          <div class="card text-white mb-3">
            <div class="card-header bg-primary">Doc Tracker</div>
            <form action="timeline" method="post">
                <div class="card-body" style="background: #eef5ff;">
                  <div class="d-flex align-content-center justify-content-center align-items-center">
                    <div class="form-group mb-0 mr-4">
                        <input id="inputEmail" type="text" name="docId" placeholder="Enter Reference Code" required="" autofocus="1" class="form-control rounded-pill border-0 shadow-sm px-4 py-4">
                    </div>
                    {{ csrf_field() }}
                    <div>
                      <button class="btn btn-primary">Track Document</button>
                    </div>
                  </div>
                </div>
            </form>
            <div class="card-footer text-dark">
              <small>
                <span>Questions & Clarrfication mail to: <a href="mailto:j.villamor@4th-jarb.com">Jaype da Great</a></span>
              </small>
            </div>
        </div>
     </div>
   </div>
</main>
@stop

@push('scripts')
    <script>   
      document.querySelector('body').classList.add('home');
    </script>
@endpush  
