# Add source

#### (**Admin Only**)

Store source

**URL** : `/api/admin/system/source/store`

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
    "message":"New source type has been created.",
    "source": {
        "code":"dolores",
        "name":"ea",
        "updated_at":"2019-05-22 00:39:46",
        "created_at":"2019-05-22 00:39:46",
        "id":6
    }
}
```
