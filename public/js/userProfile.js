   //User Profile
      function displayMenu(){
        const conta = document.getElementById('conta-d');
        const post = document.getElementById('post-d');
        
        const menu_conta = document.querySelectorAll('ul');
        
        conta.addEventListener('click',()=>{
          menu_conta[1].style.display = 'block';
          menu_conta[2].style.display = "none";
        });
        
        post.addEventListener('click',()=>{
          menu_conta[2].style.display = 'block';
          menu_conta[1].style.display = "none";
        });

        document.addEventListener('click',(event)=>{
          if(event.target !== conta && !menu_conta[1].contains(event.target)){
              menu_conta[1].style.display = "none";
            
          }
         if(event.target !== post && !menu_conta[2].contains(event.target)){
            menu_conta[2].style.display = 'none';
          }
        });
      }

displayMenu();
