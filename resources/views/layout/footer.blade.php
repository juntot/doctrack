<footer >
    <!-- change pASS MODAL -->
    <!-- The Modal -->
    <div class="modal" id="myModalChangePass">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Change Password</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <form method="post" action="change-pass">
              <!-- Modal body -->
              <div class="modal-body">
                  <div class="row">
                    <div class="form-group col-12">
                      <label for="password">New Password:</label>
                      <input type="text" name="password" class="form-control" id="password" required>
                    </div>
                  </div>
              </div>
              {{ csrf_field() }}
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Save">
              </div>
          </form>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        
      </div>
    </div>
    <script src="{{URL::asset('resources/js/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('resources/js/axios/axios.min.js')}}"></script>
    
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    
    <script src="{{URL::asset('resources/js/bootstrap/js/bootrap4.min.js')}}"></script>
    <script src="{{URL::asset('resources/js/bootstrap/js/pooper.min.js')}}"></script>
    
    <!-- <script src="{{URL::asset('https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js')}}"></script> -->
    <!-- <script src="{{URL::asset('https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js')}}"></script> -->
    <script src="{{URL::asset('resources/js/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('resources/js/datatables/jquery.dataTables.min.js')}}"></script>
    
    <script src="{{URL::asset('resources/js/moment/moment2.22.2.min.js')}}"></script>
	  <script src="{{URL::asset('resources/js/moment/moment-with-locales.js')}}"></script>
	  <script src="{{URL::asset('resources/js/moment/moment-timezone-with-data-10-year-range.js')}}"></script>

    <script src="{{URL::asset('resources/js/html2canvas/html2canvas.js')}}"></script>
    <script>
       function activeNav(nav){

          let home = true;
          for (const iterator of $('nav ul li a')) {
            if(nav){
                $(iterator).removeClass('active');
                if($(iterator).attr('href') == nav)
                $(iterator).addClass('active');
                home = false;
                // return;
            }
            else{
                $(iterator).removeClass('active');
                if(window.location.href == $(iterator).attr('href')) {
                  $(iterator).addClass('active');
                  home = false;
                }
            }
            

          }
            // $('nav ul li a').map(function(){
            //   // force set active
            //   if($(this).attr('href') == nav){
            //     $(this).addClass('active');
            //     home = false;
            //   }else{
            //     $(this).removeClass('active');
            //     if(window.location.href == $(this).attr('href')) {
            //       $(this).addClass('active');
            //       home = false;
            //     }
            //   }
            // });
            if(home){
              $('nav ul li a.home').addClass('active')
            }
        }
        $(function(){
            // set active nav
            activeNav();

            // mobile nav
            $('.mobile-btn').click(function(){
              $('nav ul').toggleClass('active');
              $('.mobile-nav').toggleClass('active');              
            });
        });
    </script>
    @stack('scripts')
</footer>
