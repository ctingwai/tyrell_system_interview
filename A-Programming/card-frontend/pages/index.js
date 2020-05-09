/**
 * Home page
 *
 * @author      Chong Ting Wai <tingwai@twcloud.tech>
 * @since       0.1.0
 * @link        https://blog.twcloud.tech
 */
import React, { useEffect, useState } from 'react';

// Material ui
import Box from '@material-ui/core/Box';

// Services
import { list as listPlayers, add as addPlayers } from '../services/PlayersService';
import { add as distributeCards } from '../services/CardsService';

// Custom components
import InputForm from '../components/InputForm';
import GameTable from '../components/GameTable';
import AlertDialog from '../components/AlertDialog';

export default function Index() {
  const [players, setPlayers] = useState([]);
  const [error, setError] = useState('');

  const handleSubmit = async (totalPlayers, cardsPerPlayer, done) => {
    await addPlayers(totalPlayers)
      .then(res => {
        if (res.error) {
          setError(res.error);
        }
      });
    await distributeCards(cardsPerPlayer)
      .then(res => {
        if (res.error) {
          setError(res.error);
        }
      });
    listPlayers()
      .then(res => {
        if (res.error) {
          setError(res.error);
          done(data.error);
        } else {
          setPlayers(res);
          done();
        }
      })
  };

  useEffect(() => {
    listPlayers()
      .then(res => {
        if (res.error) {
          setError(res.error);
        } else {
          setPlayers(res);
        }
      });
  }, []);

  return (
    <>
      <Box margin={2}>
        <InputForm onSubmit={handleSubmit} />
      </Box>

      <Box margin={2}>
        <GameTable players={players} />
      </Box>

      <AlertDialog error={error} />
    </>
  );
}
