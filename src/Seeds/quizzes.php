<?php

return [
    'quizzes' => [
        'Numbers'        => [
            'How much is math constant e?'                    => [
                0         => '3.14',
                1         => '2.7',
                2         => '5',
                3         => '4',
                'correct' => [1]
            ],
            'Why was 6 afraid of 7?'                          => [
                0         => 'Because 7 8 9',
                1         => 'Bigger number',
                2         => 'Dunno, do not care',
                'correct' => [0, 2]
            ],
            'Which is math constant is bigger: tau or e * 2?' => [
                0         => 'Sun is bigger, of course',
                1         => 'Same amount',
                2         => 'Why on Earth math questions?',
                'correct' => [0, 1, 2]
            ]
        ],
        'Life and stuff' => [
            'Can we travel out of Milky way?'     => [
                0         => 'No, we will die beforehand',
                1         => 'Yes, but as dead',
                2         => 'I expected question different question',
                'correct' => [0, 1, 2]
            ],
            'Does this test task has unit tests?' => [
                0         => 'Probably not',
                1         => 'Did not have enough time due to time consuming bugs',
                2         => 'Sure hope so!',
                'correct' => [0]
            ]
        ]
    ]
];