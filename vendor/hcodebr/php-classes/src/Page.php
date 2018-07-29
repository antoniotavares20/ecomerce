<?php

namespace Hcode;
	
use Rain\Tpl;

class Page{
	private $tpl;
	private $defauts = [];
	private $options = [
		"data" =>[]
	];

	public function __construct($opts = array()){
		//faz o merge entre duas variaveis e guarda em options
		$this->options = array_marge($this->defauts, $opts);

		$coding = array(
						"tpl_dir"   =>$_SERVER["DOCUMENT_ROOT"]."/views/",
						"cache_dir" =>$_SERVER["DOCUMENT_ROOT"]."/views-cache/",
						"debug"		=> false
	);

		Tpl::configure($coding);
		
		$this->tpl = new tpl;	
		$this->setData($this->options["data"]);

		$this->draw("header");

	}
	private function setData($data = array()){
		foreach ($data as $key => $value) {
			$this->tpl-assign($key, $value);
		}
	}


	public function setTpl($name, $data = array(), $returnHTLM = false){
		$this->setData($data);
		$this->tpl->draw($name, $returnHTLM);
	return $this->tpl->draw($name, $returnHTLM);
	}

	public function __destruct(){
		$this->tpl->draw("footer");
	}
}
?>