<?php
/**
 * WordController
 *
 * @copyright Copyright © 2019 Tiefanovic. All rights reserved.
 * @author    tiefanovic.business@gmail.com
 */

namespace App\Controller;


use App\Model\Sentence;
use Core\Controller;

class WordController extends Controller
{
    public function index()
    {
        $errors = $this->_session->get('errors');
        $result = $this->_session->get('analyze_result');
        $this->view('word.index', compact('errors', 'result'));
    }
    public function analyze()
    {
        $params = $this->getRequest()->getParams();
        $errors = [];
        if($this->_session->get('form_key') !== $params['_token']){
            $errors[] = 'Invalid Form Key';
        }
        if(!is_string(htmlspecialchars($params['sentence'])) || strlen($params['sentence'] > 250)){
            $errors[] = 'Invalid Input. Please type text not exceeding 250 characters';
        }
        if(!$errors){
            $sentence = new Sentence($params['sentence']);
            $result = $sentence->analyze()->getResult();
            $this->_session->set('analyze_result', $result);
            $this->redirect('/words');
        }else{
            $this->_session->set('errors', $errors);
        }
        $this->redirect('/words');
    }
}