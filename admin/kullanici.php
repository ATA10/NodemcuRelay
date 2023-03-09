<?php include('inc/header.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kullanıcılar
      </h1>
   
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="col-md-12">
          <?php

            if(isset($_GET['duzenSubmit'])) {
              $username = $_GET['username'];
              $isim = $_GET['isim'];
              $pass = $_GET['password'];
              $id = $_GET['id'];
              $guncelle = DB::exec('UPDATE kullanici set username = ?, isim = ?, password = ? WHERE id = ?', array($username, $isim, $pass, $id));

            }

            if(isset($_GET['duzenle'])) {
              $id = $_GET['duzenle'];
              $users = DB::getRow('SELECT * FROM kullanici WHERE id = ?', array($id));
              $username = $users->username;
              $isim = $users->isim;
              $pass = $users->password;

              echo '
              <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Düzenle #'.$id.'</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="GET">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Username" value="'.$username.'">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">İsim</label>
                  <input type="text" name="isim" class="form-control" id="exampleInputEmail1" placeholder="İsim" value="'.$isim.'">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="text" name="password" class="form-control" id="exampleInputEmail1" placeholder="Password" value="'.$pass.'">
                </div>
                <input type="hidden" name="id" value="'.$id.'">
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="duzenSubmit" class="btn btn-primary">Gönder</button>
              </div>
            </form>
          </div>
              
              ';
            }
			
			
	

            if(isset($_GET['sil'])) {
              $id = $_GET['sil'];
              $users = DB::getRow('DELETE FROM kullanici WHERE id = ?', array($id));
        

 
            }
          ?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Kullanıcılar</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>Username</th>
                  <th>İsim</th>
                  <th>İşlem</th>
				  <th>sil</th>
                </tr>
                <?php
                  $users = DB::query('SELECT * FROM kullanici ORDER BY id ASC');

                  foreach($users as $user)
                  {
                    echo '<tr>';
                    echo '<td>'.$user->id.'</td>';
                    echo '<td>'.$user->kullanici.'</td>';
                    echo '<td>'.$user->sifre.'</td>';
                    echo '<td><a href="?duzenle='.$user->id.'" type="button" class="btn btn-info">Düzenle</button></td>';
					echo '<td><a href="?sil='.$user->id.'" type="button" class="btn btn-info">sil</button></td>';
                    echo '</tr>';
                  }
			          ?>
                
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		   <form method="GET">
					
						
						<div><input type="text" name="isim1">kullanıcı adı</div>
						<div><input type="text" name="sifre1" >şifre</div>
						

						<button type="submit" name="EkleSubmit" class="btn btn-primary">Gönder</button>
					</form>
					<?php
					  if(isset($_GET['EkleSubmit'])) {
              
              $thumb = $_GET['isim1'];
              $pic = $_GET['sifre1'];
              
              $guncelle = DB::exec("INSERT INTO kullanici(kullanici, sifre) values ('$thumb', '$pic')");

            }	

					?>
        </div>
			 

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>