<?php
namespace Src\Interfaces;

interface UserInter{
	public function login($email,$pass):bool;
	public function register($user):bool;
	public function updatePerfil($user)bool;
}
