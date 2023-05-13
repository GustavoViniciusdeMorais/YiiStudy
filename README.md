# Yii Framework Example

Created by: Gustavo Morais

[Simple Tutorial](https://www.yiiframework.com/doc/guide/2.0/en/start-gii)
<br>
[Rest API](https://www.yiiframework.com/doc/guide/2.0/en/rest-quick-start)

```

sudo docker-compose up -d --build

sudo docker exec -it yiinginx bash

```

### DB Setup
```

# at ubuntu project folder
sudo cp dbExample.sql dockerDBData/dbExample.sql

sudo docker exec -it yiimysql sh
use laravel
source /var/lib/mysql/dbExample.sql

http://localhost/index.php?r=country%2Findex

```
