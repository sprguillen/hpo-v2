# Client Delete

#### (**Admin Only**)

Store client

**URL** : `/api/admin/client/:id/destroy`

**Params**
1. **id** = user/client id

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
    "message":"Client has been deleted."
}
```
