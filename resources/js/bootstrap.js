
import _ from 'lodash'
import PopperJs from 'popper.js'
import $ from 'jquery'

import 'bootstrap'
import { getCookie } from './utils/cookies'

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios'
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

let authToken = getCookie('auth_token')

if (auth) {
  axios.defaults.headers.common['Authorization'] = authToken;
}
