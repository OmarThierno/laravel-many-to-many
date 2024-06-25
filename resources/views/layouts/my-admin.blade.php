<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap dashboard</title>

  <!-- Usando Vite -->
  @vite(['resources/js/app.js'])
</head>
<body>
  <!-- Header  -->
  <header class="d-md-none">
    <nav class="navbar navbar-expand-md bg-dark" data-bs-theme="dark">
      <!-- Container -->
      <div class="container">
        <!-- brand -->
        <a class="navbar-brand text-uppercase" href="#">Bootstrap dashboard</a>
        <!-- /brand -->

        <!-- Hamburger button -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fa-solid fa-bars"></i>
        </button>
        <!-- /Hamburger button -->
      </div>
      <!-- /Container -->
    </nav>
  </header>
  <!-- /Header  -->

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div
        class="sidebar col-md-3 col-lg-2 collapse d-md-block bg-dark pb-3"
        id="navbarSupportedContent"
      >
        <div class="d-none d-md-flex text-white justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h5">Bootstrap dashboard</h1>
        </div>
        
        
        <ul class="nav nav-pills flex-column pt-4 mb-auto">
          <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link {{Route::currentRouteName() === 'admin.dashboard' ? 'active' : 'text-white'}}" aria-current="page">
              <i class="fa-solid fa-house"></i>
              Dashboard
            </a>
          </li>
          <li>
            <a href="{{route('admin.projects.create')}}" class="nav-link {{Route::currentRouteName() === 'admin.projects.create' ? 'active' : 'text-white'}}">
              <i class="fa-solid fa-chart-line"></i>
              Created
            </a>
          </li>
          <li>
            <a href="{{route('admin.projects.index')}}" class="nav-link {{Route::currentRouteName() === 'admin.projects.index' ? 'active' : 'text-white'}}">
              <i class="fa-solid fa-box-archive"></i>
              Prodotti
            </a>
          </li>
        </ul>

      </div>

      <!-- Main -->
      <main class="col-md-9 col-lg-10 vh-100">
        @yield('content')
      </main>
      <!-- /Main -->
    </div>
  </div>
  
</body>
</html>