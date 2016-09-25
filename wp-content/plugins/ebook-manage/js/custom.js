function trim(s) 
{
  while ((s.substring(0,1) == ' ') || (s.substring(0,1) == '\n') || (s.substring(0,1) == '\r'))
  {
    s = s.substring(1,s.length);
  }
  while ((s.substring(s.length-1,s.length) == ' ') || (s.substring(s.length-1,s.length) == '\n') || (s.substring(s.length-1,s.length) == '\r'))
  {
    s = s.substring(0,s.length-1);
  }
  return s;
}

function checkblank(a,b)
{
	if(a)
	{
		if (trim(a.value)=="")
		{
			alert("Please enter value for "+b);
			a.focus();
			return false;
		}
		return true;
	}
	else
		return false;
}

function checknumber(a,b) 
{
	if(a)
	{
		e=a.value;
		ok = "1234567890-+() ";
		for(i=0; i < e.length ;i++)
		{
			if(ok.indexOf(e.charAt(i))<0)
			{ 
				alert('Wrong value for '+b+'. Only number ,-+ or () allowed.');
				a.focus();
				return (false);
			}	
		} 
		return true;
	}
	else
		return false;
}

function checkemail(a) 
{
	if(a)
	{
		e=a.value;
		ok = "1234567890qwertyuiop[]asdfghjklzxcvbnm.@-_QWERTYUIOPASDFGHJKLZXCVBNM";
		for(i=0; i < e.length ;i++)
		{
			if(ok.indexOf(e.charAt(i))<0)
			{ 
				alert('Invalid E-Mail');
				a.focus();
				return (false);
			}	
		} 
		re = /(@.*@)|(\.\.)|(^\.)|(^@)|(@$)|(\.$)|(@\.)/;
		re_two = /^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		if (!e.match(re) && e.match(re_two)) 
		{
			return true;		
		} 
		alert('Invalid E-Mail');
		a.focus();
		return false;
	}
	else
		return false;
}
