<?php
namespace NwLaravelTest\Dropbox;

use PHPUnit_Framework_TestCase;
use ReflectionClass;
use NwLaravel\Dropbox\DropboxFacade;

class DropboxFacadeTest extends PHPUnit_Framework_TestCase
{
    protected function callProtectedMethod($object, $method, array $args=array())
    {
        $class = new ReflectionClass(get_class($object));
        $method = $class->getMethod($method);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $args);
    }

    public function testGetFacadeAccessor()
    {
        $object = new DropboxFacade;

        $return = $this->callProtectedMethod($object, 'getFacadeAccessor');
        
        $this->assertEquals('nwlaravel.dropbox', $return);
    }
}