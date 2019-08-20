<?php

namespace thexaib\model;


class GenericArray implements \ArrayAccess, \Iterator , \Countable
{

    public function __construct($row = null)
    {
        if ($row != null) {
            $this->loadFromArray($row);
        }

    }

    public function loadFromArray($row)
    {
        foreach ($row as $k => $v) {
            if ($v != null && $v == '') $v = null;
            $this->$k = $v;
        }
    }


    public function __set($var, $val)
    {
        if ($val != null && $val == '') $val = null;
        $this->container[$var] = $val;
    }

    public function __get($var)
    {
        if (isset($this->container[$var])) {
            return $this->container[$var];
        } else {
            return null;
        }
    }

    public function __unset($var)
    {
        unset($this->container[$var]);
    }

    public function toArray()
    {
        return $this->container;
    }

    public function toJSON()
    {
        //todo: Check JSON encode option
//        return json_encode($this->toArray(), JSON_NUMERIC_CHECK);
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }

    public function __toString()
    {
        return $this->toJSON();
    }

    // =====================ArrayAccess Interface
    protected $container = array();

    public function offsetSet($offset, $value)
    {
        if ($value != null && $value == '') $value = null;

        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * @param mixed $offset
     * @return GenericArray
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
    //end::=====================ArrayAccess Interface
    //Start::=====================Iterator Interface
    public function current()
    {
        return current($this->container);
    }

    public function next()
    {
        return next($this->container);
    }

    public function key()
    {
        return key($this->container);
    }

    public function valid()
    {
        $key = key($this->container);
        $var = ($key !== NULL && $key !== FALSE);
        return $var;
    }

    public function rewind()
    {
        reset($this->container);
    }
    //end::=====================Iterator Interface

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return sizeof($this->container);
    }
}



