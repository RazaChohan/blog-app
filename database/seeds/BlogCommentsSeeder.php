<?php


use Phinx\Seed\AbstractSeed;

class BlogCommentsSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'BlogsSeeder'
        ];
    }
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
                'comment' => 'Good article',
                'blog_id' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'comment' => 'Average article',
                'blog_id' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'comment' => 'Average article',
                'blog_id' => 2,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'comment' => 'A good read',
                'blog_id' => 2,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'comment' => 'Quite helpful article',
                'blog_id' => 3,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'comment' => 'Good article',
                'blog_id' => 3,
                'created' => date('Y-m-d H:i:s'),
            ]
        ];

        $blogs = $this->table('blog_comments');
        $blogs->insert($data)
            ->saveData();
    }
}
