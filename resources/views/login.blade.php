<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DocTrack - login</title>
  <style>
    .comp-logo{
        width: 100%;
        height: auto;
        max-width: 450px;
      }
      .login,
      .image {
        min-height: 100vh;
      }

      .bg-image {
        background-image: url('public/img/woman.jpg');
        background-size: cover;
        background-position: center center;
        position: relative;
      }

      .bg-image:after{
        content: "";
        position: absolute;
        /* background: rgba(17, 97, 238, .9); */
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
      }

    .login-trans-box{
      position: absolute;
      left:0;
      top:0;
      right:0;
      bottom: 0;
    }
    .login-box {
      width: 100%;
      margin: auto;
      max-width: 525px;
      min-height: 500px;
      position: relative;
    }

    .login-snip {
      width: 100%;
      height: 100%;
      position: absolute;
    }

    .login-snip .login-form,
    .login-snip .sign-up-form {
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      position: absolute;
      transform: rotateY(180deg);
      backface-visibility: hidden;
      transition: all .4s linear
    }

    .login-snip .sign-in,
    .login-snip .sign-up,
    .login-space .group .check {
      display: none
    }


    .login-snip .tab {
      /* font-size: 22px; */
      margin-right: 15px;
      padding-bottom: 5px;
      margin: 0 15px 2rem 0;
      display: inline-block;
      border-bottom: 2px solid transparent
    }

    .login-snip .sign-in:checked+.tab,
    .login-snip .sign-up:checked+.tab {
      color: #1161ee;
      border-color: #1161ee
    }

    .login-space {
      min-height: 345px;
      position: relative;
      perspective: 1000px;
      transform-style: preserve-3d
    }

    .login-space .group {
      margin-bottom: 15px
    }

    .login-space .group .label,
    .login-space .group .input,
    .login-space .group .button {
      width: 100%;
      /* color: #fff; */
      display: block
    }

    .login-space .group .input,
    .login-space .group .button {
      border: none;
      padding: 15px 20px;
      border-radius: 25px;
      background: rgba(255, 255, 255, 1)
    }

    .login-space .group input[data-type="password"] {
      text-security: circle;
      -webkit-text-security: circle
    }

    .login-space .group .label {
      color: #aaa;
      font-size: 12px
    }

    .login-space .group .button {
      background: #1161ee
    }

    .login-space .group label .icon {
      width: 15px;
      height: 15px;
      border-radius: 2px;
      position: relative;
      display: inline-block;
      background: rgba(255, 255, 255, .1)
    }

    .login-space .group label .icon:before,
    .login-space .group label .icon:after {
      content: '';
      width: 10px;
      height: 2px;
      background: #fff;
      position: absolute;
      transition: all .2s ease-in-out 0s
    }

    .login-space .group label .icon:before {
      left: 3px;
      width: 5px;
      bottom: 6px;
      transform: scale(0) rotate(0)
    }

    .login-space .group label .icon:after {
      top: 6px;
      right: 0;
      transform: scale(0) rotate(0)
    }

    .login-space .group .check:checked+label {
      color: #fff
    }

    .login-space .group .check:checked+label .icon {
      background: #1161ee
    }

    .login-space .group .check:checked+label .icon:before {
      transform: scale(1) rotate(45deg)
    }

    .login-space .group .check:checked+label .icon:after {
      transform: scale(1) rotate(-45deg)
    }

    .login-snip .sign-in:checked+.tab+.sign-up+.tab+.login-space .login-form {
      transform: rotate(0)
    }

    .login-snip .sign-up:checked+.tab+.login-space .sign-up-form {
      transform: rotate(0)
    }

    *,
    :after,
    :before {
      box-sizing: border-box
    }

    .clearfix:after,
    .clearfix:before {
      content: '';
      display: table
    }

    .clearfix:after {
      clear: both;
      display: block
    }

    a {
      color: inherit;
      text-decoration: none
    }

    .foot{
      text-align: center;
    }
    
    .foot label{
      color: #007bff;
      text-decoration: underline;
      cursor: pointer;
    }
]

  
  </style>
  <link rel="stylesheet" href="{{URL::asset('resources/css/twitterbootstrap.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('resources/css/bootstrap4.min.css')}}">

  <script src="{{URL::asset('resources/js/jquery/jquery.min.js')}}"></script>
  <script src="{{URL::asset('resources/js/bootstrap/js/bootrap4.min.js')}}"></script>
    <script src="{{URL::asset('resources/js/bootstrap/js/pooper.min.js')}}"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-6 d-none d-md-flex bg-image"></div>


        <!-- The content half -->
        <div class="col-md-6 bg-light">
            <div class="login d-flex align-items-center py-5">

                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                                <a href="{{URL::to('/')}}">
                                  <img src="{{URL::to('/public/img/JarbLogo.png')}}" class="comp-logo">
                                </a>
                            <!-- <div class="card"> -->
                                  <div class="login-box">
                                      <div class="login-snip"> 
                                          <input id="tab-1" type="radio" name="tab" class="sign-in" checked="">
                                          <label for="tab-1" class="text-muted tab">Login</label> 
                                          <input id="tab-2" type="radio" name="tab" class="sign-up">
                                          <label for="tab-2" class="text-muted tab">Sign Up</label>
                                          
                                          <div class="login-space">
                                              <div class="login-form">
                                                <form action="login" method="post">
                                                  <div class="group"> 
                                                    <input id="user" type="email" name="email" class="input" placeholder="Enter your email" required> </div>
                                                  <div class="group pb-2"> 
                                                    <input id="pass" type="password" name="password" class="input" data-type="password" placeholder="Enter your password" required> 
                                                  </div>
                                                  @if($errors->any())
                                                    <div v-show="err_msg" class="text-danger errors text-center">{{$errors->first()}}</div>
                                                  @endif
                                                  <div class="group"> 
                                                    <input type="submit" class="button btn btn-primary" value="Sign In"> </div>
                                                  <div class="foot"> <a href="#" data-toggle="modal" data-target="#myModalChangePass">Forgot Password?</a> </div>
                                                  {{ csrf_field() }}
                                                </form>
                                              </div>
                                              <div class="sign-up-form">
                                                  <form method="post" action="new-user">
                                                    <div class="group"> 
                                                      <input id="user" name="email" type="email" class="input" placeholder="Email" required> </div>
                                                    <div class="group"> 
                                                      <input id="user" name="firstName" type="text" class="input" placeholder="First Name" required> </div>
                                                    <div class="group"> 
                                                      <input id="user" name="lastName" type="text" class="input" placeholder="Last Name" required> </div>
                                                    <div class="group"> 
                                                      <input id="pass" name="password" type="password" class="input" data-type="password" placeholder="Create your password" required> </div>
                                                    <div class="group"> 
                                                      <input type="submit" class="button btn btn-primary" value="Sign Up"> </div>
                                                    <div class="foot"> 
                                                      <label for="tab-1">Already Member?</label>
                                                    </div>
                                                  {{ csrf_field() }}
                                                </form>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                        </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->

    </div>
</div>
<!-- RESET PASS MODAL -->
    <!-- The Modal -->
    <div class="modal" id="myModalChangePass">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Forget Password</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <form method="post" action="api/mail">
              <!-- Modal body -->
              <div class="modal-body">
                  <div class="row">
                    <div class="form-group col-12">
                      <label for="password">Enter Email:</label>
                      <input type="text" name="email" class="form-control" id="password" placeholder="Email Address" required>
                    </div>
                  </div>
              </div>
              {{ csrf_field() }}
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Continue">
              </div>
          </form>
        </div>
      </div>
    </div>

</body>
</html>