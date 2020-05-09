/**
 * Loading button component with micro feedback
 *
 * @author      Chong Ting Wai <tingwai@twcloud.tech>
 * @since       0.1.0
 * @link        https://blog.twcloud.tech
 */
import React, { useState } from 'react';
import PropTypes from 'prop-types';

import { makeStyles, useTheme } from '@material-ui/core/styles';
import Button from '@material-ui/core/Button';
import CircularProgress from '@material-ui/core/CircularProgress';

import { green, red } from '@material-ui/core/colors';
import SaveIcon from '@material-ui/icons/Save';
import CheckIcon from '@material-ui/icons/Check';
import ErrorIcon from '@material-ui/icons/Error';

const useStyles = makeStyles(theme => ({
  wrapper: {
    margin: theme.spacing(1),
    position: 'relative',
  },
  buttonProgress: {
    color: green[500],
    position: 'absolute',
    top: '50%',
    left: '50%',
    marginTop: -12,
    marginLeft: -12,
  },
  buttonSuccess: {
    backgroundColor: green[500],
    '&:hover': {
      backgroundColor: green[700],
    },
  },
  buttonFailure: {
    backgroundColor: red[500],
    '&:hover': {
      backgroundColor: red[700],
    },
  },
}));

function LoadingButton (props) {
  const classes = useStyles();
  const {
    fullWidth,
    variant,
    disabled,
    label,
    onClick,
    icon,
    ...otherProps
  } = props;

  const [isLoading, setIsLoading] = useState(false);
  const [buttonIcon, setButtonIcon] = useState(icon);
  const [buttonClassname, setButtonClassname] = useState(null);

  const handleClick = () => {
    setIsLoading(true);
    onClick(
      error => {
        if (error) {
          setButtonIcon(<ErrorIcon />);
          setButtonClassname('buttonFailure');
        } else {
          setButtonIcon(<CheckIcon />);
          setButtonClassname('buttonSuccess');
        }
        setIsLoading(false);
        setTimeout(() => {
          setButtonIcon(icon);
          setButtonClassname(null);
        }, 3000);
      }
    );
  };

  return(
    <div className={classes.wrapper}>
      <Button
        fullWidth={fullWidth}
        variant={variant}
        size="large"
        disabled={isLoading || disabled}
        startIcon={buttonIcon}
        className={buttonClassname && classes[buttonClassname]}
        onClick={handleClick}
        {...otherProps}
      >
        {label ? label : 'Save'}
      </Button>
      {isLoading && <CircularProgress size={24} className={classes.buttonProgress} />}
    </div>
  );
}

LoadingButton.propTypes = {
  label: PropTypes.string,
  icon: PropTypes.element,
  disabled: PropTypes.bool,
  onClick: PropTypes.func.isRequired,
  fullWidth: PropTypes.bool,
  variant: PropTypes.string,
};
LoadingButton.defaultProps = {
  label: 'Save',
  icon: (<SaveIcon />),
  disabled: false,
  onClick: () => {},
  fullWidth: true,
  variant: 'contained',
};

export default LoadingButton;
