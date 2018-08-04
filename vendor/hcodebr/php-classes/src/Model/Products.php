<?php 
namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;


class Products extends Model {
	public static function listAll()
	{
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_produtcts ORDER BY desproducts");
	}

public function save(){
	$sql = new Sql();
	$results = $sql->select("CALL sp_products_save(:idproduct, :desproducts, :vlprice, :vleight, :vlwidth, :vlheight, :vllength, :vlweight :desurl)", array(
		":idproduct"=>$this->getidproduct(),
	    ":desproduct"=>$this->getdesproduct()
	    ":vlprice"=>$this->getvlprice()
	    ":vlwidth"=>$this->getvlwidth()
	    ":vleight"=>$this->getvleight()
	    ":vllenght"=>$this->getvllenght()
	    ":vlweight"=>$this->getvlweight()
	    ":desurl"=>$this->getdesurl()


	));
	$this->setData($results[0]);
}

public function get($idproduct){
	$sql = new Sql();
	$results = $sql->select("SELECT * FROM tb_produtcts WHERE idproduct = :idproduct",[
								":idproduct"=>$idproduct	]);
	$this->setData($results[0]);
}

public function delete(){
	$sql = new Sql();
	$sql->query("DELETE FROM tb_produtcts WHERE idproduct = :idproduct",[
							':idproduct'=>$this->getidproduct()
						]);
	}
}

 ?>