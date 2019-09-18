<?php
/**
 * Controller
 *
 * @copyright Copyright © 2019 AWstreams. All rights reserved.
 * @author    ahmed.atef@awstreams.com
 */

namespace Core;


class Controller
{
    private $_params;
    protected $_session;
    public function __construct()
    {
        if(!$this->_session){
            $this->_session = new SmartSession();
        }
    }
    public function getRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->_params = $_POST;
        }else{
            if(isset($_GET)){
                $this->_params = $_GET;
            }
        }
        return $this;
    }
    public function view($path, $vars = [])
    {
        extract($vars);
        $path = str_replace('.', DS, $path);
        // load header file
        require BP . DS . 'views' . DS . 'layout' . DS . 'header.php';
        require BP . DS . 'views' . DS . $path . '.php';
        require BP . DS . 'views' . DS . 'layout' . DS . 'footer.php';
    }
    public function getParams()
    {
        return $this->_params;
    }
    public function getFormKey()
    {
        $token = md5(uniqid(microtime(), true));
        $this->_session->set('form_key', $token);
        return $token;
    }
    public function redirect($location)
    {
        header('Location: ' . $location);
        exit;
    }
}