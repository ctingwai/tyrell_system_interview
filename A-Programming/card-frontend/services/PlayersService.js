/**
 * Players service integrator to the backend API
 *
 * @author      Chong Ting Wai <tingwai@twcloud.tech>
 * @since       0.1.0
 * @link        https://blog.twcloud.tech
 */
import API from './API';

const PLAYERS_LIMIT = 1000000;

export const list = () => {
  return API().get('/players.json', null, {
    params: {
      limit: PLAYERS_LIMIT,
    },
  }).then(res => res.data);
};

export const add = total_players => {
  return API().post('/players.json', null, {
    params: { total_players },
  });
};
