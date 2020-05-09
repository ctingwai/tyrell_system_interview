/**
 * Game table component that displays all player names and cards
 *
 * @author      Chong Ting Wai <tingwai@twcloud.tech>
 * @since       0.1.0
 * @link        https://blog.twcloud.tech
 */
import React from 'react';
import PropTypes from 'prop-types';

// Material ui
import Box from '@material-ui/core/Box';
import Grid from '@material-ui/core/Grid';
import Paper from '@material-ui/core/Paper';
import Typography from '@material-ui/core/Typography';
import { makeStyles } from '@material-ui/core/styles';

// Styles
const useStyles = makeStyles((theme) => ({
}));

export default function GameTable(props) {
  const { players } = props;

  const playerCards = players.map(player => (
    <Grid container spacing={2} key={player.id}>
      <Grid item sm={6}>
        <Typography variant="body1" align="right">
          {player.name}:
        </Typography>
      </Grid>
      <Grid item sm={6}>
        <Typography variant="body2">
          {player.cards.map(c => c.card).join(',')}
        </Typography>
      </Grid>
    </Grid>
  ));
  return (
    <Paper square elevation={2}>
      <Typography variant="overline" component="h2" align="center">
        Game Table
      </Typography>
      <Box p={2}>{playerCards}</Box>
    </Paper>
  );
};

GameTable.propTypes = {
  players: PropTypes.arrayOf(
    PropTypes.shape({
      name: PropTypes.string.isRequired,
      cards: PropTypes.arrayOf(
        PropTypes.shape({
          card: PropTypes.string.isRequired,
        }),
      ).isRequired,
    }),
  ),
};

GameTable.defaultProps = {
  players: [],
};
