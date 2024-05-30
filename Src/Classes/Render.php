<?php
namespace Src\Classes;

use Src\Interfaces\InterView;

class Render implements InterView{
	private $dir;
	private $title;
	private $description;
	private $keywords;

	public function renderView(){
		require_once(DIRREQ."/App/Views/View.php");
	}

	public function renderHead(){
		$head = DIRREQ."/App/Views/
{$this->getDir()}/head.php";
		if(file_exists($head)){
			include_once($head);
		}
	}

	public function renderHeader(){
		$header = DIRREQ."/App/Views/{$this->getDir()}/header.php";

		if(file_exists($header)){
			include_once($header);
		}
	}

	public function renderMain(){
		$main = DIRREQ."/App/Views/{$this->getDir()}/main.php";

		if(file_exists($main)){
			include_once($main);
		}
	}

	public function renderAside(){
		$aside = DIRREQ."/App/Views/{$this->getDir()}/aside.php";

		if(file_exists($aside)){
			include($aside);
		}
	}

	public function renderFooter(){
		$footer = DIRREQ."/App/Views/{$this->getDir()}/footer.php";

		if(file_exists($footer)){
			include_once($footer);
		}
	}


	public function setDir($dir){
		$this->dir = $dir;
	}
	public function getDir(){
		return $this->dir;
	}

	public function setTitle($title){
                $this->title = $title;
        }
        public function getTitle(){
                return $this->title;
	}

	public function setDescription($desc){
                $this->description = $desc;
        }
        public function getDescription():string{
                return $this->description;
	}

	public function setKeywords($key){
                $this->keywords = $key;
        }
        public function getKeywords(){
                return $this->keywords;
        }
}
