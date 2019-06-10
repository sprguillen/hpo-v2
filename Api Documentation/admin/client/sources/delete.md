# Delete source on a client

#### (**Admin Only**)

Store source on a client

**URL** : `/api/admin/client/{id}/sources/{sourceId}/destroy`

**Params**
1. **id** = user/client id
2. **sourceId** = clientSource id

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
    "message":"Source has been removed from this client.",
}
```
