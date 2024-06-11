let count_change = 0;
let count_change_con = 0;
let verify = false;
let verify_conf = false;
             
//função para adicionar a tela de login 
        function add_login(id_login,id_content){
          login = document.getElementById(id_login);
          
          login.addEventListener('click',()=>{
              //remove a tela de registro se existir
              if(document.getElementById('div-form-register')){
                rg = document.getElementById('div-form-register');
                rg.remove();
              }
            
            content = document.getElementById(id_content);
            div_form = document.createElement('div');
            content.appendChild(div_form);
            div_form.setAttribute('id','div-form-login');
          
            //formulário de login 
            form = document.createElement('form');
            form.setAttribute('id','form-login');
            //form.setAttribute('name','login')
            div_form.appendChild(form)
            
            //campo de entrada do nome do usuário (email)
            input_user = document.createElement('input');
            input_user.setAttribute('type','email');
            input_user.setAttribute('required',true);
            input_user.setAttribute('placeholder','Email');
            input_user.setAttribute('name','email');
            input_user.setAttribute('id','email');
            form.appendChild(input_user);
            
            //campo de senha do usuário 
            input_senha = document.createElement('input');
            input_senha.setAttribute('type','password');
            input_senha.setAttribute('required',true);
            input_senha.setAttribute('placeholder','Senha');
            input_senha.setAttribute('name','password');
            input_senha.setAttribute('id','senha');
            
            form.appendChild(input_senha);
            
            //Botão de login
            btn_login = document.createElement('button');
            btn_login.setAttribute('id','btn-login');
            btn_login.innerHTML = 'Entrar';
            
            form.appendChild(btn_login);
            
            //div registro 
            registro = document.createElement('a');
            registro.setAttribute('id','register')
            registro.innerHTML = "Não tem uma conta?";
            form.appendChild(registro);

		  //span de erro;
		  erro = document.createElement('p');
		  erro.setAttribute('id','erro');
		  form.appendChild(erro);
            
            //botão fechar 
            closed(div_form);
        
            close_wind('fechar','div-form-login');
            
            no_auto_send(document.querySelector('form'),'login/login','#erro');
            
            add_register('register','content');
            
            verifyForm(document.querySelectorAll('input'));
          });
        }
        
        //função para fechar a tela de login 
        function close_wind(id_btn,id_div){
          fechar = document.getElementById(id_btn);
          
          fechar.addEventListener('click',()=>{
            login = document.getElementById(id_div);
            
            login.remove()
          });
        }
        
        add_login('login','content');
        
        //função para adicionar o formulário de registro
        function add_register(id_btn,id_content){
          //Botão de ação
          register = document.getElementById(id_btn);
          
          //Elemento pai
          content = document.getElementById(id_content)
          
          register.addEventListener('click',()=>{
              //remove a tela de login se existir
              if(document.getElementById('div-form-login')){
                login = document.getElementById('div-form-login');
                login.remove();
              }
            
            div_form = document.createElement('div');
            div_form.setAttribute('id','div-form-register');
            content.appendChild(div_form);
            
            //formulário 
            form = document.createElement('form');
            form.setAttribute('id','form-register');
            //form.setAttribute('method','post');
            
            div_form.appendChild(form);
            //inputs do formulário 
            createInput(form)
            
            //Botão de registro 
            btn_register = document.createElement('button');
            btn_register.setAttribute('id','btn-register');
            btn_register.innerHTML = 'Registar';
            form.appendChild(btn_register);
            
            //div login
            registro = document.createElement('a');
            registro.setAttribute('id','login-f')
            registro.innerHTML = "Ja tem uma conta?";
            form.appendChild(registro);

		  //mensagem de erro
		  erro = document.createElement('p');
		  erro.setAttribute('id','erro');
		  form.appendChild(erro);
            
            //botão fechar
            closed(form);
            //ação de fechar 
            close_wind('fechar','div-form-register');
            
            no_auto_send(document.querySelector('form'),'login/register','#erro');
            
            add_login('login-f','content');
            
            verifyForm(document.querySelectorAll('input'))
          });
        }
        
  
  function createInput(form){
  
  entrada = {
    'nome':{
      'type':'text',
      'id':'nome',
      'name': 'nome',
      'placeholder':'Nome',
      'required':true,
      'pattern':'[A-Za-z]{1,20}'
    },
    'sobrenome':{
      'type':'text',
      'id':'sobrenome',
      'name':'sobrenome',
      'placeholder':'Sobrenome',
      'required':true,
      'pattern':'[A-Za-z]{1,20}'
      },
      'email':{
        'type':'email',
        'id':'email',
        'name':'email',
        'placeholder':'E-mail',
        'required':true
      },
      'pass':{
        'type':'password',
        'id':'password',
        'name':'password',
        'required':true,
        'placeholder':'Senha'
      },
       'Confirm_pass':{
        'type':'password',
        'id':'confirm',
        'name':'confirm',
        'required':true,
        'placeholder':'Confirmar Senha'
      }
  }
  
  for(var k in entrada){
    lb = document.createElement('label');
    form.appendChild(lb);
    lb.innerHTML = k[0].toUpperCase()+k.substr(1);
    let id = entrada[k].id;
    lb.setAttribute('for',id);
    
    input = document.createElement('input');
    form.appendChild(input);
    
    for(var att in entrada[k]){
      let val = entrada[k];
      input.setAttribute(att,val[att]);
    }
  }
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
        }
        
        function no_auto_send(form,url,err){
		form.addEventListener('submit',(event)=>{
			event.preventDefault();

			if(url == 'login/register'){
				verify = verifyPass();
				if(verify){
					sendData(url,form,err);
				}
			}else{
				sendData(url,form,err);
			}
          });
          
          form.addEventListener('keyup',()=>{
            verifyForm(document.querySelectorAll('input'));
		  if(url == 'login/register'){
			  verifyPass();
			  console.log('estou aqui');
		  }
          });
        }
        
        function sendData(url,form,err){
          formData = new FormData(form);
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = ()=>{
            if(xhttp.readyState == 4 && xhttp.status == 200){
             // document.getElementById('content').innerHTML = xhttp.responseText;
		    res = JSON.parse(xhttp.responseText);
		    if(res["message"] == true){
			    window.location.reload();
			    if(url == 'login/register'){
			    }else{
				    window.location.reload();
			    }
		    }else{
			    msg = document.querySelector(err);
			    msg.innerHTML = res['message'];
		    }
            }
          };
          
          let data = {};
          for(const [key,value] of formData.entries()){
            data[key] = value;
          }
		json = JSON.stringify(data);

		xhttp.open('POST',url,true);
		xhttp.setRequestHeader('Content-type',"application/json");

          xhttp.send(json);
        }
        
        function verifyForm(input){
          let valido = 0;
          for(let i = 0; i < input.length; i++){
            if(input[i].getAttribute('required')){
              input[i].setAttribute('class','valido')
              if(input[i].validity.valueMissing){
                nome = input[i].getAttribute('id');
                input[i].setCustomValidity(`Campo ${nome} não pode estar vazio`);
                valido +=1;
                
              }else{
                input[i].setCustomValidity('');
              }
            }
          }
          if(valido == 0){
            return true;
          }else{
            return false;
          }
        }


