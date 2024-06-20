h1 {
      color: #333;
    }
    
    .profile {
      display: flex;
      margin-top: 20px;
    }
    
    .profile-image {
      flex: 1;
      text-align: center;
    }
    #image{
      width: 200px;
      height: 200px;
      border-radius: 50%;
      box-shadow: 0px 5px 3px 0px #000;
    }
    
    #image img {
      max-width: 100%;
      max-height: 100%;
      width: 100%;
      height: auto;
      border-radius: 50%;
    }
    
    /*#image{
      background-image: url('perfil.jpg');
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
    }*/
    
    .profile-info {
      flex: 2;
      margin-left: 20px;
      padding: 20px;
    }
    
    .profile-info ul li{
      list-style: circle;
    }
    
    .profile-info h2 {
      margin-top: 0;
    }
    
    .profile-info p {
      margin: 10px 0;
    }

    /*Configurações do modo mobile*/
    
    @media (max-width: 800px) {
      .profile {
        flex-direction: column;
      }
      
      .profile-image {
        margin-bottom: 20px;
      }
      div#menu-conta ul{
        width: 80vw;
        left: 4%;
      }
      
      div#menu-post ul{
        width: 80vw;
        right: 0%;
      }
      div#update-info{
        width: 96%;
        height: 720px;
        left: 2%;
        top: 0;
        border-radius: 10px;
      }
      form#form{
        margin: 45px 10px;
        padding: 10px 0;
      }
      form#form input{
        width: 100%;
        height: 40px;
        margin: 20px;
      }
      button#btn-update{
        width: 100px;
        height: 30px;
      }
      
      div#info-remove{
        width: 94%;
        height: 500px;
        top: 10%;
        left: 3%;
        border-radius: 10px;
        position: fixed;
      }
      
      div#info-remove button{
        width: 110px;
        height: 34px;
      }
      button#cancel{
        left: 10%;
      }
      button#confirm-delete{
        right: 10%;
      }

      div.full{
	      max-height: 330px;
      }
      div#dialog{
	      position: fixed;
      }
      p#msg{
	      width: 90%;
	      left: 5%;
    }
    button#btn-ok{
	    left: 38%;
    }
        
    }

    /*Fim Mobile*/
    
    /*Menu configurações*/
    #menu-user{
      display: flex;
      flex-direction: row;
    }
    #menu-user ul {
      margin: 0px;
      padding: 0px;
      text-align: justify;
    }
    
    #menu-user ul li{
      list-style: circle;
      margin: 0px 10px;
      padding: 10px;
      font-size: 12pt;
    }
    #menu-conta,#menu-post{
      position: relative;
      /*width: 200px;*/
      text-align: center;
      padding-left: 30px;
    }
    #menu-post ul, #menu-conta ul{
      width: 100%;
      display: none;
      position: absolute;
      background: #ccc;
      opacity: 1;
      color: #000;
      border-radius: 10px;
      padding: 10px;
      box-shadow: 1px 5px 10px #000;
    }
    
    #menu-conta ul{
      left: 20px;
    }
    #menu-user h3{
      border-radius: 2px;
      padding: 10px;
    }
    
    #menu-user h3:active{
      background: #ccc;
      border-radius: 10px;
    }

    /*div de actualização das informações do usuário*/
    #update-info{
      position: absolute;
      width: 65%;
      height: 500px;
      background: #ccc;
      opacity: 0.95;
      left: 30%;
      top: 8%;
    }

    #form{
      display: flex;
      flex-direction: column;
      padding: 40px;
      justify-content: center;
      align-items: center;
    }
    #form input{
      width: 90%;
      padding: 4px;
      margin: 10px;
    }
    #btn-update{
      width: 90px;
      height: 20px;
      border-radius: 8px;
      border: none;
      background: green;
      color: #fff;
      margin-top: 10px;
    }

    /*Tela de informação de remoção de conta*/
    #info-remove{
      width: 60%;
      height: 350px;
      left: 31%;
      position: absolute;
      background: #ccc;
      box-shadow: 1px 6px 10px 3px #070708BF;
      padding: 10px;
      text-align: center;
      top: 10%;
    }
    #info-remove p{
      width: 100%;
    }
    #info-remove button{
      position: absolute;
      border: none;
      top: 78%;
      width: 100px;
      height: 26px;
      border-radius: 10px;
      color: #fff;
      box-shadow: 1px 1px 0px 1px #7191a6;
    }
    #cancel{
      background: #a60000;
      left: 30%;
    }
    #confirm-delete{
      background: green;
      right: 30%;
    }

     .p-info{
	    width: 100%;
	    max-height: 200px;
	    text-align: justify;
	    overflow: hidden;
	    position: relative;
	    padding: 10px;
	    font-size: 12pt;
    }
    .p-info h3{
	    text-align: center;
    }

    .p-info:after{
	    content: "";
	    position: absolute;
	    bottom: 0;
	    left: 0;
	    width: 100%;
	    height: 50px;
	    background: linear-gradient(to buttom, transparent, black);
    }

    .full{
	    overflow-y: auto;
	    max-height: 210px;
	    padding-right: 12px;
    }

    #dialog{
	    display: flex;
	    justify-content: center;
	    align-items: center;
	    position: fixed;
	    width: 100%;
	    height: 780px;
	    background: #000;
	    top: 0%;
	    padding: 10px;
	    opacity: 0.90;
    }
    #msg{
	    position: absolute;
	    width: 50%;
	    height: 200px;
	    color: #fff;
	    background: #07112e;
	    opacity: 1;
	    top: 25%;
	    left: 35%;
	    padding: 10px;
	    box-shadow: 1px 0px 4px #ccf;
	    border-radius: 15px;
	    display: block;
	    text-align: center;
	    display: flex;
	    justify-content: center;
	    align-items: center;
    }

    #btn-ok{
	    position: absolute;
	    top: 54%;
	    left: 55%;
	    width: 100px;
	    padding: 7px;
	    border: none;
	    border-radius: 10px;
	    background: #00074f;
    }
