@extends('layout.main')
@section('seo-meta')
<title>BIS - home</title>
@stop
@section('main')
 <!-- header -->
@include('layout.header')


<link rel="stylesheet" href="{{URL::asset('resources/css/bootstrap4.min.css')}}">
<!-- href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->

<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->
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
<div class="container mt-5 mb-5">
	<div class="row">
		<div class="col-md-6 offset-md-3">
            @if(empty($timeline))
            <div class="text-center">
                <h2 class="text-secondary">
                    No Results found for Document # <br>
                    <span class="text-warning">{{$docId}}</span>
                </h2>
                <a href="{{ URL::to('/') }}" class="btn btn-primary">Go Back</a>
            </div>
            @else
            <h5 class="text-secondary">
                Document Timeline - {{$docId}}
            </h5>
            @endif
			<ul class="timeline">
                @if(!empty($timeline->history))
                    @foreach($timeline->history as $index => $history)
                        <li>
                            <div class="p-3" style="box-shadow: 0 1px 6px rgb(0 0 0 / 18%);">
                                <a href="#">{{ $index > 0? 'recieved': 'from'}}: {{$history->from}}</a>
                                <small class="float-right"><em class="text-primary">{{ \Carbon\Carbon::parse($history->datesubmitted)->format('d, M - Y')}}</em></small>
                                <p>{{$history->remarks}}</p>

                                @if(!empty($history->file))
                                <div>
                                    <small class="text">
                                        <em>Attachment:</em>
                                    </small><br/>
                                    <a href="storage/app/${data.file}" target="_blank">
                                        {{$history->remarks}}
                                    </a>
                                </div>
                                @endif
                            </div>
                        </li>
                    @endforeach
                    
                    @if($timeline->status == 1)
                    <li>
                        <div class="p-3 bg-success" style="box-shadow: 0 1px 6px rgb(0 0 0 / 18%);">
                            <span class="text text-white">Confirmed</span>
                        </div>
                    </li>
                    @else
                    <li>
                        <div class="p-3 bg-warning" style="box-shadow: 0 1px 6px rgb(0 0 0 / 18%);">
                            <span class="text">Forwarded To: {{$timeline->deptName}}</span>
                        </div>
                    </li>
                    @endif
                @endif
				<!-- <li>
                    <div class="p-3" style="box-shadow: 0 1px 6px rgb(0 0 0 / 18%);">
                        <a href="#">Recieved</a>
                        <small class="float-right"><em class="text-primary">4 March, 2014</em></small>
                        <p>Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>
                    </div>
				</li>
				<li>
                    <div class="p-3" style="box-shadow: 0 1px 6px rgb(0 0 0 / 18%);">
                        <a href="#">Recieved</a>
                        <small class="float-right"><em class="text-primary">1 April, 2014</em></small>
                        <p>Fusce ullamcorper ligula sit amet quam accumsan aliquet. Sed nulla odio, tincidunt vitae nunc vitae, mollis pharetra velit. Sed nec tempor nibh...</p>
                    </div>
				</li> -->
			</ul>
		</div>
	</div>
</div>


@stop