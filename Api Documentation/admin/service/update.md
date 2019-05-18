# Service Update

#### (**Admin Only**)

Store client

**URL** : `/api/admin/services/:id/update`

**Params**
1. **id** = service id

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "id": $service->id,
    "name": $newName,
    "code": $service->code,
    "default_cost": $service->default_cost,
}
```

**Content examples**

```json
{
    "success":true,
    "message":":name service has been updated.",
    "service":{
        "id":9,
        "code":"inventore ad natus",
        "name":"aggregate best-of-breed web-readiness",
        "default_cost":1369,
        "created_at":"2019-05-18 03:42:01",
        "updated_at":"2019-05-18 03:42:01"
    }
}
```
