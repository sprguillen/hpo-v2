# Add white-listed-ip

#### (**Admin Only**)

Store white-listed-ip

**URL** : `/api/admin/system/white-listed-ip/store`

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "address": $address,
}
```

**Response examples**

```json
{
    "success":true,
    "message":"New ip has been created.",
    "white_listed_ip": {
        "address":"127.0.0.1",
        "updated_at":"2019-05-22 00:39:46",
        "created_at":"2019-05-22 00:39:46",
        "id":6
    }
}
```
