# Update source

#### (**Admin Only**)

Update source **name** only

**URL** : `/api/admin/system/source/:id/update`

**Params**
1. **id** = patient-type id

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "id": $source->id,
    "name": $name,
}
```

**Content examples**

```json
{
    "success":true,
    "message":":name source has been updated.",
    "dispatcher": {
        "code":"dolores",
        "name":"ea",
        "updated_at":"2019-05-22 00:39:46",
        "created_at":"2019-05-22 00:39:46",
        "id":6
    }
}
```
