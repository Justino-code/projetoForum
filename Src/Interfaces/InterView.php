<?php
namespace Src\Interfaces;

interface InterView{
	public function setDir($dir);
	public function setTitle($title);
	public function setDescription($desc);
	public function setKeywords($key);
	
	public function renderView();
}
