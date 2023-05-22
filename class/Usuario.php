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

//////////////////////////////////////////////////////////////////
    public function setDados($dados){

        $this->setIdusuario($dados['idusuario']);
        $this->setDeslogin($dados['deslogin']);
        $this->setDessenha($dados['dessenha']);
        $this->setDtcadastro(new DateTime($dados['dtcadastro']));
    }
//////////////////////////////////////////////////////////////////

    //METODO PARA TRAZER UMA LISTA COM TODOS OS USUARIOS DA TABELA
    public static function getLista(){

        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
        
    }


    //METODO DE INSERT DE UM NOVO USUÁRIO, TRAZENDO O ID DO USUÁRIO
    public function inserir(){

        $sql = new Sql();
        $resultado = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ":LOGIN"=>$this->getDeslogin(),
            ":PASSWORD"=>$this->getDessenha()
        ));

        if (count($resultado) > 0) {
            $this->setDados($resultado[0]);
        }
    }



    //METODO UPDATE
    public function update($login, $password){
        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();

        $sql->query1("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(

            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha(),
            ':ID'=>$this->getIdusuario()
        ));
    }



    //DELETANDO DADOS DO BANCO
    public function delete(){

        $sql = new Sql();

        $sql->query1("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(

            ':ID'=>$this->getIdusuario()
        ));

        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());
    }



    //RETORNO NA TELA EM JSON DE 01 USUARIO
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