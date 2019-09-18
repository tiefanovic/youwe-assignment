<?php
/**
 * HomeController
 *
 * @copyright Copyright © 2019 AWstreams. All rights reserved.
 * @author    ahmed.atef@awstreams.com
 */

namespace App\Controller;


use App\Model\Card;
use App\Model\Deck;
use \Core\Controller;
use Core\Session;

class HomeController extends Controller
{
    public function index()
    {
        if($this->_session->get('selected_card'))
            $this->redirect('/poker/index');
        $deck = new Deck();
        $this->view('home.index', compact('deck'));
    }
    public function selectCard(){
        //Validate Form
        $errors = [];
        $params = $this->getRequest()->getParams();
        if($this->_session->get('form_key') !== $params['_token']){
            $errors[] = 'Invalid form Key';
        }
        if(!$this->validate($params['selected_card'])){
            $errors[] = 'Invalid Card';
        }
        if($errors){
            $deck = new Deck();
            $this->view('home.index', compact('deck', 'errors'));
        }else{
            if(!$this->_session->get('selected_card')){}
                $this->_session->set('selected_card', $params['selected_card']);
            $deck = new Deck();
            $deck->shuffle();
            $this->_session->set('current_deck', $deck);
            $this->_session->set('current_percent', 0);
            $this->redirect('/poker/index');
        }

    }
    private function validate($card_id){
        if(!is_string($card_id) && strlen($card_id) !== 2)
            return false;
        list($value, $suite) = str_split($card_id);
        if(!in_array($suite, array_values(Card::SUITES)) || !in_array($value, array_values(Card::VALUE)))
            return false;
        return true;
    }
}