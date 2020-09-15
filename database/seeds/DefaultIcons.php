<?php

use Illuminate\Database\Seeder;

/**
 * Class DefaultIcons
 * This seed insert icons data into the icon table in DB
 */
class DefaultIcons extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('icons')->truncate();
        \Illuminate\Support\Facades\DB::table('icons')
            ->insert([
                [ "name"=>"No Icon",             "class"=>"fas fa-anchor invisible"   ],
                [ "name"=>"home",                "class"=>"fas fa-home"               ],
                [ "name"=>"child",               "class"=>"fas fa-child"              ],
                [ "name"=>"baby",                "class"=>"fas fa-baby"               ],
                [ "name"=>"heart",               "class"=>"far fa-heart"              ],
                [ "name"=>"heartbeat",           "class"=>"fas fa-heartbeat"          ],
                [ "name"=>"wheelchair",          "class"=>"fas fa-wheelchair"         ],
                [ "name"=>"Ice-cream",           "class"=>"fas fa-ice-cream"          ],
                [ "name"=>"birthday-cake",       "class"=>"fas fa-birthday-cake"      ],
                [ "name"=>"cookie-bite",         "class"=>"fas fa-cookie-bite"        ],
                [ "name"=>"pizza-slice",         "class"=>"fas fa-pizza-slice"        ],
                [ "name"=>"glass-cheers",        "class"=>"fas fa-glass-cheers"       ],
                [ "name"=>"utensils",            "class"=>"fas fa-utensils"           ],
                [ "name"=>"Gas-Pump",            "class"=>"fas fa-gas-pump"           ],
                [ "name"=>"Bus",                 "class"=>"fas fa-bus-alt"            ],
                [ "name"=>"plane",               "class"=>"fas fa-plane"              ],
                [ "name"=>"car",                 "class"=>"fas fa-car"                ],
                [ "name"=>"paw",                 "class"=>"fas fa-paw"                ],
                [ "name"=>"cat",                 "class"=>"fas fa-cat"                ],
                [ "name"=>"bone",                "class"=>"fas fa-bone"               ],
                [ "name"=>"basketball-ball",     "class"=>"fas fa-basketball-ball"    ],
                [ "name"=>"Swimmer",             "class"=>"fas fa-swimmer"            ],
                [ "name"=>"running",             "class"=>"fas fa-running"            ],
                [ "name"=>"Dumbbell",            "class"=>"fas fa-dumbbell"           ],
                [ "name"=>"wallet",              "class"=>"fas fa-wallet"             ],
                [ "name"=>"credit-card",         "class"=>"fas fa-credit-card"        ],
                [ "name"=>"money-check",         "class"=>"fas fa-money-check"        ],
                [ "name"=>"file-alt",            "class"=>"far fa-file-alt"           ],
                [ "name"=>"file-invoice-dollar", "class"=>"fas fa-file-invoice-dollar"],
                [ "name"=>"envelope-open-text",  "class"=>"fas fa-envelope-open-text" ],
                [ "name"=>"envelope",            "class"=>"fas fa-envelope"           ],
                [ "name"=>"percent",             "class"=>"fas fa-percent"            ],
                [ "name"=>"coins",               "class"=>"fas fa-coins"              ],
                [ "name"=>"donate",              "class"=>"fas fa-donate"             ],
                [ "name"=>"hand-holding-usd",    "class"=>"fas fa-hand-holding-usd"   ],
                [ "name"=>"handshake",           "class"=>"far fa-handshake"          ],
                [ "name"=>"chart-line",          "class"=>"fas fa-chart-line"         ],
                [ "name"=>"list",                "class"=>"fas fa-list"               ],
                [ "name"=>"Umbrella Beach",      "class"=>"fas fa-umbrella-beach"     ],
                [ "name"=>"theater-masks",       "class"=>"fas fa-theater-masks"      ],
                [ "name"=>"camera-retro",        "class"=>"fas fa-camera-retro"       ],
                [ "name"=>"video",               "class"=>"fas fa-video"              ],
                [ "name"=>"dice",                "class"=>"fas fa-dice"               ],
                [ "name"=>"gamepad",             "class"=>"fas fa-gamepad"            ],
                [ "name"=>"shopping-basket",     "class"=>"fas fa-shopping-basket"    ],
                [ "name"=>"shopping-bag",        "class"=>"fas fa-shopping-bag"       ],
                [ "name"=>"Book",                "class"=>"fas fa-book"               ],
                [ "name"=>"user-graduate",       "class"=>"fas fa-user-graduate"      ],
                [ "name"=>"Tools",               "class"=>"fas fa-tools"              ],
                [ "name"=>"tshirt",              "class"=>"fas fa-tshirt"             ],
                [ "name"=>"tags",                "class"=>"fas fa-tags"               ],
                [ "name"=>"mobile-alt",          "class"=>"fas fa-mobile-alt"         ],
                [ "name"=>"smoking",             "class"=>"fas fa-smoking"            ],
                [ "name"=>"itunes-note",         "class"=>"fab fa-itunes-note"        ],
                [ "name"=>"icons",               "class"=>"fas fa-icons"              ],
                [ "name"=>"gifts",               "class"=>"fas fa-gifts"              ],
                [ "name"=>"anchor",              "class"=>"fas fa-anchor"             ]
            ]);
    }
}
