/**
 * Cards service integrator to the backend API
 *
 * @author      Chong Ting Wai <tingwai@twcloud.tech>
 * @since       0.1.0
 * @link        https://blog.twcloud.tech
 */
import API from './API';

const PLAYERS_LIMIT = 1000000;

export const add = cards_per_player => {
  return API().post('/cards.json', null, {
    params: { cards_per_player },
  });
};
