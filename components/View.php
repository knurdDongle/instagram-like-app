<?php

class View
{
	private $data = array();
	private $render = FALSE;

	public function __construct($view_path)
	{
		try {
			$file = ROOT_PATH . '/views/' . $view_path . '.php';

			if (file_exists($file)) {
				$this->render = $file;
			}
			else {
				throw new customException('Template ' . $view_path . ' not found!');
			}
		}
		catch (customException $e) {
	        echo $e->errorMessage();
	    }
	}

	public function assign($variable, $value)
	{
	    $this->data[$variable] = $value;
	}

	public function __destruct() 
	{
		extract($this->data);
		include($this->render);
	}
}