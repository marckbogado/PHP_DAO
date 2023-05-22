<?php 

require_once("config.php");

/*
//CARREGA 01 USUÁRIO
$root = new Usuario();
$root->carreguePorId(3);
echo $root;
*/



/*
//CARREGA UMA LISTA DE USUÁRIOS
$lista = Usuario::getLista();
echo json_encode($lista);
*/


/*
//INSERINDO UM NOVO USUÁRIO
$aluno = new Usuario();

$aluno->setDeslogin("aluno");
$aluno->setDessenha("@lun0");

$aluno->inserir();

echo $aluno;
*/


//UPDATE DE USUÁRIO
$usuario = new Usuario();

$usuario->carreguePorId(7);

$usuario->update("professor", "8888");

echo $usuario;



?>