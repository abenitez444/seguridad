<?php

namespace App\MyClass;

class BlogFunctions
{
	public function normaliza ($cadena){
	    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
	    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
	    $cadena = utf8_decode($cadena);
	    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
	    // $cadena = strtolower($cadena);
	    return utf8_encode($cadena);
	}

	public function deleteCaractersNotValid($string)
	{
		$c_notValid = '|-!-@-"-#-*-.-~-$-½-%-¬-&-{-/-[-(-]-)-}-=-?-¡-+-:-_-,-;';
		$c_valid = '-';
		$array_notValid = explode('-', $c_notValid);
		$str = $string;
		foreach ($array_notValid as $key => $value) {
			$str = str_replace($value, $c_valid, $str);
		}
		return $str;
	}

    public function makeSlug($name)
    {
    	$slug = $this->deleteCaractersNotValid(trim(strtolower($this->normaliza($name))));
    	$slug = str_replace(' ', '-', $slug);
    	return $slug;
    }
}
