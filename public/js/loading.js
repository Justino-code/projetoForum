function loading(e){
	loadingVerify = document.querySelectorAll('#loading');
	if(loadingVerify.length <= 0){
		const content = document.querySelector('body');
		//Cria uma div para a animação de loading
		const load = document.createElement('div');
		load.setAttribute('id','loading');
		//Cria um span para fazer a animação de loading
		const loadingContent = document.createElement('span');
		loadingContent.setAttribute('class','loading');
		load.appendChild(loadingContent);
		content.appendChild(load);
	}

	setTimeout(removeLoading,9000);
}

function removeLoading(){
	loadingContent = document.querySelectorAll('#loading');
	if(loadingContent.length > 0){
		document.getElementById('loading').remove();
	}
}

document.addEventListener('DOMContentLoaded',()=>{
    loading();
  });
  
  window.addEventListener('load',()=>{
    setTimeout(()=>{
	    removeLoading();
    },0);
  });

setTimeout(removeLoading,9000);
