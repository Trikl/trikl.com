<?php
/**
 * Handles the view functionality of our MVC framework
 */
class View_Model
{
    /**
     * Holds variables assigned to template
     */
    private $data = array();

    /**
     * Holds render status of view.
     */
    private $render = FALSE;

    /**
     * Accept a template to load
     */

     
    public function __construct($template , $discard = false)
    {
        //compose file name
        $header = SERVER_ROOT . '/public/views/header.tpl.php';
        $file = SERVER_ROOT . '/public/views/' . strtolower($template) . '.tpl.php';
        $footer = SERVER_ROOT . '/public/views/footer.tpl.php';
    
        if (file_exists($file))
        {
            /**
             * trigger render to include file when this model is destroyed
             * if we render it now, we wouldn't be able to assign variables
             * to the view!
             */
             if (!$discard)
	        $this->header = $header;
	        
            $this->render = $file;
            
             if (!$discard)
	        $this->footer = $footer;
        }        
    }

    /**
     * Receives assignments from controller and stores in local data array
     * 
     * @param $variable
     * @param $value
     */
    public function assign($variable , $value)
    {
        $this->data[$variable] = $value;
    }
    
    public function pass($variable , $value)
    {
	    $this->info = $value;
    }

    public function __destruct()
    {
        //parse data variables into local variables, so that they render to the view
        $data = $this->data;
        $info = $this->info;
    
        //render view
        if(isset($this->header)) include($this->header);
        if(isset($this->render)) include($this->render);
        if(isset($this->footer)) include($this->footer);

    }
}