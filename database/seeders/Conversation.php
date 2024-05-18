<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Conversation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // define sample questions and answers
         $data = [
            [
                'question' => 'Thanks. What was the best part about your experience?',
                'answers' => ['Mary Mary Bar', '>>Mrkt', 'Brightline+']
            ],
            [
                'question' => 'Tell us more about what you loved.',
                'answers' => [] // Will indicate free text entry in backend
            ],
            [
                'question' => '
                    Which of these best describe the group composition and primary
                    purpose for your most recent travel on Brightline?
                    ',
                'answers' => [
                    'Florida Resident Adult Leisure...',
                    'Florida Resident Family Leisure...',
                    'Florida Resident Senior',
                    'US Domestic Business Travel'
                    ]

            ]
        ];

        // inserting data into databse
        foreach ($data as $entry) {
            $questionId = DB::table('questions')->insertGetId([
                'question' => $entry['question'],
            ]);

            if (!empty($entry['answers'])) {
                $answers = [];
                foreach ($entry['answers'] as $answer) {
                    $answers[] = [
                        'question_id' => $questionId,
                        'response' => $answer
                    ];
                }
                DB::table('answers')->insert($answers);
            }
        }
    }
}
