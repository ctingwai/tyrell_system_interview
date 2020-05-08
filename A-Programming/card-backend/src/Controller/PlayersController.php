<?php
/**
 * PlayersController
 *
 * @author      Chong Ting Wai
 * @since       0.1.0
 * @link        https://blog.twcloud.tech
 */
declare(strict_types=1);

namespace App\Controller;

// Exception
use Cake\Http\Exception\InternalErrorException;
use Cake\Http\Exception\BadRequestException;

/**
 * Players Controller
 *
 * @property \App\Model\Table\PlayersTable $Players
 * @method \App\Model\Entity\Player[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlayersController extends AppController
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
        $players = $this->paginate($this->Players, [
            'contain' => ['Cards'],
        ]);

        $this->set(compact('players'));
    }

    /**
     * View method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $player = $this->Players->get($id, [
            'contain' => ['Cards'],
        ]);

        $this->set('player', $player);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $totalPlayers = (int)$this->request->getQuery('total_players');
            if (!$totalPlayers) {
                $totalPlayers = (int)$this->request->getData('total_players');
            }
            if (!$totalPlayers) {
                $totalPlayers = 4;
            }
            if (!is_numeric($totalPlayers)) {
                throw new BadRequestException(__('Input value does not exist or value is invalid'));
            }
            $totalPlayers = (int)$totalPlayers;

            // Clear players
            $this->Players->deleteAll([]);

            // Get random names
            $names = $this->Randomizer->names((int)$totalPlayers);

            // Create and save
            $playerEntities = [];
            foreach($names as $name) {
                $player = $this->Players->newEntity([
                    'name' => $name,
                ]);
                $playerEntities[] = $player;
            }
            if($this->Players->saveMany($playerEntities)) {
                $this->Flash->success(__('Players have been saved.'));
            } else {
                throw new InternalErrorException(__('Save players failed!'));
            }

            // Redirect to index action
            $this->setAction('index');
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $player = $this->Players->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $player = $this->Players->patchEntity($player, $this->request->getData());
            if ($this->Players->save($player)) {
                $this->Flash->success(__('The player has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The player could not be saved. Please, try again.'));
        }
        $this->set(compact('player'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $player = $this->Players->get($id);
        if ($this->Players->delete($player)) {
            $this->Flash->success(__('The player has been deleted.'));
        } else {
            $this->Flash->error(__('The player could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
