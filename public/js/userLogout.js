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
            }else{
              console.log('Erro não foi possível estabelecer ligação ');
            }
          };
          
          xhttp.open('POST',url);
          xhttp.setRequestHeader('Content-type',"application/json");
          xhttp.send();
        }
        
          
          logout();
