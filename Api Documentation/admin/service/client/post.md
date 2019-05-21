# Add client to the service

#### (**Admin Only**)

Store services type user

**URL** : `/api/admin/services/client/store`

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "user_id": '$user->id',
    "service_id": $service->id,
    "price": $price,
}
```

**Response examples**

```json
{
    "success":true,
    "message":":client_name client has been added to service.",
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
