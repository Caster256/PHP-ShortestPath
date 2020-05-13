//判斷帳號密碼是否有按照規定
function form_signin()
{					
	var txt1 = document.getElementById('txt').value;
	var pwd1 = document.getElementById('pwd').value;			
	if (txt1.length > 0 && txt1.length < 4)
	{
		alert("請輸入帳號 4(含)個字以上");
		return false;
	}
	else if (txt1.length == 0)
	{
		alert("請輸入帳號");
		return false;
	}
	else
	{
		if (pwd1.length >0 && pwd1.length < 4)
		{
			alert("請輸入密碼 4(含)個字以上");
			return false;
		}
		else if (pwd1.length == 0)
		{
			alert("請輸入密碼");
			return false;
		}
		else
			return true;
	}
}
//註冊帳號密碼判斷是否有按照規定
function form_registered()
{					
	var txt1 = document.getElementById('txt').value;
	var pwd1 = document.getElementById('pwd').value;
	var name1 = document.getElementsByName('name')[0].value;
	if (name1 != "")
	{
		if (txt1.length > 0 && txt1.length < 4)
		{
			alert("請輸入帳號 4(含)個字以上");
			return false;
		}
		else if (txt1.length == 0)
		{
			alert("請輸入帳號");
			return false;
		}
		else
		{
			if (pwd1.length >0 && pwd1.length < 4)
			{
				alert("請輸入密碼 4(含)個字以上");
				return false;
			}
			else if (pwd1.length == 0)
			{
				alert("請輸入密碼");
				return false;
			}
			else
				return true;
		}	
	}
	else
	{
		alert("請輸入名字");
		return false;
	}
}
//判斷起始位置是否有輸入地址
function form_firstads()
{					
	var name1 = document.getElementsByName('faddress')[0].value;		
	if (name1 != "")
	{		
		return true;
	}
	else
	{
		alert("請輸入地址");
		return false;
	}
}
//判斷終點位置是否有輸入地址
function form_lastads()
{					
	var name1 = document.getElementsByName('laddress')[0].value;		
	if (name1 != "")
	{
		return true;
	}
	else
	{
		alert("請輸入地址");
		return false;
	}
}	
//判斷使用者新增學生資料是否有輸入資料
function form_insert()
{					
	var ads = document.getElementsByName('sa')[0].value;
	var name = document.getElementsByName('sn')[0].value;			
	if (name != "")
	{
		if (ads != "" )
		{
			//alert("success!!");
			return true;
		}
		else
		{
			alert("請輸入地址");
			return false;
		}
	}
	else
	{
		alert("請輸入學生名字");
		return false;
	}
}