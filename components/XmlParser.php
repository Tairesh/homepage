<?php

namespace app\components;

use yii\base\Component;

/**
 * XmlParser parses strings as XML.
 */
class XmlParser extends Component
{
    /**
     * @inheritdoc
     */
    public function parse($xml)
    {
        return $this->convertXmlToArray($xml);
    }
    /**
     * Converts XML document to array.
     * @param string|\SimpleXMLElement $xml xml to process.
     * @return array XML array representation.
     */
    protected function convertXmlToArray($xml)
    {
        if (!is_object($xml)) {
            $xml = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        }
        $result = (array) $xml;
        foreach ($result as $key => $value) {
            $result[$key] = $this->convertValue($value);
        }
        return $result;
    }
    
    protected function convertValue($value)
    {
        if (is_object($value)) {
            return $this->convertXmlToArray($value);
        } elseif (is_array($value)) {
            foreach ($value as $i => $v) {
                if (is_object($v)) {
                    $value[$i] = $this->convertXmlToArray($v);
                }
            }
            return $value;
        } else {
            return $value;
        }
    }
}