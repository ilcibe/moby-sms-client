<?php


namespace IlCibe\MobySmsClient\Tests\Common;


use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionProperty;

abstract class CommonTestCase extends TestCase
{
    /**
     * @param $object
     * @param $methodName
     * @param array $parameters
     * @return mixed
     * @throws \ReflectionException
     */
    public function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     *
     * @param $object : Is the class name
     * @param $variable : Is the name of the var do you want to override
     * @param $value : Value to override
     * @return void
     * @throws \ReflectionException
     */
    public function overridePrivateVar(&$object, $variable, $value)
    {
        $reflector = new ReflectionProperty(get_class($object), $variable);
        $reflector->setAccessible(true);
        $reflector->setValue($object, $value);
    }

    /**
     * @param $class
     * @return mixed
     * @throws \ReflectionException
     */
    public function createInstanceWithoutConstructor($class)
    {
        $reflector = new ReflectionClass($class);
        $properties = $reflector->getProperties();
        $defaults = $reflector->getDefaultProperties();

        $serealized = "O:" . strlen($class) . ":\"$class\":".count($properties) .':{';
        foreach ($properties as $property) {
            $name = $property->getName();
            if ($property->isProtected()) {
                $name = chr(0) . '*' .chr(0) .$name;
            } elseif ($property->isPrivate()) {
                $name = chr(0) . $class. chr(0).$name;
            }
            $serealized .= serialize($name);
            if (array_key_exists($property->getName(), $defaults)) {
                $serealized .= serialize($defaults[$property->getName()]);
            } else {
                $serealized .= serialize(null);
            }
        }
        $serealized .="}";
        return unserialize($serealized);
    }

}