# Processor Delete

#### (**Admin Only**)

Store client

**URL** : `/api/admin/processor/:id/destroy`

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
    "message":"Processor has been deleted."
}
```
