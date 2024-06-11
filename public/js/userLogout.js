function logout(){
            let out = document.getElementById('logout');
            
            out.addEventListener('click',()=>{
              sendData('login/logout');
            });
          }
          
          function sendData(url){
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = ()=>{
            if(xhttp.readyState == 4 && xhttp.status == 200){
		    window.location.reload();
            }
          };
          
          xhttp.open('POST',url);
          xhttp.setRequestHeader('Content-type',"application/json");
          xhttp.send();
        }
        
          
          logout();
