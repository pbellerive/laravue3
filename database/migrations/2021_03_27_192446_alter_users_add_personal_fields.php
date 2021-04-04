<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersAddPersonalFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function(Blueprint $table) {
            $table->id();
            $table->string('code', 5);
            $table->timestamps();
        });

        Schema::create('country_translations', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->string('name');
            $table->string('locale', 3);

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });

        Schema::create('states', function(Blueprint $table) {
            $table->id();
            $table->string('code', 5);
            $table->unsignedBigInteger('country_id');
            $table->timestamps();

             $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });

        Schema::create('state_translations', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('state_id');
            $table->string('name');
            $table->string('locale', 3);

            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });


        Schema::table('users', function(Blueprint $table) {
            $table->date('birth_date')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('cell_phone_number')->nullable();
            $table->string('preferred_locale')->default('fr');

            $table->foreign('state_id')->references('id')->on('states')->onDelete('set NULL');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set NULL');
        });

        \App\Settings\Country::create([
            'code' => 'ca',
            'fr' => [
                'name' => 'Canada'
            ],
            'en' => [
                'name' => 'Canada'
            ]
        ]);

        $canadaStates = [
            [
                'code' => 'ab',
                'fr' => [
                    'name' => 'Alberta'
                ],
                'en' => [
                    'name' => 'Alberta'
                ]
            ],
            [
                'code' => 'bc',
                'fr' => [
                    'name' => 'Colombie Britannique'
                ],
                'en' => [
                    'name' => 'British Colombia'
                ]
            ],
            [
                'code' => 'nb',
                'fr' => [
                    'name' => 'Nouveau-Brunswick'
                ],
                'en' => [
                    'name' => 'New Brunswick'
                ]
            ],
            [
                'code' => 'nl',
                'fr' => [
                    'name' => 'Terre-Neuve-et-Labrador'
                ],
                'en' => [
                    'name' => 'Newfoundland and Labrador'
                ]
            ],
            [
                'code' => 'ns',
                'fr' => [
                    'name' => 'Nouvelle-Écosse'
                ],
                'en' => [
                    'name' => 'Nova scotia'
                ]
            ],
            [
                'code' => 'nu',
                'fr' => [
                    'name' => 'Nunavut'
                ],
                'en' => [
                    'name' => 'Nunavut'
                ]
            ],
            [
                'code' => 'nt',
                'fr' => [
                    'name' => 'Territoire du Nord-Ouest'
                ],
                'en' => [
                    'name' => 'Norwest Territories'
                ]
            ],
            [
                'code' => 'on',
                'fr' => [
                    'name' => 'Ontario'
                ],
                'en' => [
                    'name' => 'Ontario'
                ]
            ],
            [
                'code' => 'pe',
                'fr' => [
                    'name' => 'Île-du-Prince-Éduard'
                ],
                'en' => [
                    'name' => 'Prince Edward Island'
                ]
            ],
            [
                'code' => 'qc',
                'fr' => [
                    'name' => 'Québec'
                ],
                'en' => [
                    'name' => 'Quebec'
                ]
            ],
            [
                'code' => 'sk',
                'fr' => [
                    'name' => 'Saskatchewan'
                ],
                'en' => [
                    'name' => 'Saskatchewan'
                ]
            ],
            [
                'code' => 'yt',
                'fr' => [
                    'name' => 'Yukon'
                ],
                'en' => [
                    'name' => 'Yukon'
                ]
            ],
        ];

        $canada = \App\Settings\Country::first(); // un seul pay Canada pour le moment

        foreach($canadaStates as $state) {
            $state['country_id'] = $canada->id;
            \App\Settings\State::create($state);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_country_id_foreign');
            $table->dropForeign('users_state_id_foreign');

            $table->dropColumn('birth_date');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('state_id');
            $table->dropColumn('country_id');
            $table->dropColumn('postal_code');
            $table->dropColumn('phone_number');
            $table->dropColumn('cell_phone_number');
            $table->dropColumn('preferred_locale');
        });

        Schema::dropIfExists('state_translations');
        Schema::dropIfExists('states');
        Schema::dropIfExists('country_translations');
        Schema::dropIfExists('countries');
    }
}
