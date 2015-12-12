<?php
return array(
	//'配置项'=>'配置值'
		'TMPL_PARSE_STRING'=>array(
				'__PUBLIC__'=>__ROOT__.'/Public',
				'__PUBLICINDEX__'=>__ROOT__.'/Index/Public',
				'__PUBLICATTACHPATH__'=>__ROOT__.'/Public/Uploads',
				'__PUBLICALL__'=>__ROOT__.'/Public',
				'__BOOTSTRAP__'=>__ROOT__.'/Public/bootstrap',
				'__UPLOAD__'=>__ROOT__.'/'.APP_NAME.'/Tpl/Public/uploads/',
		),
    'DATA_CACHE_TYPE'       => 'Memcache',
);