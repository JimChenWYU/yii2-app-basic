<?php

return [
	'class'      => 'yii\redis\Cache',
	'redis'      => 'redis',
	'keyPrefix'  => 'cache:',
	'serializer' => [ 'msgpack_serialize', 'msgpack_unserialize' ],
];