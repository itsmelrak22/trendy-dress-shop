<?php 
    if (!isset($_SESSION['admin_email'])) {

        echo "<script>window.open('login.php','_self')</script>";
    }else{
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <!-- <script src="./dashboard/color-modes.js"></script> -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Dashboard</title>

    <!-- Custom styles for this template -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet"> -->
    <!-- Custom styles for this template -->
    <link href="dashboard/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="calendar3" viewBox="0 0 16 16">
      <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
      <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
    </symbol>
    <symbol id="cart" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
    </symbol>
    <symbol id="chevron-right" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
    </symbol>
    <symbol id="door-closed" viewBox="0 0 16 16">
      <path d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z"/>
      <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z"/>
    </symbol>
    <symbol id="file-earmark" viewBox="0 0 16 16">
      <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
    </symbol>
    <symbol id="file-earmark-text" viewBox="0 0 16 16">
      <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
      <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
    </symbol>
    <symbol id="gear-wide-connected" viewBox="0 0 16 16">
      <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5zm0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065l.087-.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8 4.617 4.322zm.344 7.646.087.065-.087-.065z"/>
    </symbol>
    <symbol id="graph-up" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z"/>
    </symbol>
    <symbol id="house-fill" viewBox="0 0 16 16">
      <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"/>
      <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"/>
    </symbol>
    <symbol id="list" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
    </symbol>
    <symbol id="people" viewBox="0 0 16 16">
      <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
    </symbol>
    <symbol id="plus-circle" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
    </symbol>
    <symbol id="puzzle" viewBox="0 0 16 16">
      <path d="M3.112 3.645A1.5 1.5 0 0 1 4.605 2H7a.5.5 0 0 1 .5.5v.382c0 .696-.497 1.182-.872 1.469a.459.459 0 0 0-.115.118.113.113 0 0 0-.012.025L6.5 4.5v.003l.003.01c.004.01.014.028.036.053a.86.86 0 0 0 .27.194C7.09 4.9 7.51 5 8 5c.492 0 .912-.1 1.19-.24a.86.86 0 0 0 .271-.194.213.213 0 0 0 .039-.063v-.009a.112.112 0 0 0-.012-.025.459.459 0 0 0-.115-.118c-.375-.287-.872-.773-.872-1.469V2.5A.5.5 0 0 1 9 2h2.395a1.5 1.5 0 0 1 1.493 1.645L12.645 6.5h.237c.195 0 .42-.147.675-.48.21-.274.528-.52.943-.52.568 0 .947.447 1.154.862C15.877 6.807 16 7.387 16 8s-.123 1.193-.346 1.638c-.207.415-.586.862-1.154.862-.415 0-.733-.246-.943-.52-.255-.333-.48-.48-.675-.48h-.237l.243 2.855A1.5 1.5 0 0 1 11.395 14H9a.5.5 0 0 1-.5-.5v-.382c0-.696.497-1.182.872-1.469a.459.459 0 0 0 .115-.118.113.113 0 0 0 .012-.025L9.5 11.5v-.003a.214.214 0 0 0-.039-.064.859.859 0 0 0-.27-.193C8.91 11.1 8.49 11 8 11c-.491 0-.912.1-1.19.24a.859.859 0 0 0-.271.194.214.214 0 0 0-.039.063v.003l.001.006a.113.113 0 0 0 .012.025c.016.027.05.068.115.118.375.287.872.773.872 1.469v.382a.5.5 0 0 1-.5.5H4.605a1.5 1.5 0 0 1-1.493-1.645L3.356 9.5h-.238c-.195 0-.42.147-.675.48-.21.274-.528.52-.943.52-.568 0-.947-.447-1.154-.862C.123 9.193 0 8.613 0 8s.123-1.193.346-1.638C.553 5.947.932 5.5 1.5 5.5c.415 0 .733.246.943.52.255.333.48.48.675.48h.238l-.244-2.855zM4.605 3a.5.5 0 0 0-.498.55l.001.007.29 3.4A.5.5 0 0 1 3.9 7.5h-.782c-.696 0-1.182-.497-1.469-.872a.459.459 0 0 0-.118-.115.112.112 0 0 0-.025-.012L1.5 6.5h-.003a.213.213 0 0 0-.064.039.86.86 0 0 0-.193.27C1.1 7.09 1 7.51 1 8c0 .491.1.912.24 1.19.07.14.14.225.194.271a.213.213 0 0 0 .063.039H1.5l.006-.001a.112.112 0 0 0 .025-.012.459.459 0 0 0 .118-.115c.287-.375.773-.872 1.469-.872H3.9a.5.5 0 0 1 .498.542l-.29 3.408a.5.5 0 0 0 .497.55h1.878c-.048-.166-.195-.352-.463-.557-.274-.21-.52-.528-.52-.943 0-.568.447-.947.862-1.154C6.807 10.123 7.387 10 8 10s1.193.123 1.638.346c.415.207.862.586.862 1.154 0 .415-.246.733-.52.943-.268.205-.415.39-.463.557h1.878a.5.5 0 0 0 .498-.55l-.001-.007-.29-3.4A.5.5 0 0 1 12.1 8.5h.782c.696 0 1.182.497 1.469.872.05.065.091.099.118.115.013.008.021.01.025.012a.02.02 0 0 0 .006.001h.003a.214.214 0 0 0 .064-.039.86.86 0 0 0 .193-.27c.14-.28.24-.7.24-1.191 0-.492-.1-.912-.24-1.19a.86.86 0 0 0-.194-.271.215.215 0 0 0-.063-.039H14.5l-.006.001a.113.113 0 0 0-.025.012.459.459 0 0 0-.118.115c-.287.375-.773.872-1.469.872H12.1a.5.5 0 0 1-.498-.543l.29-3.407a.5.5 0 0 0-.497-.55H9.517c.048.166.195.352.463.557.274.21.52.528.52.943 0 .568-.447.947-.862 1.154C9.193 5.877 8.613 6 8 6s-1.193-.123-1.638-.346C5.947 5.447 5.5 5.068 5.5 4.5c0-.415.246-.733.52-.943.268-.205.415-.39.463-.557H4.605z"/>
    </symbol>
    <symbol id="search" viewBox="0 0 16 16">
      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
    </symbol>
  </svg>

  <header class="navbar bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="index.php?dashboard">Admin Panel</a>
    <div style="padding-right: 10px;" class="dropdown fs-6 text-white">
      <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="accountDropdownToggle">
        <i class="fa fa-user"></i>
        <?php echo $admin_name; ?> <span class="caret"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="index.php?user_profile=<?php echo $admin_id; ?>"><i class="fa fa-fw fa-user"></i> Profile</a></li>
        <li><a class="dropdown-item" href="index.php?view_products"><i class="fa fa-fw fa-envelope"></i> Products <span class="badge"><?php echo $count_products; ?></span></a></li>
        <li><a class="dropdown-item" href="index.php?view_customers"><i class="fa fa-fw fa-gear"></i> Customers <span class="badge"><?php echo $count_customers; ?></span></a></li>
        <li><a class="dropdown-item" href="index.php?view_p_cats"><i class="fa fa-fw fa-gear"></i> Product Categories <span class="badge"><?php echo $count_p_categories; ?></span></a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="logout.php" id="logoutBtn"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
      </ul>
    </div>

    <ul class="navbar-nav flex-row d-md-none">
      <!-- <li class="nav-item text-nowrap">
        <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
          <svg class="bi"><use xlink:href="#search"/></svg>
        </button>
      </li> -->
      <li class="nav-item text-nowrap">
        <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <svg class="bi"><use xlink:href="#list"/></svg>
        </button>
      </li>
    </ul>

    <!-- <div id="navbarSearch" class="navbar-search w-100 collapse">
      <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
    </div> -->
  </header>

  <div class="container-fluid">
    <div class="row">
      <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
        <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Admin Panel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto" style="height: 90vh;">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="index.php?dashboard">
                  <svg class="bi"><use xlink:href="#house-fill"/></svg>
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="index.php?view_orders">
                  <svg class="bi"><use xlink:href="#file-earmark"/></svg>
                  Orders
                </a>
              </li>
              <!-- HTML -->
              <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
                      <svg class="bi"><use xlink:href="#cart"/></svg>
                      Products
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                      </svg>
                  </a>
                  <ul id="products" class="collapse">
                      <li>
                          <a href="index.php?insert_product"> Insert Products </a>
                      </li>
                      <li>
                          <a href="index.php?view_products"> View Products </a>
                      </li>
                  </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="index.php?view_customers">
                  <svg class="bi"><use xlink:href="#people"/></svg>
                  Customers
                </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#p_cat" aria-expanded="false" aria-controls="p_cat">
                      <svg class="bi"><use xlink:href="#cart"/></svg>
                      Products Categories
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                      </svg>
                  </a>
                  <ul id="p_cat" class="collapse collapse-horizontal">
                      <li>
                          <a href="index.php?insert_p_cat">  Insert Product Category </a>
                      </li>
                      <li>
                          <a href="index.php?view_p_cats"> View Product Category </a>
                      </li>
                  </ul>
              </li>
              <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#cat" aria-expanded="false" aria-controls="cat">
                      <svg class="bi"><use xlink:href="#cart"/></svg>
                      Categories
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                      </svg>
                  </a>
                  <ul id="cat" class="collapse collapse-horizontal">
                      <li>
                          <a href="index.php?insert_cat"> Insert Category</a>
                      </li>
                      <li>
                          <a href="index.php?view_cats"> View Categories </a>
                      </li>
                  </ul>
              </li>
              <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#sales" aria-expanded="false" aria-controls="sales">
                      <svg class="bi"><use xlink:href="#cart"/></svg>
                      Sales
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                      </svg>
                  </a>
                  <ul id="sales" class="collapse collapse-horizontal">
                      <li>
                          <a href="index.php?view_sales"> Sales Record</a>
                      </li>
                      <li>
                          <a href="index.php?view_transaction"> Transactions </a>
                      </li>
                  </ul>
              </li>
              <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
                      <svg class="bi"><use xlink:href="#cart"/></svg>
                      Users
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                      </svg>
                  </a>
                  <ul id="users" class="collapse collapse-horizontal">
                      <li>
                          <a href="index.php?view_users"> View Users</a>
                      </li>
                      <li>
                          <a href="index.php?user_profile=<?php echo $admin_id; ?>"> Edit Users </a>
                      </li>
                  </ul>
              </li>
            </ul>
            <!-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
              <span>Saved reports</span>
              <a class="link-secondary" href="#" aria-label="Add a new report">
                <svg class="bi"><use xlink:href="#plus-circle"/></svg>
              </a>
            </h6>
            <ul class="nav flex-column mb-auto">
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="#">
                  <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
                  Current month
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="#">
                  <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
                  Last quarter
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="#">
                  <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
                  Social engagement
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="#">
                  <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
                  Year-end sale
                </a>
              </li>
            </ul> -->

            <!-- <hr class="my-3">

            <ul class="nav flex-column mb-auto">
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="#">
                  <svg class="bi"><use xlink:href="#gear-wide-connected"/></svg>
                  Settings
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="#">
                  <svg class="bi"><use xlink:href="#door-closed"/></svg>
                  Sign out
                </a>
              </li>
            </ul> -->
          </div>
        </div>
      </div>

      <!-- <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
        </div>

        <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

        <h2>Section title</h2>
        <div class="table-responsive small">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Header</th>
                <th scope="col">Header</th>
                <th scope="col">Header</th>
                <th scope="col">Header</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1,001</td>
                <td>random</td>
                <td>data</td>
                <td>placeholder</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,002</td>
                <td>placeholder</td>
                <td>irrelevant</td>
                <td>visual</td>
                <td>layout</td>
              </tr>
              <tr>
                <td>1,003</td>
                <td>data</td>
                <td>rich</td>
                <td>dashboard</td>
                <td>tabular</td>
              </tr>
              <tr>
                <td>1,003</td>
                <td>information</td>
                <td>placeholder</td>
                <td>illustrative</td>
                <td>data</td>
              </tr>
              <tr>
                <td>1,004</td>
                <td>text</td>
                <td>random</td>
                <td>layout</td>
                <td>dashboard</td>
              </tr>
              <tr>
                <td>1,005</td>
                <td>dashboard</td>
                <td>irrelevant</td>
                <td>text</td>
                <td>placeholder</td>
              </tr>
              <tr>
                <td>1,006</td>
                <td>dashboard</td>
                <td>illustrative</td>
                <td>rich</td>
                <td>data</td>
              </tr>
              <tr>
                <td>1,007</td>
                <td>placeholder</td>
                <td>tabular</td>
                <td>information</td>
                <td>irrelevant</td>
              </tr>
              <tr>
                <td>1,008</td>
                <td>random</td>
                <td>data</td>
                <td>placeholder</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,009</td>
                <td>placeholder</td>
                <td>irrelevant</td>
                <td>visual</td>
                <td>layout</td>
              </tr>
              <tr>
                <td>1,010</td>
                <td>data</td>
                <td>rich</td>
                <td>dashboard</td>
                <td>tabular</td>
              </tr>
              <tr>
                <td>1,011</td>
                <td>information</td>
                <td>placeholder</td>
                <td>illustrative</td>
                <td>data</td>
              </tr>
              <tr>
                <td>1,012</td>
                <td>text</td>
                <td>placeholder</td>
                <td>layout</td>
                <td>dashboard</td>
              </tr>
              <tr>
                <td>1,013</td>
                <td>dashboard</td>
                <td>irrelevant</td>
                <td>text</td>
                <td>visual</td>
              </tr>
              <tr>
                <td>1,014</td>
                <td>dashboard</td>
                <td>illustrative</td>
                <td>rich</td>
                <td>data</td>
              </tr>
              <tr>
                <td>1,015</td>
                <td>random</td>
                <td>tabular</td>
                <td>information</td>
                <td>text</td>
              </tr>
            </tbody>
          </table>
        </div>
      </main> -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <?php
        if(isset($_GET['dashboard'])){
          include("front_dashboard.php");
          
        }


        if(isset($_GET['insert_product'])){

          include("insert_product.php");
        }
          
          if(isset($_GET['view_products'])){
          
          include("view_products.php");
          
          }
          
          if(isset($_GET['delete_product'])){
          
          include("delete_product.php");
          
          }
          
          if(isset($_GET['edit_product'])){
          
          include("edit_product.php");
          
          }
          
          if(isset($_GET['edit_product_colors'])){
          
              include("edit_product_colors.php");
              
              }
          
          if(isset($_GET['insert_p_cat'])){
          
          include("insert_p_cat.php");
          
          }
          
          if(isset($_GET['view_p_cats'])){
          
          include("view_p_cats.php");
          
          }
          
          if(isset($_GET['delete_p_cat'])){
          
          include("delete_p_cat.php");
          
          }
          
          if(isset($_GET['edit_p_cat'])){
          
          include("edit_p_cat.php");
          
          }
          
          if(isset($_GET['insert_cat'])){
          
          include("insert_cat.php");
          
          }
          
          if(isset($_GET['view_cats'])){
          
          include("view_cats.php");
          
          }
          
          if(isset($_GET['delete_cat'])){
          
          include("delete_cat.php");
          
          }
          
          if(isset($_GET['edit_cat'])){
          
          include("edit_cat.php");
          
          }
          
          if(isset($_GET['insert_slide'])){
          
          include("insert_slide.php");
          
          }
          
          
          if(isset($_GET['view_slides'])){
          
          include("view_slides.php");
          
          }
          
          if(isset($_GET['delete_slide'])){
          
          include("delete_slide.php");
          
          }
          
          
          if(isset($_GET['edit_slide'])){
          
          include("edit_slide.php");
          
          }
          
          
          if(isset($_GET['view_customers'])){
          
          include("view_customers.php");
          
          }
          if(isset($_GET['edit_customers'])){
          
          include("edit_customer.php");
          
          }
          
          if(isset($_GET['customer_delete'])){
          
          include("customer_delete.php");
          
          }
          
          
          if(isset($_GET['view_orders'])){
          
          include("view_orders.php");
          
          }
          if(isset($_GET['edit_orders'])){
          
          include("edit_order.php");
          
          }
          if(isset($_GET['view_custom_orders'])){
          
          include("view_custom_orders.php");
          
          }
          
          if(isset($_GET['order_delete'])){
          
          include("order_delete.php");
          
          }
          
          
          if(isset($_GET['view_payments'])){
          
          include("view_payments.php");
          
          }
          
          if(isset($_GET['payment_delete'])){
          
          include("payment_delete.php");
          
          }
          
          if(isset($_GET['insert_user'])){
          
          include("insert_user.php");
          
          }
          
          if(isset($_GET['view_users'])){
          
          include("view_users.php");
          
          }
          
          
          if(isset($_GET['user_delete'])){
          
          include("user_delete.php");
          
          }
          
          
          
          if(isset($_GET['user_profile'])){
          
          include("user_profile.php");
          
          }
          
          if(isset($_GET['insert_box'])){
          
          include("insert_box.php");
          
          }
          
          if(isset($_GET['view_boxes'])){
          
          include("view_boxes.php");
          
          }
          
          if(isset($_GET['delete_box'])){
          
          include("delete_box.php");
          
          }
          
          if(isset($_GET['edit_box'])){
          
          include("edit_box.php");
          
          }
          
          if(isset($_GET['insert_term'])){
          
          include("insert_term.php");
          
          }
          
          if(isset($_GET['view_terms'])){
          
          include("view_terms.php");
          
          }
          
          if(isset($_GET['delete_term'])){
          
          include("delete_term.php");
          
          }
          
          if(isset($_GET['edit_term'])){
          
          include("edit_term.php");
          
          }
          
          if(isset($_GET['edit_css'])){
          
          include("edit_css.php");
          
          }
          
          if(isset($_GET['insert_manufacturer'])){
          
          include("insert_manufacturer.php");
          
          }
          
          if(isset($_GET['view_manufacturers'])){
          
          include("view_manufacturers.php");
          
          }
          
          if(isset($_GET['delete_manufacturer'])){
          
          include("delete_manufacturer.php");
          
          }
          
          if(isset($_GET['edit_manufacturer'])){
          
          include("edit_manufacturer.php");
          
          }
          
          
          if(isset($_GET['insert_coupon'])){
          
          include("insert_coupon.php");
          
          }
          
          if(isset($_GET['view_coupons'])){
          
          include("view_coupons.php");
          
          }
          
          if(isset($_GET['delete_coupon'])){
          
          include("delete_coupon.php");
          
          }
          
          
          if(isset($_GET['edit_coupon'])){
          
          include("edit_coupon.php");
          
          }
          
          
          if(isset($_GET['insert_icon'])){
          
          include("insert_icon.php");
          
          }
          
          
          if(isset($_GET['view_icons'])){
          
          include("view_icons.php");
          
          }
          
          if(isset($_GET['delete_icon'])){
          
          include("delete_icon.php");
          
          }
          
          if(isset($_GET['edit_icon'])){
          
          include("edit_icon.php");
          
          }
          
          if(isset($_GET['insert_bundle'])){
          
          include("insert_bundle.php");
          
          }
          
          if(isset($_GET['view_bundles'])){
          
          include("view_bundles.php");
          
          }
          
          if(isset($_GET['delete_bundle'])){
          
          include("delete_bundle.php");
          
          }
          
          
          if(isset($_GET['edit_bundle'])){
          
          include("edit_bundle.php");
          
          }
          
          
          if(isset($_GET['insert_rel'])){
          
          include("insert_rel.php");
          
          }
          
          if(isset($_GET['view_rel'])){
          
          include("view_rel.php");
          
          }
          
          if(isset($_GET['delete_rel'])){
          
          include("delete_rel.php");
          
          }
          
          
          if(isset($_GET['edit_rel'])){
          
          include("edit_rel.php");
          
          }
          
          
          if(isset($_GET['edit_contact_us'])){
          
          include("edit_contact_us.php");
          
          }
          
          if(isset($_GET['insert_enquiry'])){
          
          include("insert_enquiry.php");
          
          }
          
          
          if(isset($_GET['view_enquiry'])){
          
          include("view_enquiry.php");
          
          }
          
          if(isset($_GET['delete_enquiry'])){
          
          include("delete_enquiry.php");
          
          }
          
          if(isset($_GET['edit_enquiry'])){
          
          include("edit_enquiry.php");
          
          }
          
          
          if(isset($_GET['edit_about_us'])){
          
          include("edit_about_us.php");
          
          }
          
          
          if(isset($_GET['insert_store'])){
          
          include("insert_store.php");
          
          }
          
          if(isset($_GET['view_store'])){
          
          include("view_store.php");
          
          }
          
          if(isset($_GET['delete_store'])){
          
          include("delete_store.php");
          
          }
          
          if(isset($_GET['edit_store'])){
          
          include("edit_store.php");
          
          }
          
          if(isset($_GET['view_sales'])){
          
          include("view_sales.php");
          
          }
          
          if(isset($_GET['view_transaction'])){
          
          include("view_transaction.php");
          
          }
          if(isset($_GET['edit_custom_order'])){
          
          include("edit_custom_order.php");
          
          }
      ?>
      </main>
    </div>
  </div>
  <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous"></script><script src="dashboard/dashboard.js"></script> -->
</body>
  </html>
<?php } ?>