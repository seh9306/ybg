<?php
require_once('../db.php');

function display_header($title,$n){

?>
	<!doctype html>
	<html lang="ko">
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1.0,maximum-scale=1.0">  
	<meta name="Generator" content="EditPlus®">
	<meta name="Author" content="">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<script src="jquery-2.1.1.min.js"></script>
	<style>
	@font-face{
		font-family:'heum';
		src:local(""),url("/fonts/HUBubb.ttf");
		}

		.btn { overflow:hidden; background:#f6f6f6; margin:10px; padding:2%; border: 10px; border-radius:10px; box-shadow: 0 1px 3px rgba(0,0,0,.15); cursor:pointer; font-style:normal;}
		.btn:hover { background:#d9d9d9; }
		/* 페이지 전체 화면의 100% */

		html,body { margin: 0px; font-family:heum; width:100%; height:100%; }

		/* 헤더 20% */

		body div#header { position:relative; background:#e9e9e9; overflow:hidden; height:20%; }

		/* 헤더 콘텐츠 left each : 80% , 100% */

		body div#header img#back { float:left; width:5%; height:50%; }
		body div#header img#main { position:relative; width:35%; height:100%; left:27.5%; }

		/* 바디 80% */
		body div#body { position:relative; height:80%; }
		body div#body p.btn { font-size:50px; height:10%; }


		<?php if($n==1){  ?>
		/* 입력페이지를 위한 스타일 */
		div#box { height:70%; }
		div#box div.box { padding:15px; width:80%; height:70%; display:none; background: #d9d9d9; border-radius:10px; overflow:hidden; }
		div#box div.box span.btn { margin:20px; border:20px; position:relative; height:20px; font-size:15px; }
		div#box div.box input#group { font-size:50px; width:50%; margin:2%; }
		div#box div.box select { font-size:50px; width:20%; height:40%; padding:10%;}
		div#box div.box select option { font-size:50px; }

//		div#box div.box form#input 
//		<?php
//		if($_POST[style_boolean]==1)
//			echo "{ display:visible; }";
//		else 
//			echo "{ display:none;}";
//		?>


		div#box div.box form#input input { margin:20px; padding:10px; }
		div#box div.box form#input select { margin:10px; padding:10px; font-size:15px; }
		div#box div.box form#input input.btn { margin:0px; } 
		div#box div.box p#searchta { display:none; };
		/* 입력페이지를 위한 스타일 END */
		<?php } ?>



		<?php if($n==2){ ?>
		/* 조회하기를 위한 스타일 */
		.fireclass { background:rgba(255,0,0,.5); position:absolute; padding:2px 10px; border:solid black 1px; border-radius:10px; box-shadow: 0 1px 3px rgba(0,0,0,.15); cursor:pointer; font-style:normal; }
		.homeclass { background:rgba(255,255,0,.5); position:absolute; padding:2px 10px; border:solid black 1px; border-radius:10px; box-shadow: 0 1px 3px rgba(0,0,0,.15); cursor:pointer; font-style:normal; }
		.soolclass { background:rgba(0,255,255,.5); position:absolute; padding:2px 10px; border:solid black 1px; border-radius:10px; box-shadow: 0 1px 3px rgba(0,0,0,.15); cursor:pointer; font-style:normal; }
		.soolclass2 { background:rgba(255,0,255,.5); position:absolute; padding:2px 10px; border:solid black 1px; border-radius:10px; box-shadow: 0 1px 3px rgba(0,0,0,.15); cursor:pointer; font-style:normal; }

		.fire { left:30%; top:12%;}
		.mopp { left:40%; top:30%; }
		.cpr  { left:53%; top:22%; }

		.tree { left:6%; top:20%; }
		.city { left:15%; top:38%; }
		.gum  { left:19%; top:47.5%; }
		.find { left:41%; top:54%; }

		.bomb { left:18%; top:75%; }

		.bomb2 { left:67%; top:14.3%; }

		.firetitle { left:0%; top:40%; }
		.sool { left:25%; top:40%; }
		.sool2 { left:50%; top:40%; }
		.home { left:75%; top:40%; }
		body div#body img { height:100%; width:100%; }
		body div#body p { width:25%; height:5%; overflow:hidden; font-size:100%; } 
		body div#body a { width:25%; height:5%; font-size:100%; background:rgba(200,255,255,.5); position:absolute; padding:2px 10px; border:solid black 1px; border-radius:10px; box-shadow: 0 1px 3px rgba(0,0,0,.15); cursor:pointer; font-style:normal; text-decoration:none; color:black; } 
		/* 조회하기를 위한 스타일 END */
		<?php } ?>


	</style>
	<title><?php echo $title; ?></title>
<?php
}

// 첫페이지의 시작

function display_menu(){
	$query = "select * from main_page order by order_num";
	$result = dbconn($query); // require_once('db.php');

	for($i=0; $i<$result->num_rows; $i++){
		$row = $result->fetch_assoc();
		if($i==0) echo '<script> $(function(){';
		 ?>	
			$('<p class="btn"><?php echo $row[page_content]; ?></p>').appendTo('body div#body').click(function(){ location.assign("<?php echo $row[url_info]; ?>"); });
		<?php if ($i==$result->num_rows-1) echo '}); </script> ';
	}
	
				// $('body').html('<p></p>'); 
				// 이렇게 쓰면 기존의 JQuery에 있던 내용들은 사라지고, 새로운 값이 내용으로 삽입된다.
				// assign(location) -> 페이지를 이동하는데, 히스토리가 남는다.
				// replace(location) -> don't make history
}

// 입력 페이지의 시작

function display_select($table){
	$query = "select * from ".$table." order by order_num";
	$result = dbconn($query); // require_once('db.php');
	if($result->num_rows==0)
		echo '<script> $(function(){  ';
	for($i=0; $i<$result->num_rows; $i++){
		$row = $result->fetch_assoc();
		if($i==0) echo '<script> $(function(){  ';
	?>	
	
	var tag ='<p class="btn"><?php echo $row[page_content]; ?></p>'
	$(tag).appendTo('body div#body div#content')
	<?php //if ($i==$result->num_rows-1) echo '}); </script> ';
	}
	$result->close();

 	?>

	// update mySQL
	<?php if($_POST[style_boolean]==1){ ?>
	$('body div#body p.btn').toggle().eq(<?php echo $_POST[order_num];?>).show();
	$('body div#box div.box').toggle().find('form#input input[name=order_num]').val(<?php echo $_POST[order_num];?>);
//here~~
	<?php 
//	mb_internal_encording('utf8');
	$group_num = $_POST['group_num'];
	$arr = split(",",$group_num);

	$query = "select page_content from ".$table." where order_num ='".($_POST[order_num]+1)."'";
	$result = dbconn($query);
	$row = $result->fetch_assoc();
	if($table=='sool_page'){// 전술1이 합격일 경우 전술2에서 합격 입력을 넣었을 시 혼동되지 않도록 하기 위한 쿼리작성
		// MySQL 함수로도 작성해보자 나중에
		if(mb_substr($row['page_content'],mb_strlen($row['page_content'],'utf8')-1,mb_strlen($row['page_content'],'utf8'),'utf8')=='2'){ // 문자셋을 설정하여 데이터 베이스에서 불러온 문자를 짤라서 반환하는데 마지막 자리것을 반환하는 함수
		$query = "select * from success where 조='".$_POST['group_num']."' && ".str_replace(' ','',mb_substr($row['page_content'],0,mb_strlen($row['page_content'],'utf8')-1,'utf8'))."='y'";
		}//쿼리에 2를 뺀 칼럼을 입력한다
		
		else
		$query = "select * from success where 조='".$_POST['group_num']."' && ".str_replace(' ','',$row['page_content'])."2='y'";
		 //쿼리에 2를 추가 시킨 칼럼
		$result2 = dbconn($query);
		if(!$result2->num_rows){ // 데이터베이스에 쿼리했을때 갯수가 0이 아니면
			$query = "update success set ".str_replace(' ','',$row['page_content'])."='".$_POST['success']."' where 조 = '".$arr[0]."'";  //업데이트 쿼리를 실행하여 본 칼럼에 추가한다
			for($i=1;$i<count($arr);$i++)
				$query = $query."||조 = '".$arr[$i]."'";
		$result = dbconn($query); //업데이트 쿼리를 실행하여 본 칼럼에 추가한다
		}
	}
	else{
	$query = "update success set ".str_replace(' ','',$row['page_content'])."='".$_POST['success']."' where 조 = '".$arr[0]."'";
	for($i=1;$i<count($arr);$i++)
		$query = $query."||조 = '".$arr[$i]."'";
	$result = dbconn($query);
	}
	
	} ?>
	//here end
	$('body div#body p.btn').click(function(){ 
	
		var order_num = $(this).index();
			$('body div#body p.btn').toggle().eq(order_num).show();
			$('body div#box div.box').toggle().find('form#input input[name=order_num]').val(order_num);

	});
	
	// 입력부분
	$('body div#box div.box span.btn.input').click(function() {
		$('body div#box div.box p#searchta').hide('fast').siblings('form#input').toggle('fast');

	});
	// 필요없는 부분
	$('body div#box div.box div#input p.btn').click(function() {
	<?php
	// 입력식 인풋 박스에 값을 구해 그 값을 조로 사용하고, 합격으로 넣어준다.
	// 페이지는 나눠져 있고, $(this).index() 몇번째 값(mysql상에서 order_num을 의미)
	// 에 있는 과제인지를 구하고 해당과제의 해당 인풋박스 값을 조로 해서 합격 시킨다.
		$query = "update success set 사격='y' where 조 =''";
		$result = dbconn($query); // require_once('db.php');
	?>	
		
	});

	// 조회 부분
	$('body div#box div.box span.btn.search').click(function() {
	//	var idb;
	//	switch(location.pathname.slice(1,-5)){
	//	case fire:<?php
	//			idb ="select from success"
	//		?> 
		$('body div#box div.box form#input').hide('fast');
		$('body div#box div.box p#searchta').toggle('fast');
	});

	$('body div#box div.box ').click(function() {
		var i = $(this).index();
	});



});
	</script>
<?php
}

