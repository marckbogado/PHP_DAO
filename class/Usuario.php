<?php 

//CARREGANDO OS DADOS DO BANCO PARA O OBJETO
class Usuario {

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    //GETTERS E OS SETTERS
    //ID USUARIO
    public function getIdusuario() {
        return $this->idusuario;
    }
    public function setIdusuario($value) {
        $this->idusuario = $value;
    }


    //LOGIN
    public function getDeslogin() {
        return $this->deslogin;
    }
    public function setDeslogin($value) {
        $this->deslogin = $value;
    }


    //SENHA
    public function getDessenha() {
        return $this->dessenha;
    }
    public function setDessenha($value) {
        $this->dessenha = $value;
    }


    //DT CADASTRO
    public function getDtcadastro() {
        return $this->dtcadastro;
    }
    public function setDtcadastro($value) {
        $this->dtcadastro = $value;
    }


    public function carreguePorId($id) {

        $sql = new Sql();

        $resultadoSql = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));

        if (count($resultadoSql) > 0) {

            $linha = $resultadoSql[0];

            $this->setIdusuario($linha['idusuario']);
            $this->setDeslogin($linha['deslogin']);
            $this->setDessenha($linha['dessenha']);
            $this->setDtcadastro(new DateTime($linha['dtcadastro']));
        }

    }


    //RETORNO NA TELA EM JSON
    public function __toString() {

        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }


}


?>