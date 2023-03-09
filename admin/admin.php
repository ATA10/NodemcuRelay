<?php 
	include('inc/header.php'); 
	
	$ip = "http://192.168.1.8/";

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kapı Otomasyon Sistemi
        
      </h1>
	    --------------------------------------------------------------------------------------------
	 <h1>
      
        
     </h1>
		---------------------------------------------------------------------------------------------
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
        <li class="active">Lab-1</li>
      </ol>
    </section>

    <!-- Main content -->
    <div class="col-md-12">
	  <ul class="topstats clearfix">
		<li class="arrow"></li>
		<li class="col-xs-6 col-lg-2">
		  <span class="title"><i class="fa fa-dot-circle-o color-down"></i> GİRİLEN DEGER</span>
		  <h3 id="status">------</h3>
		</li>

		<li class="col-xs-6 col-lg-2">
		  <span class="title"><i class="fa fa-clock-o"></i> Son Güncelleme</span>
		  <h3 class="color-down" id="tarih" >X:xx</h3>
		</li>
	  </ul>
    </div>
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
	<?php 
		//get ile gelen verileri kontrol ederek nodemcuya istek yolladık
		if(isset($_GET['kapi_ac'])) {
			echo file_get_contents($ip . "kapi_ac");
			echo '<br>';
		}
				if(isset($_GET['kapi_kapat'])) {
			echo file_get_contents($ip . "kapi_kapat");
			echo '<br>';
		}
		

		?>
	
        <a href="?kapi_ac" class="btn btn-primary">KAPI AÇ</a><br><br>
        <a href="?kapi_kapat" class="btn btn-danger">kapıyı kilitle</a><br><br>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
	
		$(document).ready(function(){
			console.log("Test");
			var interval = 4000;  // 1000 = 1 second, 3000 = 3 seconds
			function doAjax() {
				$.ajax({
					type: 'GET',
					url: '<?php echo $ip; ?>read',
					data: $(this).serialize(),
					dataType: 'text',
					success: function (data) {
						console.log(data);
							var tarih = tarihAL();
							console.log(tarih);
						    var arr = data.split("|");
							var veri = "sifre: " + arr[0] + " Tarih	: " + tarih;
							//$('#veri').html(data);// first set the value
							$("#status").html(arr[0]);							
							$("#tarih").html(tarih);	
							//$("#header ul").append('<li> ' + veri2 + '</li>');
							sendPhp(data);
					},
					complete: function (data) {
							// Schedule the next
							setTimeout(doAjax, interval);
					}
				});
			}
			setTimeout(doAjax, interval);
			function sendPhp(e) {
				$.ajax({
					type: 'POST',
					url: 'kaydet.php',
					data: {
						'data': e        },
					success: function(data) {
						if (data == 'ok') {
							console.log('All good. Everything saved!');
						} else {
							console.log('something went wrong...');
						} 
					}
				});
			}
									
			function tarihAL() {
				var d = new Date();

				var curr_day = d.getDate();
				var curr_month = d.getMonth();
				var curr_year = d.getFullYear();

				var curr_hour = d.getHours();
				var curr_min = d.getMinutes();
				var curr_sec = d.getSeconds();

				curr_month++ ; // In js, first month is 0, not 1
				year_2d = curr_year.toString().substring(2, 4)

				return curr_hour + ":" + curr_min + ":" + curr_sec;
			}

		});
		
		

		

	</script>
</body>
</html>