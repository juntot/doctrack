@extends('layout.main')
@section('seo-meta')
<title>DocTrack - docs</title>
@stop
@section('main')
 <!-- header -->
 @include('layout.header')

<main class="container mt-4">
      <form action="" method="post">
        <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputState">Forward To</label>
              <select id="inputState" class="form-control" name="to">
                <option disabled>Choose...</option>
                <option value="IT">IT-Department</option>
                <option value="Audit">Audit Department</option>
                <option value="HR">HR-Department</option>
              </select>
            </div>
            <div class="form-group col-12">
              <label for="inputAddress2" >Remarks</label>
              <textarea name="remarks" class="form-control" cols="30" rows="10"></textarea>
            </div>
            
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
   </div>
</main>
@stop
