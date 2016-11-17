<?php

namespace app\components;

use yii\web\UrlRuleInterface;
use yii\base\Object;
use app\models\Post;

class BlogUrlRule extends Object implements UrlRuleInterface
{

    public function createUrl($manager, $route, $params)
    {
        if ($route === 'site/index') {
            if (isset($params['page'])) {
                return $params['page'];
            } else {
                return '';
            }
        }
        
        if ($route === 'post/view') {
            if (isset($params['id'])) {
                $url = Post::find()->where(['id' => $params['id']])->select(['url'])->scalar();
                return urlencode($url);
            }
        }

	if ($route == 'post/index') {
	    if (isset($params['tagName'])) {
		$url = 'tag/'.$params['tagName'];
                if (isset($params['page'])) {
                    $url .= '/'.$params['page'];
                }
		return $url;
	    }
	}
        
        return false;  // this rule does not apply
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        
//        var_dump($pathInfo); die();
        if (preg_match('%^(\d+)?$%', $pathInfo, $matches)) {
            if ($matches[0]) {
                return ['site/index', ['page' => $matches[1]]];
            }
        }
	
	if (preg_match('%^tag/([\wёйцукенгшщзхъфывапролджэячсмитьбюЁЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮ]+)/*(\d*)$%', $pathInfo, $matches)) {
	    if ($matches[0]) {
		return ['post/index', ['tagName' => mb_strtolower($matches[1]), 'page' => $matches[2] ? $matches[2] : 1]];
	    }
	}
        
        if ($postId = Post::find()->where(['url' => $pathInfo])->select(['id'])->scalar()) {
            return ['post/view', ['id' => $postId]];
        }
        
        return false;  // this rule does not apply
    }
}
