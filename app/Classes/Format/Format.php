<?php

	namespace App\Classes\Format;

	use App\Models\data_paladin;

	class Format{

		private $paladin;
		public function __construct(){
			$this->paladin = data_paladin::where('active', 1)->first();
		}

		public function paladin(){
			return $this->paladin;
		}

		public function substr($text, $limit = 10){
			if(strlen($text) > $limit)
				return substr($text, 0, $limit) . '...';
			else
				return $text;
		}

	}
