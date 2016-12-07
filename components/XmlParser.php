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
            if (is_object($value)) {
                $result[$key] = $this->convertXmlToArray($value);
            }
        }
        return $result;
    }
}