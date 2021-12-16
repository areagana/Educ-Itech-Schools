<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>EDUC-ITECH</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sidebars/">
    <link rel='stylesheet' href='{{asset("css/sidebar.css")}}'>

    <!-- major script-->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{asset('js/sidebar.js') }}"></script>
        
        <!--xdialog javascript-->
        <script src="{{ asset('js/xdialog.3.4.0.min.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('css/xdialog.3.4.0.min.css') }}" rel="stylesheet">
    
    <!-- Bootstrap core CSS -->
<!--<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">-->

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="sidebars.css" rel="stylesheet">

    <!--favicon-->
      <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
      <link rel="manifest" href="/manifest.json">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
      <meta name="theme-color" content="#ffffff">

      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="bootstrap" viewBox="0 0 118 94">
        <title></title>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
      </symbol>
      <symbol id='person' viewBox="0 0 122.88 85.7">
        <path class="st0" d="M0,85.7c1-12.96-1.54-12.4,9.31-16.46c5.42-2.03,12.34-4.6,17.31-7.71l9.31,24.17H0L0,85.7L0,85.7z M82.85,32.11c-0.77-0.11-1.31-0.84-1.21-1.64c0.1-0.8,0.81-1.36,1.58-1.25l23.15,3.39c0.77,0.11,1.31,0.84,1.21,1.64 c-0.1,0.8-0.81,1.36-1.58,1.25L82.85,32.11L82.85,32.11z M85.34,23.23c-0.77-0.11-1.31-0.84-1.2-1.64c0.1-0.8,0.81-1.36,1.58-1.25 l11.74,1.77c0.77,0.11,1.31,0.84,1.21,1.64c-0.1,0.8-0.81,1.36-1.58,1.25L85.34,23.23L85.34,23.23z M86.76,14.04 c-0.77-0.11-1.31-0.84-1.21-1.64c0.1-0.8,0.81-1.36,1.58-1.25l23.15,3.39c0.77,0.11,1.31,0.84,1.21,1.64 c-0.1,0.8-0.81,1.36-1.58,1.25L86.76,14.04L86.76,14.04z M46.56,72.85h1.3c1.17,0,2.13-0.96,2.13-2.13v-3.45 c0-1.17-0.96-2.13-2.13-2.13h-7.71c-1.17,0-2.13,0.96-2.13,2.13v3.45c0,1.17,0.96,2.13,2.13,2.13h1.32L38.94,85.7h10.05 L46.56,72.85L46.56,72.85L46.56,72.85z M104.67,5.63L87.25,3.32c-1.14-0.15-2.22-0.09-3.21,0.18c-0.99,0.27-1.94,0.74-2.84,1.42 c-0.89,0.68-1.59,1.47-2.12,2.36c-0.52,0.89-0.85,1.91-1.01,3.05l-2.26,17.01c-0.15,1.14-1.39,4.82-1.12,5.81 c0.27,0.99,0.74,1.94,1.43,2.84c0.7,0.89,1.49,1.62,2.38,2.12c0.89,0.51,1.89,0.85,3.03,1l7.48,0.99c0.87,0.12,1.5,0.93,1.38,1.81 c-0.03,0.2-0.09,0.37-0.16,0.53c-0.42,1.01-0.87,2.02-1.36,2.98c-0.51,1.02-1.04,1.98-1.61,2.9c-0.29,0.47-0.61,0.92-0.96,1.38 c1.62-0.48,3.17-1.07,4.62-1.77c1.52-0.73,2.97-1.58,4.31-2.54c1.38-0.97,2.63-2.08,3.81-3.28c0.37-0.38,0.87-0.52,1.36-0.46 l6.43,0.85c1.14,0.15,2.19,0.09,3.19-0.18c0.99-0.27,1.94-0.74,2.86-1.42c0.89-0.68,1.59-1.47,2.12-2.36 c0.52-0.89,0.85-1.91,1.01-3.05l3.55-19.61c0.15-1.14,0.09-2.22-0.18-3.21s-0.74-1.95-1.42-2.84c-0.68-0.89-1.47-1.59-2.37-2.12 c-0.89-0.51-1.91-0.85-3.05-1.01l-7.89-1.05L104.67,5.63L104.67,5.63L104.67,5.63L104.67,5.63z M95.57,1.18l17.42,2.3 c1.53,0.21,2.94,0.68,4.21,1.4c1.26,0.72,2.37,1.71,3.32,2.96c0.95,1.24,1.61,2.57,1.99,3.98c0.37,1.41,0.46,2.89,0.26,4.44 l-3.56,19.61c-0.21,1.55-0.68,2.96-1.4,4.21c-0.72,1.26-1.71,2.37-2.96,3.32c-1.24,0.95-2.57,1.59-3.98,1.99 c-1.4,0.37-2.89,0.47-4.44,0.26l-5.64-0.75c-1.15,1.12-2.38,2.16-3.65,3.08c-1.52,1.09-3.12,2.04-4.8,2.83 c-1.69,0.82-3.47,1.49-5.34,2.03c-1.85,0.53-3.81,0.92-5.85,1.18c-0.58,0.08-1.18-0.18-1.53-0.69c-0.5-0.73-0.31-1.73,0.43-2.24 c1.03-0.68,1.92-1.42,2.66-2.16c0.72-0.73,1.33-1.49,1.82-2.3v-0.02c0.53-0.86,1.03-1.75,1.48-2.65c0.15-0.32,0.31-0.65,0.47-0.98 l-5.38-0.71c-1.53-0.2-2.94-0.68-4.21-1.41c-1.26-0.72-2.38-1.71-3.32-2.96c-0.95-1.24-1.61-2.57-1.99-3.98 c-0.37-1.42,0.85-5.51,1.04-7.03l2.27-17.01c0.21-1.53,0.68-2.94,1.4-4.21c0.72-1.26,1.71-2.38,2.96-3.32 c1.24-0.95,2.57-1.61,3.98-1.99c1.4-0.37,2.89-0.47,4.43-0.26l7.88,1.05L95.57,1.18L95.57,1.18L95.57,1.18L95.57,1.18z M33.07,54.1 c0.24-1.99-5.66-9.59-6.74-13.23c-2.31-3.67-3.13-9.51-0.61-13.39c1-1.54,0.57-4.28,0.57-6.41c0-21.12,37.01-21.13,37.01,0 c0,2.67-0.61,4.7,0.83,6.81c2.42,3.51,1.18,9.74-0.87,13c-1.31,3.83-7.5,11.06-7.07,13.23C56.58,64.95,33,64.59,33.07,54.1 L33.07,54.1L33.07,54.1z M61.8,60.43c4.55,2.91,11,5.3,16.16,7.02c10.13,3.37,10.1,3.84,10.03,18.25H52.19L61.8,60.43L61.8,60.43 L61.8,60.43z"/>
      </symbol>
      <symbol id='bell' viewBox="0 0 120.641 122.878">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M68.16,6.889c18.129,3.653,31.889,19.757,31.889,38.921 c0,22.594-2.146,39.585,20.592,54.716c-40.277,0-80.366,0-120.641,0C22.8,85.353,20.647,68.036,20.647,45.81 c0-19.267,13.91-35.439,32.182-38.979C53.883-2.309,67.174-2.265,68.16,6.889L68.16,6.889z M76.711,109.19 c-1.398,7.785-8.205,13.688-16.392,13.688c-8.187,0-14.992-5.902-16.393-13.688H76.711L76.711,109.19z"/>
      </symbol>
      <symbol id="home" viewBox="0 0 16 16">
        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
      </symbol>
      <symbol id="speedometer2" viewBox="0 0 16 16">
        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
      </symbol>
      <symbol id="table" viewBox="0 0 16 16">
        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
      </symbol>
      <symbol id="people-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
      </symbol>
      <symbol id="grid" viewBox="0 0 16 16">
        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
      </symbol>
      <symbol id="collection" viewBox="0 0 16 16">
        <path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13z"/>
      </symbol>
      <symbol id="calendar3" viewBox="0 0 16 16">
        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
      </symbol>
      <symbol id="chat-quote-fill" viewBox="0 0 16 16">
        <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM7.194 6.766a1.688 1.688 0 0 0-.227-.272 1.467 1.467 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 5.734 6C4.776 6 4 6.746 4 7.667c0 .92.776 1.666 1.734 1.666.343 0 .662-.095.931-.26-.137.389-.39.804-.81 1.22a.405.405 0 0 0 .011.59c.173.16.447.155.614-.01 1.334-1.329 1.37-2.758.941-3.706a2.461 2.461 0 0 0-.227-.4zM11 9.073c-.136.389-.39.804-.81 1.22a.405.405 0 0 0 .012.59c.172.16.446.155.613-.01 1.334-1.329 1.37-2.758.942-3.706a2.466 2.466 0 0 0-.228-.4 1.686 1.686 0 0 0-.227-.273 1.466 1.466 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 10.07 6c-.957 0-1.734.746-1.734 1.667 0 .92.777 1.666 1.734 1.666.343 0 .662-.095.931-.26z"/>
      </symbol>
      <symbol id="cpu-fill" viewBox="0 0 16 16">
        <path d="M6.5 6a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
        <path d="M5.5.5a.5.5 0 0 0-1 0V2A2.5 2.5 0 0 0 2 4.5H.5a.5.5 0 0 0 0 1H2v1H.5a.5.5 0 0 0 0 1H2v1H.5a.5.5 0 0 0 0 1H2v1H.5a.5.5 0 0 0 0 1H2A2.5 2.5 0 0 0 4.5 14v1.5a.5.5 0 0 0 1 0V14h1v1.5a.5.5 0 0 0 1 0V14h1v1.5a.5.5 0 0 0 1 0V14h1v1.5a.5.5 0 0 0 1 0V14a2.5 2.5 0 0 0 2.5-2.5h1.5a.5.5 0 0 0 0-1H14v-1h1.5a.5.5 0 0 0 0-1H14v-1h1.5a.5.5 0 0 0 0-1H14v-1h1.5a.5.5 0 0 0 0-1H14A2.5 2.5 0 0 0 11.5 2V.5a.5.5 0 0 0-1 0V2h-1V.5a.5.5 0 0 0-1 0V2h-1V.5a.5.5 0 0 0-1 0V2h-1V.5zm1 4.5h3A1.5 1.5 0 0 1 11 6.5v3A1.5 1.5 0 0 1 9.5 11h-3A1.5 1.5 0 0 1 5 9.5v-3A1.5 1.5 0 0 1 6.5 5z"/>
      </symbol>
      <symbol id="gear-fill" viewBox="0 0 16 16">
        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
      </symbol>
      <symbol id="speedometer" viewBox="0 0 16 16">
        <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
        <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z"/>
      </symbol>
      <symbol id="toggles2" viewBox="0 0 16 16">
        <path d="M9.465 10H12a2 2 0 1 1 0 4H9.465c.34-.588.535-1.271.535-2 0-.729-.195-1.412-.535-2z"/>
        <path d="M6 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 1a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm.535-10a3.975 3.975 0 0 1-.409-1H4a1 1 0 0 1 0-2h2.126c.091-.355.23-.69.41-1H4a2 2 0 1 0 0 4h2.535z"/>
        <path d="M14 4a4 4 0 1 1-8 0 4 4 0 0 1 8 0z"/>
      </symbol>
      <symbol id="tools" viewBox="0 0 16 16">
        <path d="M1 0L0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.356 3.356a1 1 0 0 0 1.414 0l1.586-1.586a1 1 0 0 0 0-1.414l-3.356-3.356a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0zm9.646 10.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708zM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11z"/>
      </symbol>
      <symbol id="chevron-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
      </symbol>
      <symbol id="geo-fill" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z"/>
      </symbol>
      <symbol id='classes' viewBox="0 0 122.88 119.98">
        <path d="M92,57.93h5.69a.23.23,0,0,0,.16-.06.26.26,0,0,0,.07-.16v-9a.23.23,0,0,0-.06-.16.28.28,0,0,0-.17-.07H27.11a.24.24,0,0,0-.17.07.23.23,0,0,0-.06.16v9a.23.23,0,0,0,.06.16.24.24,0,0,0,.17.06H92ZM60.73,107.7c-11.82,0-4,.92-2.42-11.93,2.41-19.22,20.68-19.22,23.38,0,1.73,12.36,9.14,11.93-2.43,11.93H74.64c0,3.15-.5,2.79,2.75,4.55,1.67.9,4.77,1.58,7.42,2.62,4-3.45,11.21-1.17,12-7.5.12-1-2.16-3.35-2.67-5.1-1.12-1.79-1.52-4.6-.3-6.48.48-.75.29-1.77.29-2.8,0-10.24,17.93-10.25,17.93,0,0,1.29-.29,2,.4,3,1.17,1.71.57,4.73-.42,6.3-.64,1.86-3,4.06-2.85,5.1,1.66,8.44,12.7-.35,13.74,12.6H0c1.32-15.21,18.35-5.86,19.6-16.44.14-1.2-2.69-4.44-3.34-6.63-1.39-2.21-1.88-5.72-.37-8.06.61-.93.35-1.82.35-3.09,0-12.72,22.29-12.73,22.29,0,0,1.6-.37,2.06.5,3.33,1.46,2.11.71,5.86-.52,7.82-.79,2.3-3.8,5.33-3.54,6.63,1.87,9.5,14.36,2,17.74,12.53,2.73-1.68,7.33-2.3,10.22-4s2.38-1.47,2.36-4.33ZM94.06,61.63v19a14.64,14.64,0,0,0-3.69,3V61.63H35.31v9.05c-.35-.15-.7-.28-1.06-.4a21,21,0,0,0-2.63-.73V61.63H27.11a4,4,0,0,1-2.77-1.15h0a3.9,3.9,0,0,1-1.15-2.76v-9A3.9,3.9,0,0,1,24.34,46h0a3.91,3.91,0,0,1,2.77-1.15h3.58V30.49a1.81,1.81,0,0,1,.48-1.24l5.26-6.62a5.69,5.69,0,1,1,2.88,2.29l-4.93,6.2V44.83h4.78c0-4.46,0-5.8,5.88-9.07,2.47-1.38,8.87-1.85,11.65-3.68A24.62,24.62,0,0,0,57.88,29l0-.08a25.32,25.32,0,0,1-2.66-3.68l-2.3-3.66a6.57,6.57,0,0,1-1.3-3.33,2.58,2.58,0,0,1,.22-1.2,2.26,2.26,0,0,1,.79-.92,2.93,2.93,0,0,1,.56-.28,57.2,57.2,0,0,1-.11-6.57,8.57,8.57,0,0,1,.28-1.48A9.65,9.65,0,0,1,59.76,1.6c1.43-.5.88-1.68,2.32-1.6,3.43.19,8.72,2.4,10.75,4.74,2.85,3.29,2.12,7.33,2,11.34h0a1.63,1.63,0,0,1,1.21,1.25,5.12,5.12,0,0,1-.63,3.14h0a.25.25,0,0,1,0,.07l-2.62,4.31a21,21,0,0,1-3.4,4.61l-.07.06.43.61c.45.67,1,1.43,1.45,2,2.84,1.77,9.1,2.25,11.55,3.61,5.35,3,5,4.78,5,9.07h9.89A3.9,3.9,0,0,1,100.42,46h0a3.9,3.9,0,0,1,1.15,2.76v9a3.91,3.91,0,0,1-1.15,2.77,4,4,0,0,1-2.77,1.15ZM60.88,44.83h0l1.84-8.74a3.91,3.91,0,0,1-.18-.35,14.1,14.1,0,0,1-2.24.72c-1-.3-1.13-2.61,0-3.33a12.56,12.56,0,0,1,2.44,1,1.86,1.86,0,0,1,2.22,0c.63-.42,1.26-.71,2-1.12,1.49.75,2,3.16-.11,3.68A5.16,5.16,0,0,1,65.4,36l-.05.13,1.85,8.74h0a39,39,0,0,0,3.22-11.45,25.47,25.47,0,0,1-1.84-2.49l-.36-.53a7.58,7.58,0,0,1-4.42,1.3A7.44,7.44,0,0,1,59,29.93a15,15,0,0,1-1.41,3.28l-.13.13a48.44,48.44,0,0,0,3.43,11.49ZM54.53,16.9a2.26,2.26,0,0,0-1.15.3.91.91,0,0,0-.34.39,1.29,1.29,0,0,0-.1.61A5.38,5.38,0,0,0,54,20.87h0l2.3,3.65a19.46,19.46,0,0,0,3.08,4.06,6.33,6.33,0,0,0,4.41,1.77,6.45,6.45,0,0,0,4.66-1.85,20.45,20.45,0,0,0,3.18-4.33l2.58-4.26a4.09,4.09,0,0,0,.55-2.27c-.06-.26-.35-.38-.83-.41h-.32l-.36,0a.66.66,0,0,1-.2,0,3.42,3.42,0,0,1-.71,0l.89-3.92c-6.58,1-11.5-3.85-18.45-1l.51,4.62a3.48,3.48,0,0,1-.8,0Zm-3.86,81H45.84a18.15,18.15,0,0,0,.94-3.69h4.57l-.09.68h0a20.54,20.54,0,0,1-.61,3Z"/>
      </symbol>
      <symbol id='exams' viewBox="0 0 122.88 98.62">
        <path class="cls-1" d="M30.22,55.25l-.11,7H42.65A4.84,4.84,0,0,1,47.48,67v4.83h0V90.73a4.85,4.85,0,0,1-4.83,4.83H37.77v-22c0-2,.38-1.75-1.54-1.75H23.81v0H17.62a7.29,7.29,0,0,1-7.26-7.26V40.79a7.4,7.4,0,0,1,7.38-7.39h3.65c5.79,0,6.37,2.77,7.85,5.67l6.17,2.43c4.46,2,3.32,2.41,6.35-1.34l3.94-4.89c1.93-3.08,9.56.14,6.29,5.31l-5.72,7.81c-2.39,3.26-5.55,3.72-9.38,2.12l-6.67-2.35v7.09ZM57.57,31.38a14.8,14.8,0,0,0,16.57,2.83l5.13,2-1.7-4c5.7-4.57,4.68-10.85.48-15.13a14.8,14.8,0,0,1-1.63,4.65,17.2,17.2,0,0,1-4.72,5.37,21,21,0,0,1-6.59,3.34,23.72,23.72,0,0,1-7.54,1Zm7.88-19.24a2.23,2.23,0,1,1-2.23,2.23,2.23,2.23,0,0,1,2.23-2.23Zm-14.75,0a2.23,2.23,0,1,1-2.23,2.23,2.23,2.23,0,0,1,2.23-2.23Zm7.38,0a2.23,2.23,0,1,1-2.23,2.23,2.23,2.23,0,0,1,2.23-2.23ZM58.52,0h0A19.85,19.85,0,0,1,70.8,4.53a13.25,13.25,0,0,1,4.94,10.39v0a13.27,13.27,0,0,1-5.56,10.12,19.88,19.88,0,0,1-12.54,3.79,21.34,21.34,0,0,1-3.9-.47,19.82,19.82,0,0,1-3.33-1l-7.67,3,2.56-6.1a14.6,14.6,0,0,1-3.55-4.48,12.27,12.27,0,0,1-1.33-5.89A13.24,13.24,0,0,1,46,3.8,19.87,19.87,0,0,1,58.51,0Zm-.05,1.87h0A18,18,0,0,0,47.11,5.3,11.41,11.41,0,0,0,42.29,14a10.4,10.4,0,0,0,1.14,5A13.11,13.11,0,0,0,47,23.28l.56.44L46.19,27l4.24-1.66.35.15a18.7,18.7,0,0,0,3.35,1.05,19.8,19.8,0,0,0,3.56.44,18,18,0,0,0,11.36-3.41,11.41,11.41,0,0,0,4.81-8.65v0A11.37,11.37,0,0,0,69.58,6a18,18,0,0,0-11.1-4.08ZM118.91,91a1.39,1.39,0,0,0-.4-.81,17.79,17.79,0,0,0-6.19-4,20.8,20.8,0,0,0-5.44-1.29l.37-5.75h13.1a2.49,2.49,0,0,0,2.48-2.49c0-10.27-2.42-18,0-29.7.72-3.47-6.44-4-6.44.18V73.52H91.62c-1.36,0-2.48,1.82-2.48,3.18v1.94a.55.55,0,0,0,.55.55h13.14l.51,5.69a20.85,20.85,0,0,0-5.77,1.2,18.25,18.25,0,0,0-6,3.6,1.41,1.41,0,0,0-.41,1.39,2.26,2.26,0,0,0-1.06,2.11,2.64,2.64,0,1,0,5.28,0,2.27,2.27,0,0,0-1.08-2.12,15.7,15.7,0,0,1,4.25-2.33,18,18,0,0,1,5.54-1.06l.29,2.85v.12a2.53,2.53,0,0,0-1.93,2.54,2.64,2.64,0,1,0,5.27,0,2.51,2.51,0,0,0-1.91-2.53v-.14L106,87.7a17.38,17.38,0,0,1,5.28,1.16h0a15.24,15.24,0,0,1,4.22,2.44,2.11,2.11,0,0,0-.79,1.88,2.9,2.9,0,0,0,2.64,2.64A2.84,2.84,0,0,0,120,93.18a2.27,2.27,0,0,0-1.1-2.14ZM97.78,10.6a10.1,10.1,0,1,0,10.1,10.1,10.1,10.1,0,0,0-10.1-10.1Zm-4.2,39.62.19,12H81.23A4.84,4.84,0,0,0,76.4,67v4.83h.06V90.73a4.84,4.84,0,0,0,4.82,4.83h4.83V73.24c0-2.12.8-1.39,3.19-1.39h10.78v0h6.19a7.29,7.29,0,0,0,7.26-7.26V39.37A7.4,7.4,0,0,0,106.15,32h-3.66c-7.6,0-6.39,5.24-9.76,8.53s-2.48,3.62-7,3.62H75.92c-4.39-.09-5.23,8,1,7.63h9c4,0,4.34.64,7.64-1.55ZM80.45,53.33H45a.43.43,0,0,0-.43.43v6.15a.44.44,0,0,0,.43.43H58.64V98a.58.58,0,0,0,.57.57h6.51a.57.57,0,0,0,.56-.57V60.34H80.45a.43.43,0,0,0,.43-.43V53.76a.43.43,0,0,0-.43-.43ZM1.34,48.44H4.86a1.4,1.4,0,0,1,1.31,1.3,155.84,155.84,0,0,1,2,25.16H32.26A1.74,1.74,0,0,1,34,76.63v3.49H32.61V98a.53.53,0,0,1-.53.52H27.47a.53.53,0,0,1-.53-.52V90.21H7.23c-.29,2.37-.64,4.73-1.06,7.1a1.42,1.42,0,0,1-1.31,1.31H1.34C.62,98.62-.17,98,0,97.31,4.67,81.16,3.7,65.36,0,49.74c-.16-.69.59-1.3,1.31-1.3ZM26.94,87.8V80.12H8.11c-.11,3.27-.33,4.42-.68,7.68ZM21.17,10.24a10.11,10.11,0,1,1-10.1,10.11,10.11,10.11,0,0,1,10.1-10.11Z"/>
      </symbol>
      <symbol id='feedback' viewBox="0 0 112.77 122.88">
        <path d="M64.44,61.11c1.79,0,3.12-1.45,3.12-3.12c0-1.78-1.45-3.12-3.12-3.12H24.75c-1.78,0-3.12,1.45-3.12,3.12 c0,1.78,1.45,3.12,3.12,3.12H64.44L64.44,61.11L64.44,61.11L64.44,61.11z M77.45,19.73l18.1-19.14c0.69-0.58,1.39-0.81,2.2-0.35 l14.56,14.1c0.58,0.69,0.69,1.5-0.12,2.31L93.75,36.14L77.45,19.73L77.45,19.73L77.45,19.73L77.45,19.73z M87.74,42.27l-18.66,3.86 l2.36-20.28L87.74,42.27L87.74,42.27z M19.14,13.09h41.73l-3.05,6.45H19.14c-3.48,0-6.65,1.43-8.96,3.73s-3.73,5.46-3.73,8.96 v45.74c0,3.48,1.43,6.66,3.73,8.96c2.3,2.3,5.47,3.73,8.96,3.73h3.72v0.01l0.21,0.01c1.77,0.12,3.12,1.66,2.99,3.43l-1.26,18.1 L48.78,97.7c0.58-0.58,1.38-0.93,2.27-0.93h37.32c3.48,0,6.65-1.42,8.96-3.73c2.3-2.3,3.73-5.48,3.73-8.96V50.45h6.68v42.69 c0.35,9.63-3.58,15.04-19.43,15.7l-32.25-0.74l-32.73,13.87l-0.16,0.13c-1.35,1.16-3.38,1-4.54-0.36c-0.57-0.67-0.82-1.49-0.77-2.3 l1.55-22.34h-0.26c-5.26,0-10.05-2.15-13.52-5.62C2.15,88.03,0,83.24,0,77.98V32.23c0-5.26,2.15-10.05,5.62-13.52 C9.08,15.24,13.87,13.09,19.14,13.09L19.14,13.09L19.14,13.09z M79.69,78.42c1.79,0,3.12-1.45,3.12-3.12 c0-1.79-1.45-3.12-3.12-3.12H24.75c-1.78,0-3.12,1.45-3.12,3.12c0,1.78,1.45,3.12,3.12,3.12H79.69L79.69,78.42L79.69,78.42 L79.69,78.42z M50.39,43.81c1.78,0,3.12-1.45,3.12-3.12c0-1.67-1.45-3.12-3.12-3.12H24.75c-1.78,0-3.12,1.45-3.12,3.12 c0,1.78,1.45,3.12,3.12,3.12H50.39L50.39,43.81L50.39,43.81L50.39,43.81z"/>
      </symbol>
      <symbol id='subjects' viewBox="0 0 116.875 122.88">
        <path d="M6.902,0h103.071c1.9,0,3.627,0.776,4.877,2.025c1.248,1.25,2.025,2.976,2.025,4.876v109.077 c0,1.9-0.777,3.627-2.025,4.876c-1.25,1.249-2.977,2.025-4.877,2.025H6.902c-1.9,0-3.627-0.775-4.877-2.025 C0.776,119.605,0,117.879,0,115.979V6.901C0,5,0.775,3.274,2.025,2.025C3.274,0.775,5,0,6.902,0L6.902,0z M39.514,67.438 c-1.316,0-2.384-1.317-2.384-2.942s1.067-2.942,2.384-2.942h37.847c1.316,0,2.383,1.317,2.383,2.942s-1.066,2.942-2.383,2.942 H39.514L39.514,67.438z M37.624,78.839c1.508,0,2.751,1.134,2.922,2.596c0.051,0.218,0.078,0.444,0.078,0.677v8.771h34.644v-8.774 c0-0.058,0.002-0.115,0.006-0.173c-0.002-0.051-0.004-0.103-0.004-0.154c0-1.625,1.316-2.942,2.941-2.942h14.861V20.676H23.796 v58.163H37.624L37.624,78.839z M34.739,84.725H22.69c-1.308,0-2.509-0.539-3.376-1.406c-0.081-0.081-0.156-0.165-0.225-0.253 c-0.73-0.836-1.178-1.928-1.178-3.121V19.57c0-1.317,0.537-2.513,1.401-3.378c0.085-0.085,0.175-0.165,0.269-0.238 c0.841-0.725,1.929-1.164,3.109-1.164H94.18c1.318,0,2.51,0.544,3.371,1.405c0.867,0.868,1.408,2.072,1.408,3.375v60.375 c0,1.31-0.545,2.508-1.408,3.372c-0.865,0.864-2.063,1.408-3.371,1.408H81.152v6.771c0,1.453-0.592,2.771-1.545,3.726 c-0.955,0.954-2.273,1.547-3.727,1.547h-35.87c-1.334,0-2.557-0.508-3.487-1.335c-0.082-0.066-0.161-0.137-0.237-0.213 c-0.955-0.955-1.549-2.277-1.549-3.725V84.725L34.739,84.725z M39.514,38.112c-1.316,0-2.384-1.317-2.384-2.942 c0-1.625,1.067-2.943,2.384-2.943h37.847c1.316,0,2.383,1.317,2.383,2.943c0,1.625-1.066,2.942-2.383,2.942H39.514L39.514,38.112z M39.514,52.332c-1.316,0-2.384-1.318-2.384-2.943s1.067-2.942,2.384-2.942h37.847c1.316,0,2.383,1.317,2.383,2.942 s-1.066,2.943-2.383,2.943H39.514L39.514,52.332z M109.973,5.885H6.902c-0.277,0-0.53,0.115-0.716,0.301S5.885,6.625,5.885,6.901 v109.077c0,0.275,0.115,0.529,0.301,0.715s0.439,0.301,0.716,0.301h103.071c0.275,0,0.529-0.115,0.715-0.301 s0.301-0.439,0.301-0.715V6.901c0-0.276-0.115-0.53-0.301-0.716C110.502,6,110.248,5.885,109.973,5.885L109.973,5.885z"/>
      </symbol>
      <symbol id='hash-tag' viewBox="0 0 122.88 122.88">
        <path class="st0" d="M61.44,0c33.93,0,61.44,27.51,61.44,61.44c0,33.93-27.51,61.44-61.44,61.44C27.51,122.88,0,95.37,0,61.44 C0,27.51,27.51,0,61.44,0L61.44,0z M78.13,25.66c0.38-1.81,2.15-2.97,3.95-2.59c1.81,0.38,2.97,2.15,2.59,3.95L80.85,45.4h8.48 c1.85,0,3.35,1.5,3.35,3.35c0,1.85-1.5,3.35-3.35,3.35h-9.88l-4.21,20.24h14.09c1.85,0,3.35,1.5,3.35,3.35 c0,1.85-1.5,3.35-3.35,3.35H73.86l-3.78,18.18c-0.38,1.81-2.15,2.97-3.95,2.59c-1.81-0.38-2.97-2.15-2.59-3.95l3.5-16.82h-18 l-3.76,18.09c-0.38,1.81-2.15,2.97-3.95,2.59c-1.81-0.38-2.97-2.15-2.59-3.95l3.48-16.73h-8.66c-1.85,0-3.35-1.5-3.35-3.35 c0-1.85,1.5-3.35,3.35-3.35h10.05L47.8,52.1H33.54c-1.85,0-3.35-1.5-3.35-3.35c0-1.85,1.5-3.35,3.35-3.35H49.2l4.1-19.7 c0.38-1.81,2.15-2.97,3.95-2.59c1.81,0.38,2.97,2.15,2.59,3.95L56.02,45.4h18L78.13,25.66L78.13,25.66z M68.42,72.34l4.21-20.24 h-18l-4.21,20.24H68.42L68.42,72.34z"/>
      </symbol>
      <symbol id='correct' viewBox="0 0 122.88 122.87">
        <path class="st0" d="M32.82,51.34l14.99-0.2l1.12,0.29c3.03,1.74,5.88,3.74,8.54,5.99c1.92,1.63,3.76,3.4,5.5,5.32 c5.38-8.65,11.11-16.6,17.16-23.9c6.63-8,13.66-15.27,21.05-21.9l1.46-0.56h16.36l-3.3,3.66c-10.13,11.26-19.33,22.9-27.64,34.9 C79.74,66.97,72.31,79.37,65.7,92.13l-2.06,3.97l-1.89-4.04c-3.49-7.48-7.66-14.35-12.64-20.49c-4.98-6.14-10.77-11.59-17.52-16.22 L32.82,51.34L32.82,51.34L32.82,51.34z"/><path class="st1" d="M61.44,0c9.53,0,18.55,2.17,26.61,6.04c-3.3,2.61-6.36,5.11-9.21,7.53c-5.43-1.97-11.28-3.05-17.39-3.05 c-14.06,0-26.79,5.7-36,14.92c-9.21,9.22-14.92,21.94-14.92,36c0,14.06,5.7,26.78,14.92,36s21.94,14.92,36,14.92 c14.06,0,26.79-5.7,36-14.92c9.22-9.22,14.91-21.94,14.91-36c0-3.34-0.32-6.62-0.94-9.78c2.64-3.44,5.35-6.88,8.11-10.28 c2.17,6.28,3.35,13.04,3.35,20.06c0,16.96-6.88,32.33-17.99,43.44c-11.12,11.12-26.48,18-43.44,18c-16.96,0-32.32-6.88-43.44-18 C6.88,93.76,0,78.4,0,61.44C0,44.47,6.88,29.11,17.99,18C29.11,6.88,44.47,0,61.44,0L61.44,0L61.44,0z"/>
      </symbol>
      <symbol id='day-hours' viewBox="0 0 121.565 122.88">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M61.44,0c18.854,0,35.724,8.493,46.992,21.863l7.76-7.76v25.464H90.728 l7.282-7.281c-8.656-11.037-22.112-18.128-37.227-18.128c-26.113,0-47.283,21.169-47.283,47.282 c0,26.113,21.169,47.283,47.283,47.283c21.718,0,40.014-14.644,45.559-34.592h15.224c-5.847,27.843-30.543,48.749-60.125,48.749 C27.508,122.88,0,95.372,0,61.439C0,27.508,27.508,0,61.44,0L61.44,0z M60.585,79.843H35.262v-5.485L46.922,62.1 c2.876-3.276,4.313-5.871,4.313-7.801c0-1.558-0.34-2.748-1.021-3.556c-0.68-0.816-1.676-1.225-2.969-1.225 c-1.276,0-2.313,0.544-3.113,1.633c-0.801,1.088-1.2,2.442-1.2,4.075h-8.422c0-2.229,0.553-4.288,1.669-6.178 c1.114-1.88,2.663-3.358,4.635-4.422c1.982-1.063,4.186-1.592,6.635-1.592c3.912,0,6.933,0.902,9.051,2.714 c2.127,1.812,3.182,4.416,3.182,7.801c0,1.429-0.263,2.823-0.8,4.177c-0.526,1.352-1.352,2.771-2.474,4.262 c-1.123,1.487-2.928,3.469-5.42,5.961l-4.688,5.411h14.284V79.843L60.585,79.843z M84.834,65.662h3.692v6.483h-3.692v7.697h-8.397 v-7.697H62.411l-0.504-5.139l14.529-23.375v-0.077h8.397V65.662L84.834,65.662z M69.903,65.662h6.533V54.494l-0.519,0.851 L69.903,65.662L69.903,65.662z"/>
      </symbol>
      <symbol id='contacts' viewBox="0 0 117.13 122.88">
        <path d="M105.87,80.26h7.88a3.4,3.4,0,0,1,1.18.2,3.2,3.2,0,0,1,1.23.76h0a3.17,3.17,0,0,1,.77,1.22h0a3.75,3.75,0,0,1,.2,1.18V99.52a3,3,0,0,1-.11.83l-.06.23a3.11,3.11,0,0,1-.74,1.19,3.27,3.27,0,0,1-.81.6,2.93,2.93,0,0,1-1.34.32h-8.2V104a19,19,0,0,1-18.93,18.93h-68A19,19,0,0,1,0,104v-85A19,19,0,0,1,18.93,0h68a19,19,0,0,1,18.93,18.93v1.83h7.88a3.29,3.29,0,0,1,1.44.32,3.18,3.18,0,0,1,1.23,1h0a3.53,3.53,0,0,1,.55,1.05h0a3.58,3.58,0,0,1,.18,1.11v15.9a2.79,2.79,0,0,1-.19,1,2,2,0,0,1-.18.4,3.05,3.05,0,0,1-.79.94,3.79,3.79,0,0,1-.56.36h0a2.94,2.94,0,0,1-1.33.33h-8.2v7h7.88a3.37,3.37,0,0,1,1.44.32h0a3.25,3.25,0,0,1,1.23,1h0a3.46,3.46,0,0,1,.5.89,3.34,3.34,0,0,1,.22,1.19v16a3,3,0,0,1-.32,1.33,3.23,3.23,0,0,1-.59.82h0a2.92,2.92,0,0,1-.83.6h0a3,3,0,0,1-1.32.32h-8.2v7.59ZM52.94,27.46a34,34,0,1,1-24,10,33.87,33.87,0,0,1,24-10ZM73.6,40.77a29.23,29.23,0,0,0-44,38.2c3.5-1.58,11.14-2.23,14.42-4.51a11.81,11.81,0,0,0,.79-1.53c.39-.91.76-1.9,1-2.57a32.4,32.4,0,0,1-2.58-3.68l-2.61-4.16a7.68,7.68,0,0,1-1.49-3.8,3,3,0,0,1,.26-1.36A2.66,2.66,0,0,1,40.86,56a63.89,63.89,0,0,1-.13-7.48,11.17,11.17,0,0,1,.32-1.69,10,10,0,0,1,4.42-5.63,13.49,13.49,0,0,1,3.7-1.64c.83-.24-.71-2.89.15-3,4.15-.42,10.87,3.37,13.77,6.5a10.19,10.19,0,0,1,2.56,6.41l-.16,6.79h0a1.87,1.87,0,0,1,1.37,1.42,5.88,5.88,0,0,1-.72,3.57h0l0,.09-3,4.91a25.92,25.92,0,0,1-3.66,5l.4.57a17.81,17.81,0,0,0,2,2.51.27.27,0,0,1,.07.08c3.25,2.3,10.92,3,14.44,4.53A29.25,29.25,0,0,0,73.6,40.77ZM86.94,7.12h-68A11.88,11.88,0,0,0,7.12,18.93v85a11.88,11.88,0,0,0,11.81,11.81h68A11.88,11.88,0,0,0,98.75,104v-85A11.88,11.88,0,0,0,86.94,7.12Z"/>
      </symbol>
    </svg>

    <!--loading spinners-->
        <div id='spinners-div'>
          <div class='spinners'>
            <div class='spinners'>
              <img src="{{asset('loadingspinners.gif')}}" alt="" width='300px' height='300px'></img>
            </div>
          </div>
        </div>
  </head>
  <body class='flex' onload='pageloaderfunction()'>
      <main class='flex'>
        <div class="mx-0">
          @auth
          <div class="d-flex flex-column flex-shrink-0 p-3  bg-gradient-info text-white side-nav" id='side-nav'>
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
              <span class="fs-4"><h5>EDUC-ITECH-SCH</h5></span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
              <li class="{{ (request()->routeIs('home') ? 'current' : '') }}">
                <a href="{{route('home')}}" class="nav-link link-dark" aria-current="page">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                  Home
                </a>
              </li>
              <li>
                <a href="{{route('home')}}" class="nav-link link-dark">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                  Dashboard
                </a>
              </li>
              <li class="{{(request()->segment(1)=='schools') ? 'current' : ''}}">
                <a href="{{route('schools')}}" class="nav-link link-dark">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                  Schools
                </a>
              </li>
              <li class="{{(request()->routeIs('allUsers') ? 'current' : '')}}">
                <a href="{{route('allUsers')}}" class="nav-link link-dark">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                  Users
                </a>
              </li>
              <li class="{{(request()->routeIs('graphs') ? 'current' : '')}}">
                <a href="#" class="nav-link link-dark">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                  Graphs
                </a>
              </li>
        <!--limit messages to only administrators-->
              @if(Auth::user()->hasRole(['administrator','superadministrator']))
              <li class="{{(request()->routeIs('messages') ? 'current' : '')}}">
                <a href="{{route('messages')}}" class="nav-link link-dark">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                  Message
                </a>
              </li>
              @endif
        <!--end administrator limit-->
              <li class="{{(request()->routeIs('gbarcode') ? 'current' : '')}}">
                <a href="{{route('barcode')}}" class="nav-link link-dark">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                  Bar codes
                </a>
              </li>
            </ul>
            <hr>
            <div class="dropdown">
              <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{asset('user-icon.jpg')}}" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>{{Auth::user()->firstName}}</strong>
              </a>
              <ul class="dropdown-menu text-small shadow text-dark" aria-labelledby="dropdownUser2">
                <li><a class="dropdown-item text-dark" href="#">Profile</a></li>
                <li><a class="dropdown-item text-dark" href="{{route('newPassword.form')}}">Change Password</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-dark" href="{{route('logout')}}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Sign out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                </li>
              </ul>
            </div>
          </div>
        @endauth
          <div class="p-2 main-content" id='main-content'>
            <div class="top-nav-right p-2 mx-2">
              <i class="fa fa-bars btn btn-circle btn-light" onclick="toggleSideNav()"></i>
            </div>
            @yield('crumbs')
            @yield('content')
          </div>
        </div>
      </main>
    
       <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
        <script>pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js';</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.3.0/fabric.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
        <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Core theme JS-->
        <script src="{{asset('js/scripts.js')}}"></script>
        <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
        
        <!-- javascript that loads pdf tool-->
        <script src = "{{asset('js/pdfJavascript.js')}}"></script>
        <script src="{{ asset('js/custom.js') }}" defer></script>
        <script>
            CKEDITOR.replace('assignment_content' );
            CKEDITOR.replace('textarea');
    </script>
  </body>
</html>
