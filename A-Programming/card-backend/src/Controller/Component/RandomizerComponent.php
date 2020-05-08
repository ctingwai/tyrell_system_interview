<?php
/**
 * Randomizer component, component helper that will randomize
 * cards and names
 *
 * @author      Chong Ting Wai
 * @since       0.1.0
 * @link        https://blog.twcloud.tech
 */
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Http\Client;

/**
 * Randomizer component
 *
 * @author      Chong Ting Wai
 * @since       0.1.0
 * @link        https://blog.twcloud.tech
 */
class RandomizerComponent extends Component
{
    const NAME_API = 'http://names.drycodes.com/';

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * Http client
     *
     * @var Cake\Http\Client
     * */
    private $_http = null;

    public function beforeFilter()
    {
        $this->_http = new Client();
    }

    public function names($total = 10)
    {
        $response = $this->_http->get(self::NAME_API . $total);
        $names = $response->getJson();
        return $names;
    }

    public function cards($totalPlayers = 0, $cardsPerPlayer = 1, $deck = [])
    {
        // Calculate number of cards required
        $cardsPerDeck = count($deck);
        $totalCardsRequired = $totalPlayers * $cardsPerPlayer;
        $decks = [];
        // Keep adding a new deck into $decks until total cards
        // is greater than total cards required
        while(count($decks) < $totalCardsRequired) {
            $decks = array_merge($decks, $deck);
        }

        // Everyday im shuffling =)
        shuffle($decks);


        // Distribute cards, simulates real world card distribution
        $cards = [];
        for ($i = 0; $i < $cardsPerPlayer; $i++) {
            for ($j = 0; $j < $totalPlayers; $j++) {
                // Distribute only 1 card to 1 player in each round
                if (!isset($cards[$j])) {
                    $cards[$j] = [];
                }
                $cards[$j][] = array_pop($decks);
            }
        }

        return $cards;
    }
}
