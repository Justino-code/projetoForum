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
          if(event.target !== conta && !menu_conta[0].contains(event.target)){
              menu_conta[1].style.display = "none";
            
          }
         if(event.target !== post && !menu_conta[2].contains(event.target)){
            menu_conta[2].style.display = 'none';
          }
        });
        
        option = document.querySelectorAll('.option');
        
        option[0].addEventListener('click',()=>{
		//remove outras telas qie tiverem activas
		const remove_user = document.querySelectorAll('#info-remove');
		if(remove_user.length > 0){
			remove_user[0].remove();
		}
		updateInfo();
	});
          
         option[2].addEventListener('click',()=>{
		 const update_user = document.querySelectorAll('#update-info');
		 if(update_user.length > 0){
			 update_user[0].remove();
		 }
		 removeUser();
	 });
      }
      
      /*Cria uma div para formulário de actualização dos dados do usuário*/
      
      function updateInfo(){
        content = document.querySelector('#content');
        
        info = document.createElement('div');
        info.setAttribute('id','update-info');
        content.appendChild(info);
        
        form = document.createElement('form');
        form.setAttribute('id','form')
        info.appendChild(form);
        
        //Cria os inputs para actualização dos dados do usuário
        entrada = {
          'nome':{
            'type':'text',
            'id':'nome',
            'name': 'nome',
            'placeholder':'Nome',
            'pattern':'[A-Za-z]{1,20}'
          },
          'sobrenome':{
            'type':'text',
            'id':'sobrenome',
            'name':'sobrenome',
            'placeholder':'Sobrenome',
            'pattern':'[A-Za-z]{1,20}'
          },
          'alcunha':{
            'type':'text',
            'id':'alcunha',
            'name':'alcunha',
            'placeholder':'Alcunha',
            'pattern':'[A-Za-z0-9]{1,20}'
          },
      'email':{
        'type':'email',
        'id':'email',
        'name':'email',
        'placeholder':'E-mail'
      },
      'Aniversario':{
        'type':'date',
        'id':'birth',
        'name':'birth',
        'placeholder':'Data de Aniversário'
      },
      'Password':{
        'type':'password',
        'id':'password',
        'name':'password',
        'placeholder':'Senha'
      }
        }
        createInput(form,entrada);
        
        btn_update = document.createElement('button');
        btn_update.setAttribute('id','btn-update');
        btn_update.innerHTML = "Actualizar";
        
        form.appendChild(btn_update);
        update(form);
        
        closed(info);
        
        ///verifica se o campo de senha sofreu alteração se sim activa o campo confirma senha
        password = document.getElementById('password');
        
        alterPassword(password,form);
        
      }
      
      //função para criar inputs 
      function createInput(form,entrada){
  
  for(var k in entrada){
    if(k == 'Aniversario'){
    lb = document.createElement('label');
    form.appendChild(lb);
    lb.innerHTML = k[0].toUpperCase()+k.substr(1);
    let id = entrada[k].id;
    lb.setAttribute('for',id);
    }
    
    input = document.createElement('input');
    form.appendChild(input);
    
    for(var att in entrada[k]){
      let val = entrada[k];
      input.setAttribute(att,val[att]);
    }
  }
}

//funções para o envio dos dados para o servidor 
function update(form){
  form.addEventListener('submit',(e)=>{
    e.preventDefault();
    const formData = new FormData(form);
    data = {};
    
    for(const [key,value] of formData.entries()){
      if(value !== "" && value !== null){
        data[key] = value;
      }
    }
    
    if(Object.keys(data).length !== 0){
	    data = JSON.stringify(data);
      sendUpdate('operation/update',data);
    }
  });
}

function sendUpdate(url,data=null){
  const xhttp = new XMLHttpRequest();
  
  xhttp.onreadystatechange =()=>{
    if(xhttp.readyState == 4 && xhttp.status == 200){
	    let response = xhttp.responseText;

	    if(url == 'operation/remove'){
		    response = JSON.parse(response);
		    const message = response['message'];
		    const status = response['status'];
		    dialogView(message,status);
      }
	    if(url == 'operation/update'){
		    response = JSON.parse(response);
		    const message = response['message'];
		    dialogView(message);
	    }
	    if(url == 'operation/notify'){
		    window.location.reload();
	    }
	    removeLoading();
    }else{
	    loading();
    }
  };
  
  xhttp.open('POST',url,true);
  xhttp.send(data);
}

