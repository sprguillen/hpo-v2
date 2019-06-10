# Client add Source

#### (**Admin Only**)

Store source on a client

**URL** : `/api/admin/client/{id}/sources/store`

**Params**
1. **id** = user/client id

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "user_id": "$user->id",
    "source_id": "$source->id",
}
```

**Content examples**

```json
{
    "success":true,
    "message":"Source has been added to CLIENT_NAME client.",
    "client": {
        "id":30,
        "user_id":80,
        "source_id":8,
        "created_at":"2019-05-28 02:03:10",
        "updated_at":"2019-05-28 02:03:10",
        "source":{
            "id":8,
            "code":"omnis",
            "name":"quas",
            "created_at":"2019-05-24 22:58:58",
            "updated_at":"2019-05-24 22:58:58"
        }
    }
}
```
