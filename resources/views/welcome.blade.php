<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->


    </head>
    <body>
        <header id="header">
		    <div class="container">
		    	<div class="row align-items-center d-flex">
		    		<div class="col-2">
				      <div id="logo">
				        <a href="index.html"><img src="img/logo.png" alt="" title="" /></a>
				      </div>
				  </div>
				  <div class="col-10">
				      <nav id="nav-menu-container">
				        <ul class="nav-menu">
				          <li class=""><a href="index.html">Home</a></li>
				          <li class="menu-has-children"><a href="">For Canidates</a>
				            <ul>
				            	<li><a href="canidate_applied_jobs.html">Applied Jobs</a></li>
						        <li><a href="canidate_job_alerts.html">Job Alerts</a></li>
						        <li><a href="canidate_listings.html">Canidate Listings</a></li>
						        <li><a href="canidate_profile.html">Canidate Profile</a></li>
								<li><a href="canidate_resume.html">Canidate Resume</a></li>
								<li><a href="canidate_resume_manger.html">Resume Manager</a></li>
								<li><a href="canidate_saved_jobs.html">Saved Jobs</a></li>
								<li><a href="canidate_change_password.html">Change Password</a></li>
				            </ul>
				          </li>
				          <li class="menu-has-children"><a href="">For Employers</a>
				            <ul>
				            	<li><a href="employer_profile.html">Employer Profile</a></li>
				            	<li><a href="employer_list.html">Employer List</a></li>
						        <li><a href="employer_list_detail.html">Employer List Detail</a></li>
						        <li><a href="employer_manage_jobs.html">Manage Jobs</a></li>
						        <li><a href="employer_shortlist_resume.html">Shortlist Resume</a></li>
								<li><a href="employer_packages.html">Packages</a></li>
								<li><a href="employer_transactions.html">Transactions</a></li>
								<li><a href="employer_post_job.html">Post a job</a></li>
								<li><a href="employer_job_alerts.html">Job Alerts</a></li>
								<li><a href="employer_change_password.html">Change Password</a></li>
				            </ul>
				          </li>
				          <li class="menu-has-children"><a href="">Pages</a>
				            <ul>
				            	<li><a href="post_a_job.html">Post A Job</a></li>
				            	<li><a href="category.html">Job Category</a></li>
				            	<li><a href="about-us.html">About Us</a></li>
				            	<li><a href="contact.html">Contact</a></li>
						        <li><a href="category.html">Category</a></li>
						        <li><a href="price.html">Price</a></li>
						        <li><a href="blog-home.html">Blog</a></li>
						        <li><a href="blog-single.html">Blog Detail</a></li>
						        <li><a href="404.html">404 Page</a></li>
								<li><a href="elements.html">elements</a></li>
								<li><a href="search.html">search</a></li>
								<li><a href="single.html">single</a></li>
								<li><a href="logged_navbar.html">Signed In</a></li>
								<li><a href="signin.html">Signin Page</a></li>
								<li><a href="signup.html">Signup Page</a></li>
				            </ul>
				          </li>
				          <li><a class="ticker-btn-nav btn_login mt-1" href="signin.html"><i class="lnr lnr-user pr-1"></i> Login</a></li>
				    	  <li><a class="nav_btn mt-1" href="signup.html"><i class="lnr lnr-briefcase pr-1"></i> Create Account</a> </li>
				        </ul>
				      </nav><!-- #nav-menu-container -->
				    </div>
		    	</div>
		    </div>
		  </header><!-- #header End-->
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
