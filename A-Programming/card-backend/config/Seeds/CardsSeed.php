<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Cards seed.
 */
class CardsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['player_id' => 1, 'card' => 'S-A'],
            ['player_id' => 2, 'card' => 'S-A'],
            ['player_id' => 3, 'card' => 'S-A'],
            ['player_id' => 4, 'card' => 'S-A'],
            ['player_id' => 5, 'card' => 'S-A'],
            ['player_id' => 6, 'card' => 'S-A'],
            ['player_id' => 7, 'card' => 'S-A'],
            ['player_id' => 8, 'card' => 'S-A'],
            ['player_id' => 9, 'card' => 'S-A'],
            ['player_id' => 10, 'card' => 'S-A'],
            ['player_id' => 11, 'card' => 'S-A'],
            ['player_id' => 12, 'card' => 'S-A'],
            ['player_id' => 13, 'card' => 'S-A'],
            ['player_id' => 14, 'card' => 'S-A'],
            ['player_id' => 15, 'card' => 'S-A'],
            ['player_id' => 16, 'card' => 'S-A'],
            ['player_id' => 17, 'card' => 'S-A'],
            ['player_id' => 18, 'card' => 'S-A'],
            ['player_id' => 19, 'card' => 'S-A'],
            ['player_id' => 20, 'card' => 'S-A'],
            ['player_id' => 21, 'card' => 'S-A'],
            ['player_id' => 22, 'card' => 'S-A'],
            ['player_id' => 23, 'card' => 'S-A'],
            ['player_id' => 24, 'card' => 'S-A'],
            ['player_id' => 25, 'card' => 'S-A'],
            ['player_id' => 26, 'card' => 'S-A'],
            ['player_id' => 27, 'card' => 'S-A'],
            ['player_id' => 28, 'card' => 'S-A'],
            ['player_id' => 29, 'card' => 'S-A'],
            ['player_id' => 30, 'card' => 'S-A'],
        ];

        $table = $this->table('cards');
        $table->insert($data)->save();
    }
}
