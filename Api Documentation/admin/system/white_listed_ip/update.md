# Update white-listed-ip

#### (**Admin Only**)

Update white-listed-ip

**URL** : `/api/admin/system/white-listed-ip/:id/update`

**Params**
1. **id** = white-listed-ip id

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "id": $white_listed_ip->id,
    "address": $address,
}
```

**Content examples**

```json
{
    "success":true,
    "message":":name source has been updated.",
    "white_listed_ip": {
        "address":"127.0.0.1",
        "updated_at":"2019-05-22 00:39:46",
        "created_at":"2019-05-22 00:39:46",
        "id":6
    }
}
```
