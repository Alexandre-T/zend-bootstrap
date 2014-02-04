<?php

namespace Bootstrap;

use Bootstrap\Exception\InvalidParameterException;
use Bootstrap\Exception\InvalidParameterTypeException;
/**
 * Util
 * @package zend-bootstrap
 * @copyright Alexandre-T (c) - http://www.at-it.fr
 * This file is inspired by GenUtil.php
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license Apache License v2 https://github.com/Alexandre-T/zend-bootstrap/blob/master/LICENSE	
 * @link https://github.com/Alexandre-T/zend-bootstrap
 * @link http://www.at-it.fr
 * @author alexandre
 *        
 */
class Util {
	/**
	 * If missing in the text, adds the space separated words to the text and returns the text
	 * Words are compared in case insensitive manner
	 * @param string|array $words A single word, space separated words or an array of words
	 * @param string $text
	 * @throws Exception\InvalidParameterTypeException
	 * @return string
	 */
	public static function addWords($words, $text)
	{
		$text   = (string)$text;
		if (is_null($words)) {
			$words  = '';
		}
		if (is_string($words)) {
			$words  = self::getWordsArray($words);
		}
		if (!is_array($words)) {
			throw new InvalidParameterTypeException(sprintf("%s expects either a string or an array as the 'spec' parameter.", __METHOD__));
		}
		$currentWords       = self::getWordsArray($text);
		$currentWordsLower  = self::getWordsArray(strtolower($text));
		foreach ($words as $word) {
			$wordLower  = strtolower($word);
			if (!in_array($wordLower, $currentWordsLower)) {
				$currentWords[]         = $word;
				$currentWordsLower[]    = $wordLower;
			}
		}
		$text   = implode(' ', $currentWords);
		return $text;
	}

	/**
	 * If present in the text, removes the words from the text and returns the text
	 * Words are compared in case insensitive manner
	 * @param string|array $words A single word, space separated words or an array of words
	 * @param string $text
	 * @throws Exception\InvalidParameterTypeException
	 * @return string
	 */
	public static function removeWords($words, $text)
	{
		$text   = (string)$text;
		if (is_null($words)) {
			return $text;
		}
		if (is_string($words)) {
			$words  = self::getWordsArray($words);
		}
		if (!is_array($words)) {
			throw new InvalidParameterTypeException(sprintf("%s expects either a string or an array as the 'spec' parameter.", __METHOD__));
		}
		$currentWords       = self::getWordsArray($text);
		$currentWordsLower  = self::getWordsArray(strtolower($text));
		foreach ($words as $word) {
			$wordLower  = strtolower($word);
			$key = array_search($wordLower, $currentWordsLower);
			if ($key !== FALSE) {
				unset($currentWords[$key]);
			}
		}
		$text   = implode(' ', $currentWords);
		return $text;
	}
	
	/**
	 * Adds space separated words to an array item, if the words are missing there
	 * If the array item does not exist, creates it
	 * Returns the resulting array
	 * @param string|array $words A single word, space separated words or an array of words
	 * @param array $ay
	 * @param string $key
	 * @return array
	 */
	public static function addWordsToArrayItem($words, array $ay, $key)
	{
		if (!array_key_exists($key, $ay)) {
			$ay[$key]   = '';
		}
		$text       = $ay[$key];
		$text       = self::addWords($words, $text);
		$ay[$key]   = $text;
		return $ay;
	}
	
	/**
	 * Breaks the submitted $words into individual words, escapes them with the escaper and returns space separated words
	 * The spaces between words are NOT escaped
	 * @param string $words
	 * @param callable $escaper
	 * @return string
	 * @throws Exception\InvalidParameterException
	 */
	public static function escapeWords($words, $escaper)
	{
		if (!is_callable($escaper)) {
			throw new InvalidParameterException(sprintf('%s: The escaper must be a callable.', __METHOD__));
		}
		$wordsAy    = self::getWordsArray($words);
		foreach ($wordsAy as $key => $word) {
			$wordsAy[$key]  = $escaper($word);
		}
		$words  = implode(' ', $wordsAy);
		return $words;
	}
	
	/**
	 * Breaks the $words string into individual words and returns them in an array
	 * @param string $words
	 * @return array
	 */
	public static function getWordsArray($words)
	{
		$words      = self::singleSpace($words);
		if (empty($words)) {
			$wordsAy    = array();
		} else {
			$wordsAy    = explode(' ', $words);
		}
		//remove duplicates value and sort
		$wordsAy = self::_arrayIUnique($wordsAy);
		
		return $wordsAy;
	}
	
	/**
	 * Trims the parameter, replaces all whitespace characters with a single space and returns the resulting string
	 * @param string $words
	 * @return string
	 * @throws Exception\InvalidParameterTypeException
	 */
	public static function singleSpace($words)
	{
		if (is_null($words)) {
			$words  = '';
		}
		if (!is_string($words)) {
			throw new InvalidParameterTypeException(sprintf('%s: Words parameter must be a string.', __METHOD__));
		}
		$words   = trim($words);
		$words   = preg_replace('/\s+/', ' ', $words);
		return $words;
	}
	/**
	 * Add Some class to an array of attributes
	 * 
	 * @param array $attributes
	 * @param string $class
	 * @return array
	 */
	public static function addClassToArray($attributes = array(),$class){
	    if (!is_array($attributes)){
	        $attributes = array();
	    }
	    
	    $result = $attributes;
	    
	    if (array_key_exists('class', $attributes)) {
	    	$result['class'] = Util::addWords($class, $attributes['class']);
	    } else {
	    	$result['class'] = $class;
	    }
	    return $result;
	}
	
	private static function _arrayIUnique($array) {
		return array_intersect_key(
				$array,
				array_unique(array_map('strtolower',$array))
		);
	}
	
}

?>