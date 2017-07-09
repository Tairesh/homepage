<?php

use yii\helpers\Html;

?>
        <footer>
            <div class="text-right"><?= \app\models\Page::findOne(4)->content ?><?php if (!Yii::$app->user->isGuest) echo Html::a('[ edit ]', ['/edit', 'pageId' => 4]) ?></div>
            <p>&copy; Илья Агафонов, 2014&mdash;<?= date('Y') ?></p>
        </footer>
    </div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter41405544 = new Ya.Metrika({
                    id:41405544,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<!-- /Yandex.Metrika counter -->