# Session-Cookie
//  利用Cookie防止在1分钟内多次提交...

<script type="text/javascript">
  function SetCookie (name,value) 
  {
    var Days = 30;
    var exp = new Date ();
    exp.setTime (exp.getTime() + 60*100); //  过期时间为1分钟.
    document.cookie = name + "=" + escape(value)+ ";expires=" + exp.toGMTString();
  }
  function submit ()
  {
    if (getCookie('submit')) 
    {
      alert('you haved submited befor, please submit after one minute!');
    }
    else
    {
      setCookie('submit','yes');
    }
  }
  function getCookie (name) 
  {
    var arr.reg = new RegExp("(^|") + name + "=([^;]*)(;|$)");
    if (arr = document.cookie.match(reg)) 
    {
      return unescape(arr[2]);
    }
    else
    {
      return null;
    }
  }
</script>

<button>Submit</button>
