# Delete source

#### (**Admin Only**)

Delete source

**URL** : `/api/admin/system/source/:id/destroy`

**Params**
1. **id** = source id

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
    "message":"Source has been deleted."
}
```
