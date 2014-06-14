<?php
namespace NwLaravelTest\Dropbox;

use Mockery as m;
use PHPUnit_Framework_TestCase;
use NwLaravel\Dropbox\DropboxServiceProvider;
use Dropbox\Client;

class DropboxServiceProviderTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }
    
    public function testShouldBoot()
    {
        $sp = m::mock('NwLaravel\Dropbox\DropboxServiceProvider[package]');
        $sp->shouldReceive('package')
           ->once()
           ->with('naturalweb/nwlaravel-dropbox')
           ->andReturn(true);
           
        $sp ->boot();
    }

    public function testShouldRegister()
    {
        $test = $this;

        // Configurations
        $token   = 'abcd1234';
        $nameApp = 'foo-bar';

        $config = m::mock('Illuminate\Config\Repository');
        $config->shouldReceive('get')
               ->once()
               ->with('nwlaravel-dropbox::dropbox')
               ->andReturn(array('token' => $token, 'app' => $nameApp));

        //LaravelApp
        $app = m::mock('ArrayAccess');
        $app->shouldReceive('offsetGet')
            ->times(1)
            ->with('config')
            ->andReturn($config);

        $sp = new DropboxServiceProvider($app);
        
        $app->shouldReceive('bind')
            ->once()
            ->andReturnUsing(
                // Make sure that the commands are being registered
                // with a closure that returns the correct
                // object.
                function ($name, $closure) use ($test, $app, $token, $nameApp) {

                    $client = new Client($token, $nameApp);

                    $shouldBe = ['nwlaravel.dropbox' => $client];

                    $test->assertEquals($shouldBe[$name], $closure($app));
                }
            );
        $sp->register();
    }
}