<?php


use Phinx\Seed\AbstractSeed;

class BlogsSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'AuthorSeeder'
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
                'title' => 'Where Does Helpfulness End?',
                'content' => 'I grow at a king,\' said Alice. \'Then you may SIT down,\' the King and the Panther received knife and fork with a smile. There was a large cat which was full of tears, but said nothing. \'Perhaps it hasn\'t one,\' Alice ventured to say. \'What is his sorrow?\' she asked the Gryphon, and the Queen, who.',
                'image' => 'http://blog.m2.mirasvit.com/media/blog/x21.jpg.pagespeed.ic.Cqn0_2-eg9.webp',
                'author_id' => 1,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Five Designers You Will Love!',
                'content' => 'English,\' thought Alice; \'only, as it\'s asleep, I suppose I ought to have finished,\' said the Dormouse. \'Don\'t talk nonsense,\' said Alice in a furious passion, and went down on one side, to look down and looked into its face was quite impossible to say it out again, so she felt unhappy. \'It was the Cat remarked.',
                'image' => 'http://blog.m2.mirasvit.com/media/blog/x18.jpg.pagespeed.ic.TpSyc9Mdfz.webp',
                'author_id' => 2,
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Shopo makes shopping social with its latest app update',
                'content' => 'March Hare. Alice sighed wearily. \'I think you could see her after the birds! Why, she\'ll eat a bat?\' when suddenly, thump! thump! down she came upon a low curtain she had sat down again in a natural way. \'I thought.',
                'image' => 'http://blog.m2.mirasvit.com/media/blog/x8.jpg.pagespeed.ic.D15iSXokDK.webp',
                'author_id' => 3,
                'created' => date('Y-m-d H:i:s'),
            ]
        ];

        $blogs = $this->table('blogs');
        $blogs->insert($data)
            ->saveData();
    }
}
