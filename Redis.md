# Redis

```
```

https://github.com/yiisoft/yii2-queue

```
composer require --prefer-dist yiisoft/yii2-queue
composer require --prefer-dist yiisoft/yii2-redis
```

### /usr/GustavoDev/yii/console/config/main.php
```php
'bootstrap' => [
    'log',
    'queue'
],
'components' => [
    'redis' => [
        'class' => 'yii\redis\Connection',
        'hostname' => 'redisyii',
        'port' => 6379,
        'database' => 0,
    ],
    'queue' => [
        'class' => \yii\queue\redis\Queue::class,
        'redis' => 'redis', // Redis connection component or its config
        'channel' => 'queue', // Queue channel key
    ],
],
```

### /usr/GustavoDev/yii/backend/config/main.php
```php
'bootstrap' => [
    'log',
    'queue'
],
'components' => [
    'redis' => [
        'class' => 'yii\redis\Connection',
        'hostname' => 'redisyii',
        'port' => 6379,
        'database' => 0,
    ],
    'queue' => [
        'class' => \yii\queue\redis\Queue::class,
        'redis' => 'redis', // Redis connection component or its config
        'channel' => 'queue', // Queue channel key
    ],
],
```

### /usr/GustavoDev/yii/environments/dev/backend/config/main-local.php
```php
'components' => [
    'redis' => [
        'class' => 'yii\redis\Connection',
        'hostname' => 'redisyii',
        'port' => 6379,
        'database' => 0,
    ],
],
```

### /usr/GustavoDev/yii/backend/jobs/MyJob.php
```php
namespace backend\jobs;

use yii\base\BaseObject;
use yii\queue\JobInterface;
use Yii;

class MyJob extends BaseObject implements JobInterface
{
    public $message;

    public function execute($queue)
    {
        if (empty($this->message)) {
            $this->message = 'sent from redis';
        }

        Yii::$app->mailer->compose()
            ->setFrom('from@domain.com')
            ->setTo('to@domain.com')
            ->setSubject($this->message)
            ->setTextBody('Plain text content')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();
    }
}
```

### /usr/GustavoDev/yii/backend/controllers/ProjectController.php
```php
namespace backend\controllers;

class ProjectController extends Controller
{
    public function actionQueue($message = '')
    {
        $result = Yii::$app->queue->push(new MyJob([
            'message' => $message
        ]));
        
        return json_encode([
            'result' => $result
        ]);
    }
}
```

```
http://localhost/backend/web/project/queue
http://localhost:8025/
```
