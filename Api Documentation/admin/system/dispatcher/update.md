# Update dispatcher

#### (**Admin Only**)

Update dispatcher **name** only

**URL** : `/api/admin/system/dispatcher/:id/update`

**Params**
1. **id** = dispatcher id

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "id": $dispatcher->id,
    "name": $name,
}
```

**Content examples**

```json
{
    "success":true,
    "message":":name dispatcher has been updated.",
    "dispatcher": {
        "code":"dolores",
        "name":"ea",
        "updated_at":"2019-05-22 00:39:46",
        "created_at":"2019-05-22 00:39:46",
        "id":6
    }
}
```
