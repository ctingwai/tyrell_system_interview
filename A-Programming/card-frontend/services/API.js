/**
 * Main API caller that handles any error and transform them
 * into a more uniform structure
 *
 * @author      Chong Ting Wai <tingwai@twcloud.tech>
 * @since       0.1.0
 * @link        https://blog.twcloud.tech
 */
import config from '../config/system';
import axios from 'axios';

const handleAxiosErrors = error => {
  let message = '';
  if (error.response) {
    // The request was made and the server responded with a status code
    // that falls out of the range of 2xx
    message += `Got invalid response: ${error.response.status}`;
    if (error.response.data) {
      if (error.response.data.message) {
        message += ` ${error.response.data.message}`;
      } else {
        message += ` ${JSON.stringify(error.response.data)}`;
      }
    }
  } else if (error.request) {
    // The request was made but no response was received
    // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
    // http.ClientRequest in node.js
    message += `No response: ${error.request}`;
  } else {
    // Something happened in setting up the request that triggered an Error
    message += `Invalid configuration: ${error.message}`;
  }
  return {
    error: message,
  };
};


const createInstance = () => {
  const insConf = {
    baseURL: config.api.baseurl,
    timeout: 60000,
  };
  const instance = axios.create(insConf);
  // interceptors
  instance.interceptors.response.use(response => response.data, handleAxiosErrors);
  return instance;
};
export default createInstance;