function alterPassword(password,form){
  password.addEventListener('keyup',()=>{
    conf = document.querySelectorAll('#confirm');
    
    if(password.value.length === 8 && conf.length === 0){
      confirm = document.createElement('input');
      confirm.setAttribute('type','password');
      confirm.setAttribute('id','confirm');
      confirm.setAttribute('name','confirm');
      confirm.setAttribute('placeholder','Confirmar Senha');
      confirm.setAttribute('required',true);
      
      form.insertBefore(confirm,form.childNodes[7]);
    }
  });
}

//cria um botão para fechar 
        function closed(parent){
            fechar = document.createElement('div');
            fechar.setAttribute('id','fechar');
            
            f_div1 = document.createElement('div');
            f_div1.setAttribute('class','fechar1');
            f_div2 = document.createElement('div');
            f_div2.setAttribute('class','fechar2');
            
            parent.appendChild(fechar);
            fechar.appendChild(f_div1);
            fechar.appendChild(f_div2);
            
            fechar.addEventListener('click',()=>{
              parent.style.display = "none";
            });
        }
        
        function removeUser(){
          const info = document.createElement('div');
          info.setAttribute('id','info-remove');
          const content = document.querySelector('#content');
		content.appendChild(info);
          
          const p_info = document.createElement('div');
		p_info.setAttribute('class','p-info');
		getNotice(p_info);

		const btn_read = document.createElement('span');
		btn_read.innerHTML = 'Ler Mais';
		info.appendChild(p_info);
		info.appendChild(btn_read);

		btn_read.addEventListener('click',()=>{
			if(p_info.classList.contains('full')){
				p_info.classList.remove('full');
				btn_read.textContent = 'Ler Mais';
			}else{
				p_info.classList.add('full');
				btn_read.textContent = 'Mostrar Menos';
			}
		});
          
          //Cria um botão para confirmar a remoção da conta
          btn_confirm = document.createElement('button');
          btn_confirm.setAttribute('id','confirm-delete');
          btn_confirm.innerHTML = 'Confirmar';
          
          //Cria um botão para cancelar a remoção da conta
          btn_cancel = document.createElement('button');
          btn_cancel.setAttribute('id','cancel');
          btn_cancel.innerHTML = 'Cancelar';
          
          info.appendChild(btn_cancel);
          info.appendChild(btn_confirm);
          
          //Adicionar uma ação de cancelar a remoção da conta
          btn_cancel.addEventListener('click',()=>{
            info.remove();
          });
          
          btn_confirm.addEventListener('click',()=>{
            sendUpdate('operation/remove');
            //alert('Fui confirmado');
          });
          
        }

function dialogView(message,status=null){
	const dialog = document.createElement('div');
	const msg = document.createElement('p');
                    const btn_ok = document.createElement('button');

	btn_ok.setAttribute('id','btn-ok');

	msg.setAttribute('id','msg');
	msg.textContent = message;
	dialog.setAttribute('id','dialog');

	btn_ok.textContent = 'Ok';
	dialog.appendChild(msg);
	dialog.appendChild(btn_ok);
	const content = document.querySelector('body');

	content.appendChild(dialog);

	btn_ok.addEventListener('click',()=>{
		dialog.remove();
		if(status === true){
			window.location.replace("/APLP/");
		}
	});
}

   function getNotice(p){
          xhttp = new XMLHttpRequest();

          xhttp.onreadystatechange =()=>{
            if(xhttp.readyState == 4 && xhttp.status == 200){
		    removeLoading();
		    const notice = JSON.parse(xhttp.responseText);
		    p.innerHTML = notice['message'];
    }else{
	    loading();
    }
  };

  xhttp.open('POST','operation/notice',true);
  xhttp.send();
        }

function notifyActive(){
	const active = document.getElementById('btn-active');

	active.addEventListener('click',()=>{
		const data = {status:active.value};

		sendUpdate('operation/notify',JSON.stringify(data));
	});
}

notifyActive();
      
      displayMenu();
