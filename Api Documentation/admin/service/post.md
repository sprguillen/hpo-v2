# Service Create

#### (**Admin Only**)

Store services type user

**URL** : `/api/admin/services/store`

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "user_id": "$user->id",
    "service_id": "$service->id",
    "price": "$price",
}
```

**Content examples**

```json
{
    "success":true,
    "message":"New service has been created.",
    "service": {
        "code":"necessitatibus ut ipsa",
        "name":"maximize open-source supply-chains",
        "default_cost":1867,
        "updated_at":"2019-05-18 03:38:08",
        "created_at":"2019-05-18 03:38:08",
        "id":5
    }
}
```
