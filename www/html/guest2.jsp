<%@ page contentType="text/html; charset=EUC-KR" errorPage="guestbookError.jsp" %>
<% request.setCharacterEncoding("euc-kr"); %>



<html>
 <head>
  <title> ���� </title>
    <script>
        
        function goSubmit(){
          
          var fName= document.form1;
          
          if(fName.gb_name.value==""){
            fName.gb_name.focus();
            alert("�ۼ��ڸ� �Է��ϼ���");
            return;
          }else if(fName.gb_mail.value==""){
            fName.gb_mail.focus();
            alert("�̸����� �Է��ϼ���");
            return;
          }else if(fName.gb_passwd.value==""){
            fName.gb_passwd.focus();
            alert("��й�ȣ�� �Է��ϼ���");
            return;
          }else if(fName.gb_contents.value==""){
            fName.gb_contents.focus();
            alert("������ �Է��ϼ���");
            return;
          }
          
          
         fName.submit();
       
			    
        }
        //-->
    </script>
 </head>

<center>
 <body bgcolor="#D4F4FA">

		<h2>::::����::::</h2>
		<form name="form1" method="post" action="guestbookControl.jsp">
		<input type=hidden name="action" value="1001">
		<input type=hidden name="gb_id" >
		
		
		<table cellpadding=5 cellspacing=0 border="1">
				<tr>
					<td bgcolor="#FFFF48">�ۼ���</td>
					<td><input type="text" name="gb_name" size="20"></td>
				</tr>
				<tr>
					<td bgcolor="#FFFF48">�̸���</td>
					<td><input type="text" name="gb_mail" size="20"></td>
				</tr>
				
				<tr>
					<td bgcolor="#FFFF48">��й�ȣ</td>
					<td><input type=password" name="gb_passwd" size="20"></td>
				</tr>
				
				<tr>
					<td colspan="2">
					<textarea rows="5" name="gb_contents" cols="40" maxlength="4000"></textarea>
					</td>
				</tr>
				
				<tr >
					<td colspan="2" align="center">
					<input type="button" value="����" onclick="goSubmit()"><a href="guestbookList.jsp">�������</a>
					
					</td>
				</tr>
			</table>
		</form>
	</center>
 </body>
</html>
