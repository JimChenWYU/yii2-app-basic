<?php

namespace app\support;

use yii\base\BaseObject;
use yii\queue\serializers\SerializerInterface;

class MsgpackSerializer extends BaseObject implements SerializerInterface
{
	/**
	 * @inheritDoc
	 */
	public function serialize($job)
	{
		return msgpack_serialize($job);
	}

	/**
	 * @inheritDoc
	 */
	public function unserialize($serialized)
	{
		return msgpack_unserialize($serialized);
	}
}