function verifyPass(){
        const pass = document.getElementById('password');
        const confirm = document.getElementById('confirm');

        const status = document.getElementById('erro');

	pass.setAttribute('class','validata');
	confirm.setAttribute('class','validata');
	const valid = document.querySelectorAll('.validata');

        password = pass.value;
        confirm_pass = confirm.value;

        pass.addEventListener('change',()=>{
		verify = pass_verify(password,valid,status);
		count_change +=1;

		if(!verify){
			pass.focus();
		}
	});

        if(count_change > 0){
          pass.addEventListener('keyup',()=>{
            verify = pass_verify(password,valid,status);
          });
        }

        confirm.addEventListener('change',()=>{
          if(verify){
            verify_conf = confirm_verify(password,confirm_pass,valid,status);
            if(!verify_conf){
              confirm.focus();
            }
          }
		count_change_con +=1;
        });

        if(count_change_con > 0){
          confirm.addEventListener('keyup',()=>{
            verify_conf = confirm_verify(password,confirm_pass,valid,status);
          });
        }

        if(verify_conf && verify){
          return true;
        }else{
          return false;
        }
      }	

      function pass_verify(password,valid,status){
        if(password.length >= 8){
          valid[0].classList.replace('invalid','valid');

          status.innerHTML = "";
          return true;
        }else{
           valid[0].classList.remove('valid');
          valid[0].classList.add('invalid');

           status.innerHTML = "Palavra passe tem que ter no mínimo 8 caracteres";
          return false;
        }
      }

      function confirm_verify(password1,password2,valid,status){
        if(password1 === password2){
          valid[1].classList.replace('invalid','valid');
          status.innerHTML = "";
          return true;
        }else{
            valid[1].classList.remove('valid');
          valid[1].classList.add('invalid');

          status.innerHTML = "Palavra passe não são iguais";
          return false;
        }
      }
