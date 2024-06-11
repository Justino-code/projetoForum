 function getPost(){
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = ()=>{
            if(xhttp.readyState == 4 && xhttp.status == 200){
		    res = JSON.parse(xhttp.responseText);
		    if(typeof(res) !== 'object'){
			    response = JSON.parse(res);
			    create_post(response);
		    }else{
			    let erro = document.createElement('p');
			    ele = document.getElementById('posts');
			    ele.appendChild(erro);
			    erro.innerHTML = res['message'];
			    erro.style.color = 'red';
		}
        }
          };
          
          xhttp.open('POST','post/getPost');
          xhttp.setRequestHeader('Content-type',"application/json");

          xhttp.send();
        }

function create_post(posts){
          post_section = document.querySelector('#posts');

          //cria um container para um post
          for(const key in posts){
            post_container = document.createElement('div');
            post_container.setAttribute('class','post-container');
            post_section.appendChild(post_container);

          //cria um artigo de um post
          post = document.createElement('article');
          post.setAttribute('class','post');
          post_container.appendChild(post);

          //cria um título para o artigo
          title = document.createElement('h2');
          post.appendChild(title);
          title.innerHTML = posts[key]['title'];

          //cria as meta do post
          post_meta = document.createElement('div');
          post_meta.setAttribute('class','post-meta');
          post.appendChild(post_meta);
          //autor
          autor = document.createElement('span');
          autor.innerHTML = 'Autor: '+ posts[key]['nome'];
          post_meta.appendChild(autor);
          //data
          data = document.createElement('span');
		  d = new Date(posts[key]['create_date']);
          data.innerHTML = ' | Data: '+d.toLocaleDateString();
	post_meta.appendChild(data);
          //conteúdo
          content = document.createElement('p');
          content.innerHTML = posts[key]['content'];
          post.appendChild(content);

          //Respostas
          }
        }

getPost();
