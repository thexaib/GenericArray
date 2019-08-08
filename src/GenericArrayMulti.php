<?php

namespace thexaib;


class GenericArrayMulti extends GenericArray
{
    public function __set($var, $val)
    {
        if ($val != null && $val == '') $val = null;
        $this->offsetSet($var,$val);
//        $this->container[$var] = $this->convertValue($val);
    }

    public function toArray()
    {
        $out=[];
        foreach ($this->container as $key=>$value) {
            if($value instanceof GenericArrayMulti)
            {
                $out[$key]=$value->toArray();
            }
            else if($value!=null){ //todo: if no check,all the table entries with null values be returned
                $out[$key] = $value;
            }
        }
        return $out;
    }




    public function offsetSet($offset, $value)
    {
        if ($value != null && $value == '') $value = null;

        if (is_null($offset)) {
            $this->container[] = $this->convertValue($value);
        } else {
            $this->container[$offset] = $this->convertValue($value);
        }
    }
    protected function convertValue($val)
    {

        if(is_array($val))
        {
            $sub=new GenericArrayMulti($val);
        }
        elseif (is_object($val))
        {
            $sub=new GenericArrayMulti();
            foreach ($val as $k => $v) {
                if ($v != null && $v == '') $v = null;
                $sub->{$k} = $v;
            }
        }else
        {
            $sub=$val;
        }

        return $sub;
    }

}