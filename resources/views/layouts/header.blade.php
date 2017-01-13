<header class="main-header">
   <a href="/" class="logo" title="TECHSYSSMS">
      <span class="logo-mini">TECHSYS<strong>SMS</strong></span>
      <span class="logo-lg">TECHSYS<strong>SMS</strong></span>
   </a>
   <!-- Logo -->

   <nav class="navbar navbar-static-top" role="navigation">

      <a href="javascript:;" class="sidebar-toggle x-sidebar-toggle" data-toggle="offcanvas" role="button">
         <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Sidebar toggle button-->

      <div class="navbar-custom-menu">
         <ul class="nav navbar-nav">
            <li class="dropdown user">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                  <i class="fa fa-user margin-r-5"></i>
                  <span><!--{$account_name|escape|default:''}--></span>
               </a>
               <ul class="dropdown-menu p-d-5 text-left">
                  <li><a href="/user/<!--{$account_id|escape|default:''}-->" title="ユーザー情報"><b><i class="fa fa-user margin-r-5"></i>ユーザー情報</b></a></li>
                  <li><a href="/user/<!--{$account_id|escape|default:''}-->/change_password" title="PW変更"><b><i class="fa fa-key margin-r-5"></i>PW変更</b></a></li>
               </ul>
            </li>

            <li><a href="/login/logout" class="x-logout" title="ログアウト"><b><i class="fa fa-sign-out margin-r-5"></i> ログアウト</b></a></li>
         </ul>
      </div>
      <!-- Navbar Right Menu -->

   </nav>
   <!-- Header Navbar -->

</header>
<!-- Main-header -->