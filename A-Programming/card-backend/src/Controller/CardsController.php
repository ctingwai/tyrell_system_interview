<?php
/**
 * CardsController
 *
 * @author      Chong Ting Wai
 * @since       0.1.0
 * @link        https://blog.twcloud.tech
 */
declare(strict_types=1);

namespace App\Controller;

// System configuration
use Cake\Core\Configure;

// Exception
use Cake\Http\Exception\InternalErrorException;
use Cake\Http\Exception\BadRequestException;

/**
 * Cards Controller
 *
 * @property \App\Model\Table\CardsTable $Cards
 * @method \App\Model\Entity\Card[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CardsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Randomizer');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Players'],
        ];

        $cards = $this->paginate($this->Cards);

        $this->set(compact('cards'));
    }

    /**
     * View method
     *
     * @param string|null $id Card id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $card = $this->Cards->get($id, [
            'contain' => ['Players'],
        ]);

        $this->set('card', $card);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $cardsPerPlayer = $this->request->getQuery('cards_per_player');
            if (!$cardsPerPlayer) {
                $cardsPerPlayer = $this->request->getData('cards_per_player');
            }
            if (!$cardsPerPlayer) {
                $cardsPerPlayer = 7;
            }
            if (!is_numeric($cardsPerPlayer)) {
                throw new BadRequestException(__('Input value does not exist or value is invalid'));
            }
            $cardsPerPlayer = (int)$cardsPerPlayer;

            // Clear cards
            $this->Cards->deleteAll([]);

            // Get total players
            $totalPlayers = (int)$this->Cards->Players->find('all')->count();

            // Distribute cards to players
            $players = $this->Cards->Players->find('all');
            $cardEntities = [];
            $dist = $this->Randomizer->cards($totalPlayers, $cardsPerPlayer, Configure::read('cards'));
            foreach ($players as $i => $player) {
                foreach ($dist[$i] as $card) {
                    $cardEntities[] = $this->Cards->newEntity([
                        'player_id' => $player->id,
                        'card' => $card,
                    ]);
                }
            }

            // Save card distribution
            if($this->Cards->saveMany($cardEntities)) {
                $this->Flash->success(__('Cards have been saved.'));
            } else {
                throw new InternalErrorException(__('Save cards failed!'));
            }

            // Redirect to index action
            $this->setAction('index');
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Card id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $card = $this->Cards->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $card = $this->Cards->patchEntity($card, $this->request->getData());
            if ($this->Cards->save($card)) {
                $this->Flash->success(__('The card has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The card could not be saved. Please, try again.'));
        }
        $players = $this->Cards->Players->find('list', ['limit' => 200]);
        $this->set(compact('card', 'players'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Card id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $card = $this->Cards->get($id);
        if ($this->Cards->delete($card)) {
            $this->Flash->success(__('The card has been deleted.'));
        } else {
            $this->Flash->error(__('The card could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
