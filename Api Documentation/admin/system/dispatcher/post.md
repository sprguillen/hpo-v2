# Add dispatcher

#### (**Admin Only**)

Store dispatcher

**URL** : `/api/admin/system/dispatcher/store`

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "code": $code,
    "name": $name,
}
```

**Response examples**

```json
{
    "success":true,
    "message":"New dispatcher has been created.",
    "dispatcher": {
        "code":"dolores",
        "name":"ea",
        "updated_at":"2019-05-22 00:39:46",
        "created_at":"2019-05-22 00:39:46",
        "id":6
    }
}
```
