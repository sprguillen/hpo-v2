# Update client on service

#### (**Admin Only**)

Update client on a service, update **price** only

**URL** : `/api/admin/services/client/:id/update`

**Params**
1. **id** = clientservice id

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "id": $clientService->id,
    "price": $price,
}
```

**Content examples**

```json
{
    "success":true,
    "message":":name has been updated price successfully.",
    "client": {
        "service_id":3,
        "user_id":24,
        "price":5702,
        "updated_at":"2019-05-21 23:26:08",
        "created_at":"2019-05-21 23:26:08",
        "id":44
    }
}
```
