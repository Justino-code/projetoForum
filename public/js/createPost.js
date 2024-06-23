function postP(){
	content = document.querySelector('.post-section');

	post_create_area = document.createElement('div');

	post_create_area.setAttribute('id','post-create-area');

	content.insertBefore(post_create_area,content.childNodes[1]);
            
	//cria um formulário de postagem 
	form = document.createElement('form');
	form.setAttribute('id','form-post');
	post_create_area.appendChild(form);

	//cria um input de título 
	input_title = document.createElement('input');
	input_title.setAttribute('type','text');
	input_title.setAttribute('name','title');
	input_title.setAttribute('required',true);
	input_title.setAttribute('placeholder','Título');

	form.appendChild(input_title);

	//cria uma textarea para o conteúdo do post
	post_content = document.createElement('textarea');
	post_content.setAttribute('name','content');
	post_content.setAttribute('required',true);

	post_content.setAttribute('placeholder','Conteúdo do post');

	form.appendChild(post_content);

	//cria uma lista de categoria 
	cat = document.createElement('select');
        cat.setAttribute('id','category');
	//cat.setAttribute('required',true);
        opt = document.createElement('option');
        opt.setAttribute('value',"");
        opt.innerHTML = "Selecione uma Categoria";
        cat.appendChild(opt);
        form.appendChild(cat);
            
        //cria um botão de ação postar
        post_btn = document.createElement('button');
         post_btn.setAttribute('id','post-btn');
         post_btn.innerHTML = 'Publicar';

	form.appendChild(post_btn);
	form.addEventListener('submit',(event)=>{
		event.preventDefault();
		sendData('post/savePost',form);
            });
            
          }
          

function sendData(url,form){
          formData = new FormData(form);
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = ()=>{
            if(xhttp.readyState == 4 && xhttp.status == 200){
		    removeLoading();
		    alert(xhttp.responseText);
            }else{
		    loading();
            }
          };

          let data = {};
          for(const [key,value] of formData.entries()){
            data[key] = (value);
          }


          json = JSON.stringify(data);

          xhttp.open('POST',url);
          xhttp.setRequestHeader('Content-type',"application/json")
          xhttp.send(json);
        }

function getCate(){
	xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = ()=>{
		if(xhttp.readyState == 4 && xhttp.status == 200){
			const response = JSON.parse(xhttp.responseText);

			console.log(response);
			const cat = document.getElementById('category');
			if(response['status'] == true){
				for(const item in response['message']){
					console.log(item);
					var opt = document.createElement('option');
                                        opt.setAttribute('value',response['message']['id_cat']);
					opt.textContent = response['message']['nome'];
					cat.appendChild(opt);
				}
			}
		}
	};

	xhttp.open('POST','post/getCat');
	xhttp.setRequestHeader('Content-type',"application/json");

	xhttp.send();
}


postP();

//getCate();
