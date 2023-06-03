# How to Migrate

### Create migrations
```

php yii migrate/create create_file_table --fields="name:string:notNull,base_url:string:notNull,mime_type:string:notNull"

php yii migrate/create create_project_image_table --fields="project_id:integer:notNull:foreignKey,file_id:integer:notNull:foreignKey"

php yii migrate/create create_testimonial_table --fields="project_id:integer:notNull:foreignKey,customer_image_id:integer:notNull:foreignKey(file),title:string:notNull,customer_name:string:notNull,review:text:notNull,rating:integer:notNull"

```

### Run and Revert
```

php yii migrate

php yii migrate/down [number of migrations to revert]

```

### Test DB connection inside controllers
Command to migrate users in the advanced yii project
```
php yii migrate
```
```php
namespace frontend\controllers;

use Yii;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $users = Yii::$app->db->createCommand('SELECT * FROM user')
            ->queryAll();
        print_r(json_encode(['users' => $users]));echo "\n\n";exit;
        //return $this->render('index');
    }
}
```
