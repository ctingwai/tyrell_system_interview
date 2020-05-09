/**
 * Form component that displays all inputs required by the application
 *
 * @author      Chong Ting Wai <tingwai@twcloud.tech>
 * @since       0.1.0
 * @link        https://blog.twcloud.tech
 */
import React, { useState } from 'react';
import PropTypes from 'prop-types';

// Material ui
import Box from '@material-ui/core/Box';
import Paper from '@material-ui/core/Paper';
import Grid from '@material-ui/core/Grid';
import TextField from '@material-ui/core/TextField';
import LoadingButton from './LoadingButton';
import { makeStyles } from '@material-ui/core/styles';

// Styles
const useStyles = makeStyles((theme) => ({
}));

export default function InputForm(props) {
  const [totalPlayers, setTotalPlayers] = useState(4);
  const [cardsPerPlayer, setCardsPerPlayer] = useState(7);
  const { onSubmit } = props;

  return (
    <Paper square elevation={2}>
      <Box p={2}>
        <Grid container alignItems='center' spacing={2}>
          <Grid item md={5}>
            <TextField
              fullWidth
              label="How many players?"
              placeholder="4"
              value={totalPlayers}
              onChange={e => setTotalPlayers(e.target.value)}
            />
          </Grid>
          <Grid item md={5}>
            <TextField
              fullWidth
              label="How many cards for each player?"
              placeholder="7"
              value={cardsPerPlayer}
              onChange={e => setCardsPerPlayer(e.target.value)}
            />
          </Grid>
          <Grid item md={2}>
            <LoadingButton
              label="Start"
              variant="text"
              onClick={done => {
                onSubmit(totalPlayers, cardsPerPlayer, done);
              }}
            />
          </Grid>
        </Grid>
      </Box>
    </Paper>
  );
};

InputForm.propTypes = {
  onSubmit: PropTypes.func,
};

InputForm.defaultProps = {
  onSubmit: () => {},
};
