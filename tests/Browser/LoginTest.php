<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('HOME')
                    ->with('.navigation', function ($navigation) {
                        $navigation->clickLink('Log in');
                    })
                    ->assertRouteIs('login')
                    ->with('.form', function ($form) {
                        $form->type('email', 'j.doe@pl.hanze.nl')
                             ->type('password', 'secret')
                             ->press('LOGIN');
                    })
                    ->assertRouteIs('home');
        });
    }
}
