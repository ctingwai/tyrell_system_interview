/**
 * Page header
 *
 * @author      Chong Ting Wai <tingwai@twcloud.tech>
 * @since       0.1.0
 * @link        https://blog.twcloud.tech
 */
import React from 'react';
import Typography from '@material-ui/core/Typography';
import Box from '@material-ui/core/Box';

export default function PageHeader() {
  return (
    <Box my={4}>
      <Typography variant="h4" component="h1" align="center" gutterBottom>
        Tyrell Systems Interview Assignment A
      </Typography>
      <Typography variant="subtitle1" component="h2" align="center" gutterBottom>
        Total 52 cards containing 1-13 of each Spade(S), Heart(H), Diamond(D), Club(C)
        will be given to n people randomly
      </Typography>
    </Box>
  );
};
