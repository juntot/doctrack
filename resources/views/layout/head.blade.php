<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('seo-meta')
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"> -->
    <link rel="icon" href="public/favicon.ico" />
    
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css"> -->
    <link rel="stylesheet" href="{{URL::asset('resources/css/fontawesome/fa-all.css')}}">
    
    <link rel="stylesheet" href="{{URL::asset('resources/css/bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('resources/css/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">

    <link rel="stylesheet" href="{{URL::to('/public/css/app.css')}}">
    <style>
      nav {
        display: block;
        position: relative;
        overflow: auto;
        box-shadow: rgb(0 0 0 / 4%) 0px 3px 5px;
      }
      nav ul {
        margin: 0;
        padding: 0;
        list-style: none;
      }
      nav ul li{
        float: left;
      }
      nav ul li a{
        display: block;
        padding: 25px 8px;
        height: 100%;
        color: var(--accent-gray-color);
      }

      nav ul li a:hover{
        text-decoration: none;
        /* outline: 1px solid var(--light-blue); */
        /* background: #25c4dd; */
        color: #007bff!important;
      }

      nav ul li:first-child a{
        /* padding: 15px; */
      }
      nav ul li:first-child a:hover{
        background: none;
        color: var(--accent-gray-color);
      }

      nav ul li a.active{
        background: var(--turquoise-color);
        color: #007bff!important;
      }

      /* mobile */
      .mobile-nav{
        width: 23px;
        height: 4px;
        background: #525252;
        position: relative;
      }
      .mobile-nav::before{
        content: "";
        position: absolute;
        width: 16px;
        height: 4px;
        top: -7px;
        background: #525252;
      }

      .mobile-nav::after{
        content: "";
        position: absolute;
        width: 23px;
        height: 4px;
        top: 7px;
        background: #525252;
      }
      .mobile-nav.active{
        background: transparent;
        
      }

      .mobile-nav.active::before {
        transform: rotate(-45deg);
        top: 0;
        width: 23px;
        transition: 1s ease;
      }
      .mobile-nav.active::after {
        transform: rotate(45deg);
        top: 0;
        transition: .5s linear;
      }

      .mobile-btn{
        display: none;
      }

    @media screen and (max-width:768px) {
      .mobile-btn{
        display: block;
      }
      nav ul{
        position: fixed;
        left: -999px;
        top: 0;
        bottom: 0;
        z-index: 2;
        padding: 15px;
        background: white;
        transition: .8s all ease;
      }

      nav ul li{
        float: none;
      }
      nav ul li a{
        padding: 10px 0;
      }

      nav ul.active{
        left: 0px;
        width: 200px;
      }
      
    }
    </style>
</head>