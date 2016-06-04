<?php
class Doc
{
	protected $customDocType;
	protected $headers = array();
	protected $Element = array();
	
	public function __construct ()
	{
		//$this->initHtml();
	}
	public function setCustomDocType ($customDocType)
	{
		//put custom  document type
		$this->customDocType = $customDocType;
	}
	public function setHeaders ($element)
	{
		//put element in header section
		$this->headers [] = $element;
	}
	
	public function createElement ($tag, $attrs = null, $innerHTML=null, $print = false)
	{
		//$HtmlElement = new HtmlElement(null, null);
		$element = "<" . $tag . " ";
		//if ($attrs == null)
		//$attrs = $HtmlElement->getAttribute(null, true);
		//$innerHTML = $HtmlElement->innerHTML();
		$attr = array_keys($attrs);
		$values = array_values($attrs);
		for ($i = 0; $i < count ($attr); $i++)
		{
			$element .= $attr[$i] . "=\"" . $values[$i] . "\"";
			$element .= " ";
		}
		if ($innerHTML !== null)
		{
			$element .= ">";
			$element .= $innerHTML;
			$element .= "</" . $tag . ">";
		}
		else
		{
			$element .= " />";
		}
		//if ($attrs !== null)
			//{
		if ($print !== false)
		return $element;
		else $this->Element [] = $element;
		//} else
			//{
		//		return $HtmlElement;
		//	}
	}
	public function initHtml ()
	{
		$page = "";
		if ($this->customDocType !== null)
		{
			$page .= $this->customDocType;
		}
		else
		{
			$page .= "<DOCTYPE HTML>";
		}
		$page .= "<head>";
		$page .= implode("", $this->headers);
		$page .= "</head>";
		$page .= "<body" . $this->bodyEvent . ">";
		$page .= implode("", $this->Element);
		$page .= "</body></html>";
		return $page;
	}
	
}
class HtmlElement
{
	protected $html = "";
	protected $attrs = array();
	
	public function __construct($html, $attrs)
	{
		if ($html !== null)
			$this->html = $html;
		if ($attrs !== null)
			$this->attrs = $attrs;
	}
	public function __call ($func, $args)
	{
		switch (strtolower($func))
		{
			case "appenchild" :
				return true;
			break;
			case "innerhtml" :
				if ($args[0] == "")
					return $this->html;
				else
					$this->html = $args[0];
			break;
			case "setattribute" :
				$this->attrs[$args[0]] = $args[1];
			break;
			case "getattribute" :
				if ($args[1])
					return $this->attrs;
				else
					return $this->attrs[$args[0]];
			break;
		}
	}
}
