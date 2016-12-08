<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\components\XmlParser;

/**
 * Обновляет информацию из MyTetra
 */
class UpdateController extends Controller {
    
    
    private $foundTags = [];
    
    public function actionIndex()
    {
        /* @var $parser XmlParser */
        $parser = Yii::$app->xmlParser;
        $data = $parser->parse(file_get_contents(Yii::$app->basePath.'/data/mytetra.xml'))['content']['node'];
        $this->foundTags($data);
        print_r($this->foundTags);
    }
    
    private function foundTags($data)
    {
        foreach ($data as $node) {
            $this->tryAddTag($node['@attributes']['name']);
            if (isset($node['node'])) {
                $this->foundTags($node['node']);
            }
            if (isset($node['recordtable'])) {
                foreach ($node['recordtable'] as $record) {
                    if (isset($record['@attributes']['tags']) && !empty($record['@attributes']['tags'])) {
                        $tags = explode(',',$record['@attributes']['tags']);
                        foreach ($tags as $tag) {
                            $this->tryAddTag($tag);
                        }
                    }
                }
            }
        }
    }
    
    private function tryAddTag($tag)
    {
        $tag = mb_strtolower(trim($tag));
        if (!in_array($tag, $this->foundTags)) {
            $this->foundTags[] = $tag;
        }
    }
    
}
