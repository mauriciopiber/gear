<?php

use Phinx\Seed\AbstractSeed;

class Test extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = array(
            array(
                'dep_name'    => 'foo'
            ),
            array(
                'dep_name'    => 'bar'
            )
        );
        
        $posts = $this->table('int_dep_three');
        $posts->insert($data)
        ->save();
    }
}
