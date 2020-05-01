<?php


use Phinx\Seed\AbstractSeed;

class AuthorSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'first_name' => 'Charles',
                'last_name' => 'Dickens',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Austen',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'first_name' => 'James',
                'last_name' => 'Patterson',
                'created' => date('Y-m-d H:i:s'),
            ]
        ];

        $authors = $this->table('authors');
        $authors->insert($data)
            ->saveData();
    }
}
