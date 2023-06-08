<?php

namespace backend\jobs;

use yii\base\BaseObject;
use yii\queue\JobInterface;
use Yii;

class MyJob extends BaseObject implements JobInterface
{
    public function execute($queue)
    {
        $message = 'sent redis';
        Yii::$app->mailer->compose()
            ->setFrom('from@domain.com')
            ->setTo('to@domain.com')
            ->setSubject($message)
            ->setTextBody('Plain text content')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();
    }
}
