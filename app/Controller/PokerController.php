<?php
/**
 * PokerController
 *
 * @copyright Copyright © 2019 AWstreams. All rights reserved.
 * @author    ahmed.atef@awstreams.com
 */

namespace App\Controller;


use App\Model\Game;
use Core\Controller;

class PokerController extends Controller
{
    public function index()
    {
        if($this->_session->get('game_over'))
            $this->redirect('/poker/success');
        if(!$this->_session->get('selected_card'))
            $this->redirect('/');
        $deck = $this->_session->get('current_deck');
        $history = $this->_session->get('history_games') ?: [];
        $currentPercent = round((1/$deck->count()) * 100);
        $drawnCard = $this->_session->get('drawn_card');
        $errors = $this->_session->get('errors');
        $selectedCard = $this->_session->get('selected_card');
        $this->view('poker.index', compact('deck', 'history', 'currentPercent', 'drawnCard', 'errors', 'selectedCard'));
    }
    public function draw(){
        $errors = [];
        $params = $this->getRequest()->getParams();
        if($this->_session->get('form_key') !== $params['_token']){
            $errors[] = 'Invalid form Key';
        }
        if(!$errors){
            $deck = $this->_session->get('current_deck');
            $drawnCard = $deck->draw();
            if($drawnCard->getCardName() == $this->_session->get('selected_card')){
                $this->_session->set('game_over', true);
                $this->_session->set('current_percentage', round((1/$deck->count()) * 100));
                $recentGames = $this->_session->get('history_games');
                $id = ((is_array($recentGames) && count($recentGames) > 0) ? count($recentGames) + 1 : 1);
                $game = new Game($id, $drawnCard->getCardName(), $this->_session->get('current_percentage'));
                if($recentGames && is_array($recentGames))
                    array_push($recentGames, $game);
                else
                    $recentGames = [$game];
                $this->_session->set('history_games', $recentGames);
            }
            $this->_session->set('drawn_card',$drawnCard);
            $this->_session->set('current_deck', $deck);
        }else{
            $this->_session->set('errors', $errors);
        }
        $this->redirect('/poker/index');
    }
    public function success()
    {
        if(!$this->_session->get('game_over')){
            $this->redirect('/');
        }
        $percentage = $this->_session->get('current_percentage');
        $this->view('poker.success', compact('percentage'));
    }
    public function clearSessionData()
    {
        $this->_session->del('selected_card');
        $this->_session->del('current_percentage');
        $this->_session->del('current_deck');
        $this->_session->del('drawn_card');
        $this->_session->del('game_over');
        $this->_session->del('errors');
        $this->redirect('/');
    }
}