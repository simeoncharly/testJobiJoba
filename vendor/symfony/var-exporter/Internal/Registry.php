<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarExporter\Internal;

use Symfony\Component\VarExporter\Exception\ClassNotFoundException;
use Symfony\Component\VarExporter\Exception\NotInstantiableTypeException;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @internal
 */
class Registry
{
    public static $reflectors = array();
    public static $prototypes = array();
    public static $factories = array();
    public static $cloneable = array();
    public static $instantiableWithoutConstructor = array();

    public function __construct(array $classes)
    {
        foreach ($classes as $i => $class) {
            $this->$i = $class;
        }
    }

    public static function unserialize($objects, $serializables)
    {
        $unserializeCallback = ini_set('unserialize_callback_func', __CLASS__.'::getClassReflector');

        try {
            foreach ($serializables as $k => $v) {
                $objects[$k] = unserialize($v);
            }
        } finally {
            ini_set('unserialize_callback_func', $unserializeCallback);
        }

        return $objects;
    }

    public static function p($class)
    {
        self::getClassReflector($class, true, true);

        return self::$prototypes[$class];
    }

    public static function f($class)
    {
        $reflector = self::$reflectors[$class] ?? self::getClassReflector($class, true, false);

        return self::$factories[$class] = \Closure::fromCallable(array($reflector, 'newInstanceWithoutConstructor'));
    }

    public static function getClassReflector($class, $instantiableWithoutConstructor = false, $cloneable = null)
    {
        if (!\class_exists($class) && !\interface_exists($class, false) && !\trait_exists($class, false)) {
            throw new ClassNotFoundException($class);
        }
        $reflector = new \ReflectionClass($class);

        if ($instantiableWithoutConstructor) {
            $proto = $reflector->newInstanceWithoutConstructor();
        } elseif (!$reflector->isInstantiable()) {
            throw new NotInstantiableTypeException($class);
        } elseif ($reflector->name !== $class) {
            $reflector = self::$reflectors[$name = $reflector->name] ?? self::getClassReflector($name, $instantiableWithoutConstructor, $cloneable);
            self::$cloneable[$class] = self::$cloneable[$name];
            self::$instantiableWithoutConstructor[$class] = self::$instantiableWithoutConstructor[$name];
            self::$prototypes[$class] = self::$prototypes[$name];

            return self::$reflectors[$class] = $reflector;
        } else {
            try {
                $proto = $reflector->newInstanceWithoutConstructor();
                $instantiableWithoutConstructor = true;
            } catch (\ReflectionException $e) {
                $proto = $reflector->implementsInterface('Serializable') ? 'C:' : 'O:';
                if ('C:' === $proto && !$reflector->getMethod('unserialize')->isInternal()) {
                    $proto = null;
                } elseif (false === $proto = @unserialize($proto.\strlen($class).':"'.$class.'":0:{}')) {
                    throw new NotInstantiableTypeException($class);
                }
            }
            if (null !== $proto && !$proto instanceof \Throwable) {
                try {
                    if (!$proto instanceof \Serializable && !\method_exists($class, '__sleep')) {
                        serialize($proto);
                    } elseif ($instantiableWithoutConstructor) {
                        serialize($reflector->newInstanceWithoutConstructor());
                    } else {
                        serialize(unserialize(($proto instanceof \Serializable ? 'C:' : 'O:').\strlen($class).':"'.$class.'":0:{}'));
                    }
                } catch (\Exception $e) {
                    throw new NotInstantiableTypeException($class, $e);
                }
            }
        }

        if (null === $cloneable) {
            if (($proto instanceof \Reflector || $proto instanceof \ReflectionGenerator || $proto instanceof \ReflectionType || $proto instanceof \IteratorIterator || $proto instanceof \RecursiveIteratorIterator) && (!$proto instanceof \Serializable && !\method_exists($proto, '__wakeup'))) {
                throw new NotInstantiableTypeException($class);
            }

            $cloneable = $reflector->isCloneable() && !$reflector->hasMethod('__clone');
        }

        self::$cloneable[$class] = $cloneable;
        self::$instantiableWithoutConstructor[$class] = $instantiableWithoutConstructor;
        self::$prototypes[$class] = $proto;

        if ($proto instanceof \Throwable) {
            static $setTrace;

            if (null === $setTrace) {
                $setTrace = array(
                    new \ReflectionProperty(\Error::class, 'trace'),
                    new \ReflectionProperty(\Exception::class, 'trace'),
                );
                $setTrace[0]->setAccessible(true);
                $setTrace[1]->setAccessible(true);
                $setTrace[0] = \Closure::fromCallable(array($setTrace[0], 'setValue'));
                $setTrace[1] = \Closure::fromCallable(array($setTrace[1], 'setValue'));
            }

            $setTrace[$proto instanceof \Exception]($proto, array());
        }

        return self::$reflectors[$class] = $reflector;
    }
}
