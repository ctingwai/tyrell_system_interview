/**
 * Alert dialog for errors
 *
 * @author      Chong Ting Wai <tingwai@twcloud.tech>
 * @since       0.1.0
 * @link        https://blog.twcloud.tech
 */

import React, { useEffect } from 'react';
import PropTypes from 'prop-types';

// Material UI components
import Button from '@material-ui/core/Button';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogContentText from '@material-ui/core/DialogContentText';
import DialogTitle from '@material-ui/core/DialogTitle';

export default function AlertDialog(props) {
  const [open, setOpen] = React.useState(false);

  const handleClose = () => {
    setOpen(false);
  };

  // Display errors if error changed
  useEffect(() => {
    if (props.error && props.error !== '') {
      setOpen(true);
    }
  }, [props.error]);

  return (
    <Dialog
      open={open}
      onClose={handleClose}
      aria-labelledby="alert-dialog-title"
      aria-describedby="alert-dialog-description"
    >
      <DialogTitle id="alert-dialog-title">Oh no! An error has occurred!</DialogTitle>
      <DialogContent>
        <DialogContentText id="alert-dialog-description">
          {props.error}
        </DialogContentText>
      </DialogContent>
      <DialogActions>
        <Button onClick={handleClose} color="primary" autoFocus>
          OK
        </Button>
      </DialogActions>
    </Dialog>
  );
}

AlertDialog.propTypes = {
  error: PropTypes.string,
};

AlertDialog.defaultProps = {
  error: null,
};
