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

		html,body { margin: 0px;width:100%; height:100%; }

		/* 헤더 20% */

		body div#header { position:relative; background:#e9e9e9; overflow:hidden; height:20%; }

		/* 헤더 콘텐츠 left each : 80% , 100% */

		body div#header img#back { float:left; width:5%; height:50%; }
		body div#header img#main { position:relative; width:35%; height:100%; left:27.5%; }

		/* 바디 80% */
		body div#body { position:relative; height:80%; }
		body div#body p.btn { font-size:40px; height:10%; }


		<?php if($n==1){  ?>
		/* 입력페이지를 위한 스타일 */
		div#box { height:70%; }
		div#box div.box { position:relative; padding:15px; width:80%; height:80%; display:none; background: #d9d9d9; border-radius:10px; overflow:hidden; }
		div#box div.box form input.btn { position:absolute; margin:0; left:70%; top:35%;}
		div#box div.box form input#group { position:absolute; left:25%; top:5%; font-size:150%; width:50%; height:20%;}
		div#box div.box form select { position:absolute; left:25%; top:30%;  font-size:150%; width:40%; margin:3%; }
		div#box div.box p#searchta { position:absolute; left:45%; top:50%; font-size:150%;} 
		/* 입력페이지를 위한 스타일 END */
		<?php } ?>




	</style>
	<title><?php echo $title; ?></title>
<?php
}

// 첫페이지의 시작

function display_menu(){
	$query = "select * from main_page order by order_num";
	$result = dbconn($query); // require_once('db.php');
	$num = $result->num_rows;
	for($i=0; $i<$num; $i++){
		$row = $result->fetch_assoc();
		if($i==0) echo '<script> $(function(){';
		 ?>	
			$('<p class="btn"><?php echo $row[page_content]; ?></p>').appendTo('body div#body').click(function(){ location.assign("<?php echo $row[url_info]; ?>"); });
		<?php if ($i==$num-1) echo '}); </script> ';
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
	$num = $result->num_rows;
	if($num==0)
		echo '<script> $(function(){  ';
	for($i=0; $i<$num; $i++){
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
	$('body div#box div.box').show();
		
	<?php 
//	mb_internal_encording('utf8');
	$group_num = $_POST['group_num'];
	$arr = split(",",$group_num);
	for($i=0;$i<count($arr);$i++)
			
	$query = "select page_content from ".$table." where order_num ='".($_POST[order_num]+1)."'";
	$result = dbconn($query);
	$row = $result->fetch_assoc();
	if($table=='sool_page'){// 전술1이 합격일 경우 전술2에서 합격 입력을 넣었을 시 혼동되지 않도록 하기 위한 쿼리작성
		// MySQL 함수로도 작성해보자 나중에
		if(mb_substr($row['page_content'],mb_strlen($row['page_content'],'utf8')-1,mb_strlen($row['page_content'],'utf8'),'utf8')=='2'){ // 문자셋을 설정하여 데이터 베이스에서 불러온 문자를 짤라서 반환하는데 마지막 자리것을 반환하는 함수
		$query = "select * from success where 조='".$_POST['group_num']."' && ".str_replace(' ','',mb_substr($row['page_content'],0,mb_strlen($row['page_content'],'utf8')-1,'utf8'))."='y'";
		$ch = 1;
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
	

	// 조회 부분
	$('body div#box div.box span.btn.search').click(function() {
		$('body div#box div.box form#input').hide('fast');
		$('body div#box div.box p#searchta').toggle('fast');
	});




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

			<p class='soolclass bomb'>전술Ⅰ: <?php echo dbconnc('적포탄낙하시','w'); ?></p>

			<p class='soolclass2 bomb2'>전술Ⅱ: <?php echo dbconnc('적포탄낙하시2','w'); ?></p>

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
		<div id='box'>
			<div class='box'>
				<form id='input' align='center' method='post' action=''>
					<input name='group_num' type='text' id='group'><br>
					<input name='style_boolean' type='hidden' value='1'>
					<input name='order_num' type='hidden' value=''>
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
						echo "<b>사격 : 총 ".dbconnc('사격','y')."조<br>구급법 : 총 ".dbconnc('구급법','y')."조<br>mopp : 총 ".dbconnc('mopp','y')."조</b>";break;
					case 2:
						echo "<b>적 포탄 낙하시 : 총 ".(dbconnc('적포탄낙하시','y')+dbconnc('적포탄낙하시2','y'))."조<br>탄도화기사격조 공격 : 총 ".(dbconnc('탄도화기사격조공격','y')+dbconnc('탄도화기사격조공격2','y'))."조<br>화생방 공격시 : 총 ".(dbconnc('화생방공격시','y')+dbconnc('화생방공격시2','y'))."조<br>복합장애물 극복 : 총 ".(dbconnc('복합장애물극복','y')+dbconnc('복합장애물극복2','y'))."조<br>수류탄 투척 : 총 ".(dbconnc('수류탄투척','y')+dbconnc('수류탄투척2','y'))."조<br>환자발생시 조치 : 총".(dbconnc('환자발생시조치','y')+dbconnc('환자발생시조치2','y'))."조</b>"; break;
					case 3:
						echo "<b>목진지 전투 : 총".dbconnc('목진지전투','y')."조<br>시가지 전투 :".dbconnc('시가지전투','y')."조<br>검문소 : 총".dbconnc('검문소','y')."조<br>수색 : 총 ".dbconnc('수색','y')."조</b>"; break;
					case 4:
						echo "<b>안보교육 : 총 ".dbconnc('안보교육','y')."조</b>"; break;
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
