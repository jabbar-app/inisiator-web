<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon" />
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link rel="manifest" href="{{ asset('assets/manifest.json') }}" />
  <title>Quiz 1</title>
  <link href="{{ asset('game/assets/css/style.css') }}" rel="stylesheet">
  <style>
    body {
      transition: opacity 0.3s ease;
    }


    button:disabled {
      background-color: #d3d3d3;
      color: #6c757d;
      border-color: #d3d3d3;
    }

    .fade-out {
      opacity: 0;
    }

    .progress svg {
      height: 80px;
      transform: rotate(-90deg);
      width: 80px;
    }

    .progress-bar__background {
      fill: none;
      stroke: rgba(236, 137, 68, 0.4);
      stroke-width: 2.8;
    }

    .progress-bar__progress {
      fill: none;
      stroke: #ff710f;
      stroke-dasharray: 100 100;
      stroke-dashoffset: 100;
      stroke-linecap: round;
      stroke-width: 2.8;
      transition: stroke-dashoffset 1s ease-in-out;
    }

    .flex:hover {
      transform: scale(1.02);
      transition: all 0.3s ease;
    }

    .relative.z-20 {
      padding: 1rem 1rem;
    }

    .progress svg {
      height: 60px;
      width: 60px;
    }

    .option {
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .option.correct {
      background-color: #4caf50;
      color: #fff;
      border-color: #4caf50;
    }

    .option.correct .icon {
      background-color: #fff;
      color: #4caf50;
    }

    .option.wrong {
      background-color: #f44336;
      color: #fff;
      border-color: #f44336;
    }

    .option.wrong .icon {
      background-color: #fff;
      color: #f44336;
    }

    .edit-icon {
      cursor: pointer;
      margin-left: 10px;
    }
  </style>
</head>

<body>
  <div class="container min-h-dvh relative overflow-hidden py-8 dark:text-white dark:bg-color1">
    <!-- Absolute Items Start -->
    <img src="{{ asset('game/assets/images/header-bg-1.png') }}" alt=""
      class="absolute top-0 left-0 right-0 -mt-8" />
    <div class="absolute top-0 left-0 bg-p3 blur-[145px] h-[174px] w-[149px]"></div>
    <div class="absolute top-40 right-0 bg-[#0ABAC9] blur-[150px] h-[174px] w-[91px]"></div>
    <div class="absolute top-80 right-40 bg-p2 blur-[235px] h-[205px] w-[176px]"></div>
    <div class="absolute bottom-0 right-0 bg-p3 blur-[220px] h-[174px] w-[149px]"></div>
    <!-- Absolute Items End -->

    <div class="relative z-20 px-6">
      @yield('content')
    </div>

    <!-- ==== js dependencies start ==== -->
    @stack('scripts')
  </div>
</body>

</html>
