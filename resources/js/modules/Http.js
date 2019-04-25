import qs from 'qs';
import axios from 'axios';
import {merge} from 'lodash';

export default class Http
{

  constructor(crsf = null, baseURL = '')
  {
    let token = document.head.querySelector('meta[name="csrf-token"]');
    // Make sure that crsf is supplied
    if (token) {
      crsf = document.head.querySelector('meta[name="csrf-token"]').content;
    } else {
      console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    }

    this.crsf = crsf;
    this.headers = {};

    this.driver = axios.create({
      baseURL,
      headers: {
        'X-CSRF-TOKEN': this.crsf,
        'X-Requested-With': 'XMLHttpRequest'
      }
    });
  }

  /**
  * Add default headers
  *
  * @param  {Object} [headers={}]                        the headers to load
  * @return {Http}
  * @author {goper}
  */
  withHeaders(headers = {})
  {
    for (var key in headers) {
      this.driver.defaults.headers[key] = headers[key];
    }
    return this;
  }

  /**
  * Post
  *
  * @param   {String} url                                the url where to post in
  * @param   {Object} data                               the data to post
  * @param   {Object} [config={}]                        the custom settings for the post request
  * @return  {Promise}
  * @author  {goper}
  */
  post(url, data = {}, config = {})
  {
    return new Promise((resolve, reject) => {
      this.driver.post(url, qs.stringify(data), config)
      .then(xhr => resolve(xhr))
      .catch(error => reject(error.response));
    });
  }

  /**
  * Post with JSON response
  *
  * @param   {String} url                                the url where to post in
  * @param   {Object} data                               the data to post
  * @param   {Object} [config={}]                        the custom settings for the post request
  * @return  {Promise}
  * @author  {goper}
  */
  postJSON(url, data = {}, config = {})
  {
    return this.post(url, data, merge(config, {responseType: 'json'}));
  }

  /**
  * Get
  *
  * @param   {String} url                                the url where to request
  * @param   {Object} data                               the data to attach to the request
  * @param   {Object} [config={}]                        the custom settings for the post request
  * @return  {Promise}
  * @author  {goper}
  */
  get(url, data = {}, config = {})
  {
    return new Promise((resolve, reject) => {
      this.driver.get(url, merge(config, {params: data}))
      .then(xhr => resolve(xhr))
      .catch(error => reject(error.response));
    });
  }

  /**
  * Get with JSON response
  *
  * @param   {String} url                                the url where to request
  * @param   {Object} data                               the data to attach to the request
  * @param   {Object} [config={}]                        the custom settings for the post request
  * @return  {Promise}
  * @author  {goper}
  */
  getJSON(url, data = {}, config = {})
  {
    return this.get(url, data, merge(config, {responseType: 'json'}));
  }
}
