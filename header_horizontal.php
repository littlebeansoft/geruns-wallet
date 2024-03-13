<!doctype html>
<html lang="en" style="--scrollbar-width:17px; --moz-scrollbar-thin:17px; font-size: 0.85rem;">
	
	<head>
		<meta charset="utf-8">
		<base href="<?php echo $web['domain'];?>" >
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
		
		<title><?php echo $web['title'].' : '.$web_title2;?></title>
		
		<!-- include common vendor stylesheets & fontawesome -->
		<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
		
		<link rel="stylesheet" type="text/css" href="node_modules/@fortawesome/fontawesome-free/css/fontawesome.css">
		<link rel="stylesheet" type="text/css" href="node_modules/@fortawesome/fontawesome-free/css/regular.css">
		<link rel="stylesheet" type="text/css" href="node_modules/@fortawesome/fontawesome-free/css/brands.css">
		<link rel="stylesheet" type="text/css" href="node_modules/@fortawesome/fontawesome-free/css/solid.css">
		
		
		
		<!-- include vendor stylesheets used in "Dashboard" page. see "/views//pages/partials/dashboard/@vendor-stylesheets.hbs" -->
		<link rel="stylesheet" type="text/css" href="node_modules/fullcalendar/main.css">		
		<link rel="stylesheet" type="text/css" href="node_modules/basictable/dist/css/basictable.css">
		
		<link rel="stylesheet" type="text/css" href="node_modules/summernote/dist/summernote-lite.css">
		
		<!-- include fonts -->
		<link rel="stylesheet" type="text/css" href="dist/css/ace-font.css">
		
		<!-- ace.css -->
		<link rel="stylesheet" type="text/css" href="dist/css/ace.css">
		
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Niramit:300,400,500,700&display=swap" />
		<!-- favicon -->
		<link rel="icon" type="image/png" href="assets/favicon.png" />
		<!-- "Dashboard" page styles, specific to this page for demo only -->
		<!-- "Horizontal Menu" page styles, specific to this page for demo only -->
		<link rel="stylesheet" type="text/css" href="./views/pages/horizontal/@page-style.css">
		<link rel="stylesheet" type="text/css" href="dist/css/ace-themes.css">
		
		
	</head>
	
	<body>
		<div class="body-container">

      <nav class="navbar navbar-sm navbar-fixed-xl navbar-expand-lg navbar-white">
        <div class="navbar-inner shadow-md">
          <div class="container container-plus">


            <div class="navbar-intro justify-content-xl-start bgc-transparent pr-lg-3 w-auto">

              <button type="button" class="btn btn-burger burger-arrowed static collapsed ml-2 d-flex d-xl-none btn-h-white" data-toggle-mobile="sidebar" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
                <span class="bars text-dark-tp5"></span>
              </button><!-- mobile sidebar toggler button -->

              <button type="button" class="btn btn-burger burger-compact align-self-center ml-2 d-none d-xl-flex btn-h-light-primary" data-toggle="sidebar" data-toggle-class="collapsed-h" data-target="#sidebar" aria-controls="sidebar" aria-expanded="true" aria-label="Toggle sidebar">
                <span class="bars text-dark-tp5"></span>
              </button><!-- sidebar toggler button -->

              <a class="navbar-brand text-dark-l1 ml-lg-1" href="#">
                <i class="fa fa-leaf text-success"></i>
                <span>Ace</span>
                <span>App</span>
              </a><!-- /.navbar-brand -->

            </div><!-- /.navbar-intro -->


            <!-- breadcrumbs -->
            <div class="navbar-content d-none d-xl-flex">
              <ol class="breadcrumb pl-2 ml-3">
                <li class="breadcrumb-item"><a class="text-dark-l1" href="#">Mega</a></li>
                <li class="breadcrumb-item active text-dark-l4">Horizontal Menu</li>
              </ol>
            </div>


            <div class="navbar-content flex-grow-0 ml-auto">
              <button type="button" id="id-nav-post-btn" class="btn btn-sm px-2 btn-outline-grey btn-h-outline-green btn-h-text-grey btn-a-outline-green btn-bold btn-brc-tp mx-lg-2">
                <i class="fa fa-plus bgc-green radius-round w-3 h-3 text-center mr-lg-1 text-white pt-15 text-95"></i>
                <span class="d-none d-lg-inline">Create New</span>
              </button>
            </div>


            <!-- mobile #navbarMenu toggler button -->
            <button class="navbar-toggler ml-1 mr-2 px-1" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navbar menu">
              <span class="pos-rel">
                  <img class="radius-3px mr-1 brc-grey-m2 border-1" width="36" src="assets/image/avatar/avatar6.jpg" alt="Jason's Photo">
                  <span class="badge badge-dot bgc-orange-d1 position-tr mr-1px mt-n1"></span>
              </span>
            </button>


            <div class="navbar-menu collapse navbar-collapse navbar-backdrop" id="navbarMenu">

              <div class="navbar-nav">
                <ul class="nav nav-compact has-active-border">

                  <li class="nav-item dropdown dropdown-mega">
                    <a class="nav-link dropdown-toggle px-lg-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class="far fa-bell text-110 icon-animated-bell mr-lg-2"></i>

                      <span class="d-inline-block d-lg-none ml-2">Notifications</span><!-- show only on mobile -->
                      <span class="d-none d-lg-block badge badge-dot bgc-danger position-tr mt-3 mr-35"></span>
                      <span class="d-lg-none w-1 h-1 radius-round bgc-danger ml-2"></span>

                      <i class="caret fa fa-angle-left d-block d-lg-none ml-auto"></i>
                    </a>
                    <div class="dropdown-menu dropdown-sm dropdown-animated p-0 bgc-white brc-primary-m3 border-b-2 shadow">
                      <ul class="nav nav-tabs nav-tabs-simple w-100 nav-justified dropdown-clickable border-b-1 brc-secondary-l2" role="tablist">
                        <li class="nav-item">
                          <a class="d-style px-0 mx-0 py-3 nav-link active text-600 brc-blue-m1 text-dark-tp5 bgc-h-blue-l4" data-toggle="tab" href="#navbar-notif-tab-1" role="tab">
                            <span class="d-active text-blue-d1 text-105">Notifications</span>
                            <span class="d-n-active">Notifications</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="d-style px-0 mx-0 py-3 nav-link text-600 brc-purple-m1 text-dark-tp5 bgc-h-purple-l4" data-toggle="tab" href="#navbar-notif-tab-2" role="tab">
                            <span class="d-active text-purple-d1 text-105">Messages</span>
                            <span class="d-n-active">Messages</span>
                          </a>
                        </li>
                      </ul><!-- .nav-tabs -->


                      <div class="tab-content tab-sliding p-0">

                        <div class="tab-pane mh-none show active px-md-1 pt-1" id="navbar-notif-tab-1" role="tabpanel">

                          <a href="#" class="mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                            <i class="fab fa-twitter bgc-blue-tp1 text-white text-110 mr-15 p-2 radius-1"></i>
                            <span class="text-muted">Followers</span>
                            <span class="float-right badge badge-danger radius-round text-80">- 4</span>
                          </a>
                          <a href="#" class="mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                            <i class="fa fa-comment bgc-pink-tp1 text-white text-110 mr-15 p-2 radius-1"></i>
                            <span class="text-muted">New Comments</span>
                            <span class="float-right badge badge-info radius-round text-80">+12</span>
                          </a>
                          <a href="#" class="mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                            <i class="fa fa-shopping-cart bgc-success-tp1 text-white text-110 mr-15 p-2 radius-1"></i>
                            <span class="text-muted">New Orders</span>
                            <span class="float-right badge badge-success radius-round text-80">+8</span>
                          </a>
                          <a href="#" class="mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                            <i class="far fa-clock bgc-purple-tp1 text-white text-110 mr-15 p-2 radius-1"></i>
                            <span class="text-muted">Finished processing data!</span>
                          </a>

                          <hr class="mt-1 mb-1px brc-secondary-l2" />
                          <a href="#" class="mb-0 py-3 border-0 list-group-item text-blue text-uppercase text-center text-85 font-bolder">
                            See All Notifications
                            <i class="ml-2 fa fa-arrow-right text-muted"></i>
                          </a>

                        </div><!-- .tab-pane : notifications -->


                        <div class="tab-pane mh-none pl-md-2" id="navbar-notif-tab-2" role="tabpanel">
                          <div data-ace-scroll='{"ignore": "mobile", "height": 300, "smooth":true}'>
                            <a href="#" class="d-flex mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                              <img alt="Alex's avatar" src="assets/image/avatar/avatar.png" width="48" class="align-self-start border-2 brc-primary-m3 p-1px mr-2 radius-round" />
                              <div>
                                <span class="text-primary-m1 font-bolder">Alex:</span>
                                <span class="text-grey text-90">Ciao sociis natoque penatibus et auctor ...</span>
                                <br />
                                <span class="text-grey-m1 text-85">
                                                  <i class="far fa-clock"></i>
                                                  a moment ago
                                              </span>
                              </div>
                            </a>
                            <hr class="my-1px brc-grey-l3" />
                            <a href="#" class="d-flex mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                              <img alt="Susan's avatar" src="assets/image/avatar/avatar3.png" width="48" class="align-self-start border-2 brc-primary-m3 p-1px mr-2 radius-round" />
                              <div>
                                <span class="text-primary-m1 font-bolder">Susan:</span>
                                <span class="text-grey text-90">Vestibulum id ligula porta felis euismod ...</span>
                                <br />
                                <span class="text-grey-m1 text-85">
                                                  <i class="far fa-clock"></i>
                                                  20 minutes ago
                                              </span>
                              </div>
                            </a>
                            <hr class="my-1px brc-grey-l3" />
                            <a href="#" class="d-flex mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                              <img alt="Bob's avatar" src="assets/image/avatar/avatar4.png" width="48" class="align-self-start border-2 brc-primary-m3 p-1px mr-2 radius-round" />
                              <div>
                                <span class="text-primary-m1 font-bolder">Bob:</span>
                                <span class="text-grey text-90">Nullam quis risus eget urna mollis ornare ...</span>
                                <br />
                                <span class="text-grey-m1 text-85">
                                                  <i class="far fa-clock"></i>
                                                  3:15 pm
                                              </span>
                              </div>
                            </a>
                            <hr class="my-1px brc-grey-l3" />
                            <a href="#" class="d-flex mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                              <img alt="Kate's avatar" src="assets/image/avatar/avatar2.png" width="48" class="align-self-start border-2 brc-primary-m3 p-1px mr-2 radius-round" />
                              <div>
                                <span class="text-primary-m1 font-bolder">Kate:</span>
                                <span class="text-grey text-90">Ciao sociis natoque eget urna mollis ornare ...</span>
                                <br />
                                <span class="text-grey-m1 text-85">
                                                  <i class="far fa-clock"></i>
                                                  1:33 pm
                                              </span>
                              </div>
                            </a>
                            <hr class="my-1px brc-grey-l3" />
                            <a href="#" class="d-flex mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                              <img alt="Fred's avatar" src="assets/image/avatar/avatar5.png" width="48" class="align-self-start border-2 brc-primary-m3 p-1px mr-2 radius-round" />
                              <div>
                                <span class="text-primary-m1 font-bolder">Fred:</span>
                                <span class="text-grey text-90">Vestibulum id penatibus et auctor  ...</span>
                                <br />
                                <span class="text-grey-m1 text-85">
                                                  <i class="far fa-clock"></i>
                                                  10:09 am
                                              </span>
                              </div>
                            </a>

                          </div><!-- ace-scroll -->

                          <hr class="my-1px brc-secondary-l2 border-double" />
                          <a href="page-inbox.html" class="mb-0 py-3 border-0 list-group-item text-purple text-uppercase text-center text-85 font-bolder">
                            See All Messages
                            <i class="ml-2 fa fa-arrow-right text-muted"></i>
                          </a>
                        </div><!-- .tab-pane : messages -->

                      </div>
                    </div>
                  </li>


                  <li class="nav-item">
                    <a href="#" class="nav-link pl-lg-3 pr-lg-4 pos-rel">
                      <i class="far fa-envelope text-110 icon-animated-vertical"></i>

                      <span class="d-inline-block d-lg-none ml-2">Messages</span><!-- show only on mobile -->
                      <span class="d-none d-lg-block text-600 text-orange-d3 text-85 position-tr mt-15 mr-2">+2</span>
                      <span class="d-lg-none text-600 text-orange-d3 text-90 ml-2">(+2)</span>
                    </a>
                  </li>


                  <li class="nav-item dropdown order-first order-lg-last dropdown-hover">
                    <a class="nav-link dropdown-toggle px-lg-2 ml-lg-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      <img id="id-navbar-user-image" class="d-none d-lg-inline-block radius-3px mr-1 brc-grey-m2 border-1" src="assets/image/avatar/avatar6.jpg" height="42" alt="Jason's Photo">

                      <span class="d-inline-block d-lg-none">Welcome, Jason</span><!-- show only on mobile -->

                      <i class="caret fa fa-ellipsis-v d-none d-xl-block"></i>
                      <i class="caret fa fa-angle-left d-block d-lg-none"></i>
                    </a>

                    <div class="dropdown-menu dropdown-caret dropdown-menu-right brc-primary-m3">
                      <div class="d-none d-lg-block">
                        <div class="dropdown-header">
                          Welcome, Jason
                        </div>
                        <div class="dropdown-divider"></div>
                      </div>

                      <a class="dropdown-item btn btn-outline-grey btn-h-light-blue btn-a-light-primblueary" href="page-profile.html">
                        <i class="fa fa-user text-primary-m1 text-105 mr-1"></i>
                        Profile
                      </a>

                      <a class="dropdown-item btn btn-outline-grey btn-h-light-green btn-a-light-green" href="#" data-toggle="modal" data-target="#id-ace-settings-modal">
                        <i class="fa fa-cog text-success-m1 text-105 mr-1"></i>
                        Settings
                      </a>

                      <div class="dropdown-divider brc-secondary-l2"></div>

                      <a class="dropdown-item btn btn-outline-grey btn-h-light-orange btn-a-light-orange" href="page-login.html">
                        <i class="fa fa-power-off text-orange-d2 text-105 mr-1"></i>
                        Logout
                      </a>
                    </div>
                  </li><!-- /.nav-item:last -->

                </ul><!-- /.navbar-nav menu -->
              </div><!-- /.navbar-nav -->

            </div><!-- /.navbar-menu.navbar-collapse -->


          </div><!-- /.container -->
        </div><!-- /.navbar-inner -->
      </nav>
      