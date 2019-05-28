# Import service

#### (**Admin Only**)

Store services type user

**URL** : `/api/admin/services/import`

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "file": "$file",
}
```

**Content examples**

```json
{
    "success":true,
    "message":"Importing services successful.",
    "service":
    [
        {
            "code":"necessitatibus ut ipsa",
            "name":"maximize open-source supply-chains",
            "default_cost":1867,
            "updated_at":"2019-05-18 03:38:08",
            "created_at":"2019-05-18 03:38:08",
            "id":5
        },
        {
            "code":"necessitatibus ut ipsa",
            "name":"maximize open-source supply-chains",
            "default_cost":1867,
            "updated_at":"2019-05-18 03:38:08",
            "created_at":"2019-05-18 03:38:08",
            "id":5
        }
    ]
}
```