function moving_script() {

?>
	<script>
		$(function(){
			
			//var r = 'body div#body p';
			//$(r).hover(
			//	function(){ $(this).css('background', '#e9e9e9')},
			//	function(){ $(this).css('background', '#f6f6f6')} 
			//); 
			// hover event can realize css3 style but cann't realize animation.



			//$('body').keydown(function(){
			//	<?php 
			//		$query = "select admin from admin";
			//		$result = dbconn($query); // require_once('db.php');
			//		$row = $result->fetch_assoc();
			//	?>
			//	switch(event.keyCode){
			//		case 65:	
			//			<?php
			//				if ($row[admin]=='a')
			//				{
			//					$query = "update admin set admin='b' where admin='a'";
			//					$result = dbconn($query);
			//				}
			//			?>
			//	}
			//});
			// ..
		});
	</script>
<?php
}



function display_body($n,$pathname) {
	// try{  throw new Exception("Error Message",1); How to use Exception
?> 
	</head>
	<body>
		<div id='header'>
			<img src='back.svg' id='back'>
			<img src='main.png' id='main'>
		</div>
		<script>	$('body div#header img#back').click(function(){ history.go(-1); });  </script>
		<div id='body' align='center'>
			<?php if($n==2){ 
			?>
			<p class='fireclass fire'>사격: <?php echo dbconnc('사격','w'); ?></p>
			<p class='fireclass mopp'>mopp: <?php echo dbconnc('mopp','w'); ?></p>
			<p class='fireclass cpr'>구급법: <?php echo dbconnc('구급법','w'); ?></p>

			<p class='soolclass bomb'>전술1: <?php echo dbconnc('적포탄낙하시','w'); ?></p>

			<p class='soolclass2 bomb2'>전술2: <?php echo dbconnc('적포탄낙하시2','w'); ?></p>

			<p class='homeclass tree'>목진지: <?php echo dbconnc('목진지전투','w'); ?></p>
			<p class='homeclass city'>시가지: <?php echo dbconnc('시가지전투','w'); ?></p>			
			<p class='homeclass gum'>검문소: <?php echo dbconnc('검문소','w'); ?></p>
			<p class='homeclass find'>수색: <?php echo dbconnc('수색','w'); ?></p>
			<a href="search_all.html" style="top:10%;">상세조회</a>
			<a href="index.html">뒤로가기</a>
			<img src="map.png">
			<?php } ?>
			<?php if($n==1){ ?>
		<div id='content'></div>
		<div id='box' align='center'>
			<div class='box'>
				<form id='input' align='center' method='post' action=''>
					<input name='group_num' type='text' id='group'><br>
					<input name='style_boolean' type='hidden' value='1'>
					<input name='order_num' type='hidden' value=''>
					<input type='button'>
					<select name="success">
						 <option value="y">합격
						 <option value="n">불합격
						 <option value="w">대기중
					</select>
					<input type='submit' class='btn' size=50% value='입 력'>
			</form>
				<p id='searchta'>
					<?php switch($pathname){ 
					case 1: 
						echo "<b>사격 :".dbconnc('사격','y')."조<br>구급법 :".dbconnc('구급법','y')."조<br>mopp; :".dbconnc('mopp','y')."조</b>";break;
					case 2:
						echo "<b>적 포탄 낙하시 : ".(dbconnc('적포탄낙하시','y')+dbconnc('적포탄낙하시2','y'))."조<br>탄도화기사격조 공격 : ".(dbconnc('탄도화기사격조공격','y')+dbconnc('탄도화기사격조공격2','y'))."조<br>화생방 공격시 : ".(dbconnc('화생방공격시','y')+dbconnc('화생방공격시2','y'))."조<br>복합장애물 극복 : ".(dbconnc('복합장애물극복','y')+dbconnc('복합장애물극복2','y'))."조<br>수류탄 투척 : ".(dbconnc('수류탄투척','y')+dbconnc('수류탄투척2','y'))."조<br>환자발생시 조치 : ".(dbconnc('환자발생시조치','y')+dbconnc('환자발생시조치2','y'))."조</b>"; break;
					case 3:
						echo "<b>목진지 전투 : ".dbconnc('목진지전투','y')."조<br>시가지 전투 :".dbconnc('시가지전투','y')."조<br>검문소 : ".dbconnc('검문소','y')."조<br>수색 : ".dbconnc('수색','y')."조</b>"; break;
					case 4:
						echo "<b>안보교육 : ".dbconnc('안보교육','y')."조</b>"; break;
}?>   
				</p>
			</div>
		</div>
		<?php } ?>
		</div>
	</body>
</html>
<?php

	//	} catch(exception $e) { 
	//echo "Exception ". $e->getCode(). ": ". $e->getMessage()."<br />". " in ". $e->getFile(). " on line ". $e->getLine(). "<br />"; 
	//}
}
?>
