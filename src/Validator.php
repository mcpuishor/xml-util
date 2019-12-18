<?php
namespace App\XmlUtilities;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Validator {

	static public function string($content)
	{
		$content = trim($content);
		if (empty($content)) {
			return false;
		}
		if(stripos($content, '<!DOCTYPE html>') !== false) {
			return false;
		}
		libxml_use_internal_errors(true);
		simplexml_load_string($content);
		$errors = libxml_get_errors();
		libxml_clear_errors();
		return empty($errors);
	}

	static public function file($xmlfile) 
	{
		$file = Storage::disk('local')
    				->get($xmlfile);
    	return self::string($file);
	}
}