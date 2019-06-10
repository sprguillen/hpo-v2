# Trade Show

### Setup
* `PHP >= 7.1.3`

### Installation
1. After cloning run `make setup`.

### Development
1. If you add variables on `.env` **make sure** to update the `.env.example` file.
2. To compile run `yarn hot` or `yarn watch`.
3. After you pull changes especially from `backend` branch just run `make update` to update your app files.

### API
1. Creating `FormRequest` always extend the `BaseRequest` not the `FormRequest` (which is the default).

### Deployment
To used the whitelist ip feature make sure to **update the `.env` file** and set the `APP_ENV` to `production` or `live`.
