<?php

return [
	'class' => 'yii\queue\redis\Queue',
	'redis' => 'redis',
	'channel' => 'queue:common',
	'attempts' => 5,
	'serializer' => 'app\support\MsgpackSerializer',
];
