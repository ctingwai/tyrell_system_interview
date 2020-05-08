<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Players seed.
 */
class PlayersSeed extends AbstractSeed
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
            ['id' => 1, 'name' => 'Amisha Higgins'],
            ['id' => 2, 'name' => 'Arnie Harrison'],
            ['id' => 3, 'name' => 'Khushi Harvey'],
            ['id' => 4, 'name' => 'Kady Sullivan'],
            ['id' => 5, 'name' => 'Denny Adam'],
            ['id' => 6, 'name' => 'Archibald Bentley'],
            ['id' => 7, 'name' => 'Raj Byrd'],
            ['id' => 8, 'name' => 'krah Galindo'],
            ['id' => 9, 'name' => 'Amayah Charles'],
            ['id' => 10, 'name' => 'Caleb Cherry'],
            ['id' => 11, 'name' => 'Heena Robin'],
            ['id' => 12, 'name' => 'Amalie Berg'],
            ['id' => 13, 'name' => 'Aqib Morrow'],
            ['id' => 14, 'name' => 'Orlaith Weaver'],
            ['id' => 15, 'name' => 'Betty Rios'],
            ['id' => 16, 'name' => 'Ronaldo ORyan'],
            ['id' => 17, 'name' => 'Keiran Hernandez'],
            ['id' => 18, 'name' => 'Clarke Rich'],
            ['id' => 19, 'name' => 'Khaleesi Anthony'],
            ['id' => 20, 'name' => 'Nabilah Garrett'],
            ['id' => 21, 'name' => 'Jarod Quintana'],
            ['id' => 22, 'name' => 'Star Valenzuela'],
            ['id' => 23, 'name' => 'Fraser Boyd'],
            ['id' => 24, 'name' => 'Mehdi Crane'],
            ['id' => 25, 'name' => 'Catrin Poole'],
            ['id' => 26, 'name' => 'Todd Mohamed'],
            ['id' => 27, 'name' => 'Iqra Kirby'],
            ['id' => 28, 'name' => 'Romeo Patel'],
            ['id' => 29, 'name' => 'Dwayne Lowery'],
            ['id' => 30, 'name' => 'Velma Mendez'],
        ];

        $table = $this->table('players');
        $table->insert($data)->save();
    }
}
