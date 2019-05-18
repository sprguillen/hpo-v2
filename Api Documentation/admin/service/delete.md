# Service Delete

#### (**Admin Only**)

Delete service

**URL** : `/api/admin/services/:id/destroy`

**Params**
1. **id** = Service id

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
    "message":"Service has been deleted."
}
```
