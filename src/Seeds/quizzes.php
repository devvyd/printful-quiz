<?php

return [
    'quizzes' => [
        'Numbers'        => [
            [
                'question' => 'How much is math constant e?',
                '3.14',
                '2.7',
                '5',
                '4',
                'correct'  => [1]
            ],
            [
                'question' => 'Why was 6 afraid of 7?',
                'Because 7 8 9',
                'Bigger number',
                'Dunno, do not care',
                'correct'  => [0, 2]
            ],
            [
                'question' => 'Which is math constant is bigger: tau or e * 2?',
                'Sun is bigger, of course',
                'Same amount',
                'Why on Earth math questions?',
                'correct'  => [0, 1, 2]
            ]
        ],
        'Life and stuff' => [
            [
                'question' => 'Can we travel out of Milky way?',
                'No, we will die beforehand',
                'Yes, but as dead',
                'I expected question different question',
                'correct'  => [0, 1, 2]
            ],
            [
                'question' => 'Does this test task has unit tests?',
                'Probably not',
                'Did not have enough time due to time consuming bugs',
                'Sure hope so!',
                'correct'  => [0]
            ]
        ]
    ]
];