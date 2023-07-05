export default class Cookie
{
    get(name) {
        let cookie = {};
  
        document.cookie.split(';').forEach(function(el) {
          let [k,v] = el.split('=');
          cookie[k.trim()] = v;
        })
        
        return cookie[name];
    }

    set(name, value, time) {
      var expires = "";
      if (time) {
          var date = new Date();
          date.setTime(date.getTime() + (time*24*60*60*1000));
          expires = "; expires=" + date.toUTCString();
      }
      document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }
}