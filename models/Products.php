<?php
	
	class Products{		
		private $id;
		private $name;
		private $produser;
		private $measure;
		private $price;
		
		public function getId() 		{return $this->id;		}
		public function getName() 		{return $this->name;	}
		public function getProduser() 	{return $this->produser;}
		public function getMeasure() 	{return $this->measure;	}
		public function getPrice() 		{return $this->price;	}

		public function setId($arg) 		{return $this->id = $arg;		}
		public function setName($arg) 		{return $this->name = $arg;		}
		public function setProduser($arg) 	{return $this->produser = $arg;	}
		public function setMeasure($arg) 	{return $this->measure = $arg;	}
		public function setPrice($arg) 		{return $this->price = $arg;	}
	}

?>