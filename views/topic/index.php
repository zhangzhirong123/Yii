 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Document</title>
 	<script src="js/jquery.js" type="text/javascript" charset="utf-8"></script>
 </head>
 <body>
 		<h2 align="center">投票结果</h2>
 		<?php 
 			foreach($arr as $v){
		?>
			<div style="height: 200px;width: 300px;float: left;margin-top: 200px;margin-left: 100px;border-width: 2px;border-style: solid;border-color: yellow;" >
				<div style="height:35px;width: 50px;position:relative; top:0px; left:0px;"  class="three"></div>
				<p style="text-align: center;clear: both;font-size: 24px;"><?= $v['v_titlle']."<br/>".$v['v_num'] ?></p>
			</div>	
		<?php
 			}
 		?>
 </body>
 </html>
 <script  type="text/javascript">
 	$(function(){
 		$('.three:eq(0)').html('No.1');
 		$('.three:eq(1)').html('No.2');
 		$('.three:eq(2)').html('No.3');
 	})
 </script>
