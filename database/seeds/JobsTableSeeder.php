<?php

use Illuminate\Database\Seeder;
use JobPortal\Helpers\Uuid;
use Carbon\Carbon;

class JobsTableSeeder extends Seeder
{
    public function __construct(Uuid $uuid, Carbon $carbon)
    {
        $this->uuid   = $uuid;
        $this->carbon = $carbon;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobSeeds = [
            [
                'id' => 1,
                'uuid' => $this->uuid->generate(),
                'email' => str_random(10).'@gmail.com',
                'title' => 'Senior Frontend Developer',
                'details' => 'Do you often visit caniuse.com and wish the web 
                    were ready? We\'re looking for a Senior Frontend Developer 
                    who\'s passionate about designing and building offline-first 
                    mobile-first user interfaces for every screen.',
                'created_at' => $this->carbon->now(),
                'updated_at' => $this->carbon->now(),

            ],
            [
                'id' => 2,
                'uuid' => $this->uuid->generate(),
                'email' => str_random(10).'@gmail.com',
                'title' => 'Senior PHP / Laravel Developer for RESTful API Project',
                'details' => 'We are looking for a Senior Laravel developer with 
                    RESTful API experience to work with our team for 3 months.',
                'created_at' => $this->carbon->now(),
                'updated_at' => $this->carbon->now(),
            ],
            [
                'id' => 3,
                'uuid' => $this->uuid->generate(),
                'email' => str_random(10).'@gmail.com',
                'title' => 'Laravel "full-stack" developer',
                'details' => 'A US based company is  looking for an experienced 
                    Laravel "full-stack" developer and is willing to pay accordingly.',
                'created_at' => $this->carbon->now(),
                'updated_at' => $this->carbon->now(),
            ],
            [
                'id' => 4,
                'uuid' => $this->uuid->generate(),
                'email' => str_random(10).'@gmail.com',
                'title' => 'Front End Developer – UI / UX',
                'details' => 'Join our team and actively shape the technical 
                    future of the world’s largest online hotel search. Enjoy the 
                    freedom to question established processes, work with top-notch 
                    technologies and develop new tools to impress our 120 million 
                    users per month!',
                'created_at' => $this->carbon->now(),
                'updated_at' => $this->carbon->now(),
            ],
            [
                'id' => 5,
                'uuid' => $this->uuid->generate(),
                'email' => str_random(10).'@gmail.com',
                'title' => 'Front End Developer',
                'details' => 'We are looking for the world’s best Front 
                    End Developers all around the globe! Join us at our beautiful 
                    headquarters in Amsterdam and work on planet Earth’s  #1 
                    accommodation website with some of our industry’s smartest 
                    people! You’ll be given the freedom to make meaningful and
                    measurable improvements impacting millions of users.',
                'created_at' => $this->carbon->now(),
                'updated_at' => $this->carbon->now(),
            ],
        ];

        DB::table('jobs')->insert($jobSeeds);

        $skillSeeds = [
            //1
            ['id' => 1, 'job_id' => 1, 'name' => 'HTML5'],
            ['id' => 2, 'job_id' => 1, 'name' => 'CSS3'],
            ['id' => 3, 'job_id' => 1, 'name' => 'JavaScript'],
            ['id' => 4, 'job_id' => 1, 'name' => 'jQuery'],

            //2
            ['id' => 5, 'job_id' => 2, 'name' => 'HTML5'],
            ['id' => 6, 'job_id' => 2, 'name' => 'CSS3'],
            ['id' => 7, 'job_id' => 2, 'name' => 'JavaScript'],
            ['id' => 8, 'job_id' => 2, 'name' => 'jQuery'],
            ['id' => 9, 'job_id' => 2, 'name' => 'Laravel'],
            ['id' => 10, 'job_id' => 2, 'name' => 'MySQL'],

            //3
            ['id' => 11, 'job_id' => 3, 'name' => 'HTML5'],
            ['id' => 12, 'job_id' => 3, 'name' => 'CSS3'],
            ['id' => 13, 'job_id' => 3, 'name' => 'JavaScript'],
            ['id' => 14, 'job_id' => 3, 'name' => 'jQuery'],
            ['id' => 15, 'job_id' => 3, 'name' => 'Laravel'],
            ['id' => 16, 'job_id' => 3, 'name' => 'MySQL'],

            //4
            ['id' => 17, 'job_id' => 4, 'name' => 'HTML5'],
            ['id' => 18, 'job_id' => 4, 'name' => 'CSS3'],
            ['id' => 19, 'job_id' => 4, 'name' => 'JavaScript'],
            ['id' => 20, 'job_id' => 4, 'name' => 'jQuery'],

            //5
            ['id' => 21, 'job_id' => 5, 'name' => 'HTML5'],
            ['id' => 22, 'job_id' => 5, 'name' => 'CSS3'],
            ['id' => 23, 'job_id' => 5, 'name' => 'JavaScript'],
            ['id' => 24, 'job_id' => 5, 'name' => 'jQuery'],
        ];

        DB::table('job_skills')->insert($skillSeeds);
    }
}
