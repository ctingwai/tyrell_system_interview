<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCards extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('cards');
        $table->addColumn('card', 'string', [
            'default' => null,
            'limit' => 3,
            'null' => false,
        ]);
        $table->addColumn('player_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
	    'signed' => false,
        ]);
        $table->create();
    }
}
