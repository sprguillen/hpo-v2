# Delete white-listed-ip

#### (**Admin Only**)

Delete white-listed-ip

**URL** : `/api/admin/system/white-listed-ip/:id/destroy`

**Params**
1. **id** = white-listed-ip id

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
}
```

**Content examples**

```json
{
    "success":true,
    "message":"Ip has been deleted."
}
```
